<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory'; // since table name is 'inventory', not plural

    protected $fillable = [
        'product_id',
        'admin_id',
        'store_id',
        'type',
        'quantity_change',
        'quantity_before',
        'quantity_after',
        'reason',
        'notes',
        'user_id',
    ];
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
    // Relations
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
