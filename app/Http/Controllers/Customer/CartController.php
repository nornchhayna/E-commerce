<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Order; // Corrected import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

class CartController extends Controller
{
    // Display cart page
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = CartItem::with('product.images')->where('user_id', Auth::id())->get();

        // Convert cart array to collection of objects
        $cartItems = collect($cart)->map(function ($item) {
            return (object) $item;
        });

        // Calculate subtotal safely
        $subtotal = $cartItems->sum(function ($item) {
            $price = isset($item->price) && is_numeric($item->price) ? (float) $item->price : 0;
            $quantity = isset($item->quantity) && is_numeric($item->quantity) ? (int) $item->quantity : 0;
            return $price * $quantity;
        });

        // $shipping = 0;
        // $discount = Session::get('coupon.discount', 0);
        // $tax = $subtotal * 0.1;
        // $total = max(0, $subtotal + $shipping + $tax - $discount);

        // Session::put('cart_total', $subtotal);
        // Log::info('Cart Total Set', ['subtotal' => $subtotal]);
        $cartItems = session('cart', []);
        $cartItems = collect($cartItems);  // convert array to Collection

        // Then calculate subtotal, tax, total as before
        $subtotal = $cartItems->sum(fn($item) => $item['price'] * $item['quantity']);
        $tax = $subtotal * 0.10;
        $discount = session('coupon.discount', 0);
        $total = $subtotal + $tax - $discount;

        return view('customer.cart.index', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    // Add product to cart
    public function add(Request $request)
    {
        Log::info('Cart Add Triggered', ['product_id' => $request->product_id]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'sku'      => $product->sku,
                'price'    => (float) str_replace(',', '', $product->price),
                'image'    => $product->image,
                'quantity' => 1,
                'stock'    => $product->stock ?? 0,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Update quantity
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $quantity = is_numeric($request->quantity) ? (int) $request->quantity : 1;
            $cart[$id]['quantity'] = max(1, $quantity); // fixed: should be minimum 1, not 10
            session()->put('cart', $cart);
            return back()->with('success', 'Cart updated!');
        }

        return back()->with('error', 'Product not found in cart');
    }

    // Remove item
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Item removed from cart');
    }

    // Clear cart
    public function clear(Request $request)
    {
        Session::forget('cart');
        Session::forget('coupon');
        Session::forget('cart_total');

        return response()->json(['message' => 'Cart cleared successfully'], 200);
    }

    // Apply couponuse Illuminate\Support\Facades\Session;

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:coupons,code',
        ]);

        $coupon = Coupon::where('code', $request->code)->first();

        // Get current cart total (simulate for now)
        $cartItems = collect(session('cart', []));
        $cartTotal = $cartItems->sum(fn($item) => $item['price'] * $item['quantity']);

        // Log for debugging
        Log::info('Applying coupon', ['code' => $request->code, 'cart_total' => $cartTotal]);

        $validation = $coupon->isValid($cartTotal);

        if (!$validation['valid']) {
            return back()->with('error', $validation['message']);
        }

        $discount = $coupon->calculateDiscount($cartTotal);

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $discount,
        ]);

        $coupon->increment('used_count');

        return back()->with('success', 'Coupon applied! Discount: $' . number_format($discount, 2));
    }



    // Remove coupon
    public function removeCoupon()
    {
        Session::forget('coupon');
        return back()->with('success', 'Coupon removed successfully!');
    }
    // $cartItems = CartItem::with('product.images')->where('user_id', auth()->id())->get();


    // Checkout
    public function checkout(Request $request)
    {
        $orderController = new OrderController();

        $request->validate([
            'billing_first_name' => 'required',
            'billing_last_name' => 'required',
            'billing_email' => 'required|email',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_state' => 'required',
            'billing_zip_code' => 'required',
            'billing_country' => 'required',

            'shipping_first_name' => 'required',
            'shipping_last_name' => 'required',
            'shipping_address' => 'required',
            'shipping_city' => 'required',
            'shipping_state' => 'required',
            'shipping_zip_code' => 'required',
            'shipping_country' => 'required',

            'shipping_method' => 'required|string',
            'payment_method' => 'required|in:paypal,payway',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->withErrors(['Cart is empty']);
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;

        $order = \App\Models\Order::create([
            'order_number'         => strtoupper(Str::random(10)),
            'user_id'              => Auth::id(),
            'status'               => 'pending',
            'subtotal'             => $subtotal,
            'tax_amount'           => $tax,
            'shipping_amount'      => 0,
            'discount_amount'      => 0,
            'total_amount'         => $total,
            'currency'             => 'USD',

            // Billing
            'billing_first_name'   => $request->billing_first_name,
            'billing_last_name'    => $request->billing_last_name,
            'billing_email'        => $request->billing_email,
            'billing_phone'        => $request->billing_phone,
            'billing_address'      => $request->billing_address,
            'billing_city'         => $request->billing_city,
            'billing_state'        => $request->billing_state,
            'billing_zip_code'     => $request->billing_zip_code,
            'billing_country'      => $request->billing_country,

            // Shipping
            'shipping_first_name'  => $request->shipping_first_name,
            'shipping_last_name'   => $request->shipping_last_name,
            'shipping_address'     => $request->shipping_address,
            'shipping_city'        => $request->shipping_city,
            'shipping_state'       => $request->shipping_state,
            'shipping_zip_code'    => $request->shipping_zip_code,
            'shipping_country'     => $request->shipping_country,
            'shipping_method'      => $request->shipping_method,

            // Payment
            'payment_method'       => $request->payment_method,
            'payment_status'       => 'pending',
        ]);

        // Optionally store items to order_items table...

        session()->forget('cart');

        return redirect()->route('customer.payment.process', $order->id);
    }
}
