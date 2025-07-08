<?php

// 1. Update your User model to handle admin roles
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'role',           // 'customer', 'admin', 'super_admin'
    //     'store_name',     // Admin's store name (optional)
    //     'is_active',      // To enable/disable admin accounts
    // ];
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'store_name',
        'parent_admin_id',
        'is_approved',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'last_login_at',
        'is_active',
        'approved_at',
        'remember_token',
        'is_superadmin',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
        'last_login_at' => 'datetime',
        'approved_at' => 'datetime',
        'is_approved' => 'boolean',
        'is_active' => 'boolean',
        'role' => 'string',
    ];

    public function stores(): HasMany
    {
        return $this->hasMany(Store::class, 'admin_id');
    }

    public function getStoreIdAttribute(): ?int
    {
        return $this->stores()->first()?->id;
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    // Check if user is super admin
    public function isSuperAdmin(): bool
    {
        return $this->is_superadmin;
    }

    // Check if user is customer
    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    // Get admin's store name
    public function getStoreNameAttribute()
    {
        return $this->attributes['store_name'] ?? $this->name . "'s Store";
    }

    // Scope to get only admins
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    // Relationships - Admin owns these
    public function ownedProducts()
    {
        return $this->hasMany(Product::class, 'admin_id');
    }

    public function ownedOrders()
    {
        return $this->hasMany(Order::class, 'admin_id');
    }
    public function admins()
    {
        return $this->hasMany(User::class, 'parent_admin_id');
    }
    public function ownedCategories()
    {
        return $this->hasMany(Category::class, 'admin_id');
    }

    public function ownedInventory()
    {
        return $this->hasMany(Inventory::class, 'admin_id');
    }

    public function ownedCoupons()
    {
        return $this->hasMany(Coupon::class, 'admin_id');
    }
}
