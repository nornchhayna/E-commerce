<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_sku',
        'price',
        'quantity',
        'total',
        'product_options'
    ];

    protected $casts = [
        'product_options' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function checkout(Request $request)
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shipping = 5.00;
        $tax = $subtotal * 0.1;
        $total = $subtotal + $shipping + $tax;

        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'user_id' => Auth::id(),
            'status' => 'pending',
            'subtotal' => $subtotal,
            'tax_amount' => $tax,
            'shipping_amount' => $shipping,
            'total_amount' => $total,
            'currency' => 'USD',
            'payment_method' => 'cod', // or stripe, paypal, etc.
            'billing_first_name' => $request->billing_first_name,
            'billing_last_name' => $request->billing_last_name,
            'billing_email' => $request->billing_email,
            'billing_address' => $request->billing_address,
            'billing_city' => $request->billing_city,
            'billing_state' => $request->billing_state,
            'billing_zip_code' => $request->billing_zip_code,
            'billing_country' => $request->billing_country,
            'shipping_first_name' => $request->shipping_first_name,
            'shipping_last_name' => $request->shipping_last_name,
            'shipping_address' => $request->shipping_address,
            'shipping_city' => $request->shipping_city,
            'shipping_state' => $request->shipping_state,
            'shipping_zip_code' => $request->shipping_zip_code,
            'shipping_country' => $request->shipping_country,
            'shipping_method' => $request->shipping_method,
            'payment_status' => 'pending'
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'total' => $item->price * $item->quantity,
            ]);
        }

        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }
}
