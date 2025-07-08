<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    protected $table = 'stores';

    protected $fillable = [
        'admin_id',
        'name',
        'slug',
        'description',
        'shopify_store_url',
        'shopify_access_token',
        'taobao_api_key',
        'taobao_secret_key',
        'settings',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function coupons(): HasMany
    {
        return $this->hasMany(Coupon::class, 'store_id');
    }
}
