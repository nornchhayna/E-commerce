<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'store_id',

        'admin_id',
        'order_id',
        'rating',
        'title',
        'comment',
        'is_verified',
        'is_approved',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
        'is_verified' => 'boolean',
        'is_approved' => 'boolean',
    ];
    // app/Models/Review.php


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
