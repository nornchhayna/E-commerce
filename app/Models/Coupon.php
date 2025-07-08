<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    protected $fillable = [
        'admin_id',
        'store_id',
        'code',
        'name',
        'description',
        'type',
        'value',
        'minimum_amount',
        'maximum_discount',
        'usage_limit',
        'used_count',
        'usage_limit_per_user',
        'is_active',
        'starts_at',
        'expires_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'value' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
    ];

    public function isValid($cartTotal)
    {
        $now = now();
        Log::info('Coupon Validation', [
            'code' => $this->code,
            'is_active' => $this->is_active,
            'starts_at' => $this->starts_at,
            'expires_at' => $this->expires_at,
            'cart_total' => $cartTotal,
            'minimum_amount' => $this->minimum_amount,
            'usage_limit' => $this->usage_limit,
            'used_count' => $this->used_count,
            'now' => $now,
        ]);

        if (!$this->is_active) {
            Log::warning('Coupon invalid: Not active', ['code' => $this->code]);
            return ['valid' => false, 'message' => 'Coupon is not valid at this time.'];
        }

        if ($this->starts_at && $now < $this->starts_at) {
            Log::warning('Coupon invalid: Not yet started', ['code' => $this->code, 'starts_at' => $this->starts_at]);
            return ['valid' => false, 'message' => 'Coupon is not valid at this time.'];
        }

        if ($this->expires_at && $now > $this->expires_at) {
            Log::warning('Coupon invalid: Expired', ['code' => $this->code, 'expires_at' => $this->expires_at]);
            return ['valid' => false, 'message' => 'Coupon is not valid at this time.'];
        }

        if ($this->minimum_amount && $cartTotal < $this->minimum_amount) {
            Log::warning('Coupon invalid: Cart total too low', ['code' => $this->code, 'cart_total' => $cartTotal, 'minimum_amount' => $this->minimum_amount]);
            return ['valid' => false, 'message' => 'Cart total does not meet the minimum amount requirement.'];
        }

        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            Log::warning('Coupon invalid: Usage limit reached', ['code' => $this->code, 'used_count' => $this->used_count, 'usage_limit' => $this->usage_limit]);
            return ['valid' => false, 'message' => 'Coupon has reached its usage limit.'];
        }


        return ['valid' => true, 'message' => 'Coupon is valid.'];
    }
    protected static function booted()
    {
        static::addGlobalScope('admin', function (Builder $builder) {
            // Ensure the user is authenticated and has admin privileges
            if (Auth::check() && Auth::user()->isAdmin()) {
                // Apply a global scope to filter by admin_id
                $builder->where('admin_id', Auth::user()->id);
            }
        });
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function calculateDiscount($cartTotal)
    {
        Log::info('Calculating Discount', [
            'code' => $this->code,
            'type' => $this->type,
            'value' => $this->value,
            'cart_total' => $cartTotal,
            'maximum_discount' => $this->maximum_discount,
        ]);

        if ($this->type === 'fixed') {
            $discount = min((float) $this->value, (float) $cartTotal);
            Log::info('Fixed Discount Calculated', ['discount' => $discount]);
            return $discount;
        }

        // Percentage discount
        $discount = ((float) $this->value / 100) * (float) $cartTotal;
        if ($this->maximum_discount) {
            $discount = min($discount, (float) $this->maximum_discount);
        }
        Log::info('Percentage Discount Calculated', ['discount' => $discount]);
        return $discount;
    }
}
