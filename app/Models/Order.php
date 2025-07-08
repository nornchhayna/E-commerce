<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'store_id',     // Customer who placed the order
        'admin_id',
        'status',
        'subtotal',
        'tax_amount',
        'shipping_amount',
        'discount_amount',
        'total_amount',
        'currency',
        'billing_first_name',
        'billing_last_name',
        'billing_email',
        'billing_phone',
        'billing_address',
        'billing_city',
        'billing_state',
        'billing_zip_code',
        'billing_country',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_zip_code',
        'shipping_country',
        'shipping_method',
        'payment_method',
        'payment_status',
        'transaction_id',
        'payment_date',
        'notes',
        'shipped_at',
        'delivered_at',
        'carrier',
        'tracking_number',
    ];


    protected $dates = [
        'payment_date',
        'shipped_at',
        'delivered_at',
        'created_at',
        'updated_at'
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function billingAddress()
    {
        return $this->belongsTo(Address::class, 'billing_address_id');
    }

    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
