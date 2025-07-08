<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Notifications\NewOrderNotification;
use Illuminate\Notifications\Notifiable;
use App\Notifications\OrderConfirmation;

class OrderController extends Controller
{
    // Step 1: Show shipping info form
    public function create()
    {
        return view('customer.orders.create');
    }

    // Store order in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'billing_first_name' => 'required|string|max:255',
            'billing_last_name' => 'required|string|max:255',
            'billing_email' => 'required|email',
            // Add other validation rules for billing/shipping fields...
        ]);

        // Generate a unique tracking number
        $trackingNumber = $this->generateTrackingNumber();

        $cartItems = session('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        $firstProductId = array_key_first($cartItems);
        $product = Product::find($firstProductId);
        if (!$product) {
            return redirect()->route('cart.index')->with('error', 'An item in your cart is invalid.');
        }

        // Create order with validated data
        $order = Order::create([
            'store_id' => $product->store_id,
            'order_number' => 'CHHAYNA-' . strtoupper(Str::random(10)),
            'user_id' => Auth::id(),
            'status' => 'pending',
            'tracking_number' => $trackingNumber,
            'subtotal' => 0, // Initialize as needed
            'tax_amount' => 0, // Initialize as needed
            'shipping_amount' => 0, // Initialize as needed
            'discount_amount' => 0, // Initialize as needed
            'total_amount' => 0, // Initialize as needed
            'currency' => 'USD',
            'billing_first_name' => $validated['billing_first_name'],
            'billing_last_name' => $validated['billing_last_name'],
            'billing_email' => $validated['billing_email'],
            // Include other billing & shipping data here...
        ]);


        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewOrderNotification($order));
        }

        // Redirect to payment page
        return redirect()->route('customer.orders.payment', $order->id);
    }


    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'billing_first_name' => 'required|string|max:255',
            'billing_last_name' => 'required|string|max:255',
            'billing_email' => 'required|email',
            // Add other validation rules for billing/shipping fields...
        ]);

        // Generate a unique tracking number
        $trackingNumber = $this->generateTrackingNumber();

        $cartItems = session('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        $firstProductId = array_key_first($cartItems);
        $product = Product::find($firstProductId);
        if (!$product) {
            return redirect()->route('cart.index')->with('error', 'An item in your cart is invalid.');
        }

        // Create order with validated data
        $order = Order::create([
            'store_id' => $product->store_id,
            'order_number' => 'CHHAYNA-' . strtoupper(Str::random(10)),
            'user_id' => Auth::id(),
            'status' => 'pending',
            'tracking_number' => $trackingNumber,
            'subtotal' => 0,
            'tax_amount' => 0,
            'shipping_amount' => 0,
            'discount_amount' => 0,
            'total_amount' => 0,
            'currency' => 'USD',
            'billing_first_name' => $validated['billing_first_name'],
            'billing_last_name' => $validated['billing_last_name'],
            'billing_email' => $validated['billing_email'],
            // Add other fields...
        ]);

        // Redirect to the order tracking page
        return redirect()->route('customer.orders.track', $order->id);
    }

    // Generate a unique tracking number
    private function generateTrackingNumber()
    {
        do {
            $trackingNumber = strtoupper('TRACK-' . bin2hex(random_bytes(5)));
        } while (Order::where('tracking_number', $trackingNumber)->exists());

        return $trackingNumber;
    }

    // Show payment form
    public function payment(Order $order)
    {
        return view('customer.orders.payment', compact('order'));
    }
    public function confirmOrder(Order $order)
    {
        $order->update(['status' => 'confirmed']);  // Or whatever your status is

        // Notify user about order confirmation
        $order->user->notify(new OrderConfirmation($order));

        return redirect()->back()->with('success', 'Order confirmed and user notified!');
    }



    public function track()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('customer.orders.track', compact('orders'));
    }
    public function trackOrder(Request $request, $order_number)
    {
        // Validate order number
        $request->validate([
            'order_number' => 'required|string',
        ]);

        // Fetch the order using the provided order number
        $order = Order::where('order_number', $order_number)
            ->where('user_id', Auth::id()) // Ensure it belongs to the logged-in user
            ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found or you do not have access to it.');
        }

        // Return to the tracking form view with order details
        return view('orders.track_form', compact('order'));
    }


    // Validate & store shipping info in session
    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            // Validation rules for billing + shipping fields...
        ]);

        session([
            'shipping_info' => $request->only([
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
            ])
        ]);

        $cartItems = session('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Get store_id from the first product in the cart
        $firstProductId = array_key_first($cartItems);
        $product = Product::find($firstProductId);

        if (!$product) {
            return redirect()->route('cart.index')->with('error', 'An item in your cart is invalid.');
        }


        $order = Order::create([
            'store_id' => $product->store_id, // Add store_id to the order
            'order_number' => 'CHHAYNA-' . strtoupper(Str::random(10)),
            'user_id' => Auth::id(),
            'status' => 'pending',
            'subtotal' => 0,
            'tax_amount' => 0,
            'shipping_amount' => 0,
            'discount_amount' => 0,
            'total_amount' => 0,
            'currency' => 'USD',

            'billing_first_name' => $request->input('billing_first_name'),
            'billing_last_name' => $request->input('billing_last_name'),
            'billing_email' => $request->input('billing_email'),
            'billing_phone' => $request->input('billing_phone'),
            'billing_address' => $request->input('billing_address'),
            'billing_city' => $request->input('billing_city'),
            'billing_state' => $request->input('billing_state'),
            'billing_zip_code' => $request->input('billing_zip_code'),
            'billing_country' => $request->input('billing_country'),

            'shipping_first_name' => $request->input('shipping_first_name'),
            'shipping_last_name' => $request->input('shipping_last_name'),
            'shipping_address' => $request->input('shipping_address'),
            'shipping_city' => $request->input('shipping_city'),
            'shipping_state' => $request->input('shipping_state'),
            'shipping_zip_code' => $request->input('shipping_zip_code'),
            'shipping_country' => $request->input('shipping_country'),

            'payment_method' => 'pending', // Default value
        ]);

        //Auth::user()->notify(new OrderConfirmation($order));

        return redirect()->route('customer.orders.payment', $order->id);
    }

    // Store payment information and finalize order
    public function storePayment(Request $request, Order $order)
    {
        // Early authorization check
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Validate request
        $validated = $request->validate([
            'payment_method' => 'required|string',
        ]);

        // Check required session data
        $shippingInfo = session('shipping_info');
        if (!$shippingInfo) {
            return redirect()->route('customer.orders.create')->with('error', 'Shipping info missing.');
        }

        $cartItems = session('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('customer.orders.create')->with('error', 'Cart is empty.');
        }

        // Validate stock availability
        $stockValidation = $this->validateStock($cartItems);
        if (!$stockValidation['valid']) {
            return redirect()->back()->withErrors(['stock' => $stockValidation['message']])->withInput();
        }

        // Use database transaction for data consistency
        try {
            DB::transaction(function () use ($order, $cartItems, $shippingInfo, $validated) {
                Log::info('Starting order transaction', ['order_id' => $order->id]);

                // Calculate totals
                $calculations = $this->calculateOrderTotals($cartItems);

                // Update order with all data at once
                $order->update([
                    'billing_first_name' => $shippingInfo['billing_first_name'],
                    'billing_last_name' => $shippingInfo['billing_last_name'],
                    'billing_email' => $shippingInfo['billing_email'],
                    'payment_method' => $validated['payment_method'],
                    'payment_status' => 'paid',
                    'payment_date' => now(),
                    'status' => 'processing',
                    'coupon_code' => $calculations['coupon_code'],
                    'subtotal' => $calculations['subtotal'],
                    'tax_amount' => $calculations['tax'],
                    'shipping_amount' => $calculations['shipping'],
                    'discount_amount' => $calculations['discount'],
                    'total_amount' => $calculations['total'],
                ]);

                Log::info('Order updated successfully', ['order_id' => $order->id]);

                // Create order items and update stock
                $this->createOrderItemsAndUpdateStock($order, $cartItems);

                Log::info('Order items created and stock updated', ['order_id' => $order->id]);
            });
        } catch (\Exception $e) {
            Log::error('Order transaction failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->withErrors(['payment' => 'Payment processing failed. Please try again.'])->withInput();
        }

        // Clear session data
        session()->forget(['shipping_info', 'cart', 'coupon']);

        return redirect()->route('customer.orders.show', $order->id)->with('success', 'Payment successful and order placed!');
    }

    // Validate stock availability for all cart items
    private function validateStock(array $cartItems): array
    {
        $errors = [];

        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem['id']);

            if (!$product) {
                $errors[] = "Product '{$cartItem['name']}' is no longer available.";
                continue;
            }

            if ($product->stock_quantity <= 0) {
                $errors[] = "'{$cartItem['name']}' is currently out of stock.";
            } elseif ($product->stock_quantity < $cartItem['quantity']) {
                $available = $product->stock_quantity;
                $requested = $cartItem['quantity'];
                $errors[] = "Insufficient stock for '{$cartItem['name']}'. Available: {$available}, Requested: {$requested}";
            }
        }

        if (!empty($errors)) {
            return [
                'valid' => false,
                'message' => implode(' ', $errors)
            ];
        }

        return ['valid' => true, 'message' => ''];
    }

    // Calculate order totals including tax, shipping, and discounts
    private function calculateOrderTotals(array $cartItems): array
    {
        $subtotal = collect($cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $tax = $subtotal * 0.1; // 10% tax
        $shipping = 5.00;

        $coupon = session('coupon');
        $discount = $coupon['discount'] ?? 0;
        $couponCode = $coupon['code'] ?? null;

        $total = $subtotal + $tax + $shipping - $discount;

        return [
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'discount' => $discount,
            'coupon_code' => $couponCode,
            'total' => $total,
        ];
    }

    // Create order items and update product stock
    private function createOrderItemsAndUpdateStock(Order $order, array $cartItems): void
    {
        foreach ($cartItems as $cartItem) {
            Log::info('Processing cart item', [
                'product_id' => $cartItem['id'],
                'product_name' => $cartItem['name'],
                'quantity' => $cartItem['quantity']
            ]);

            // Create order item
            $orderItem = $order->items()->create([
                'product_id' => $cartItem['id'],
                'product_name' => $cartItem['name'],
                'product_sku' => $cartItem['sku'],
                'quantity' => $cartItem['quantity'],
                'price' => $cartItem['price'],
                'total' => $cartItem['price'] * $cartItem['quantity'],
            ]);

            Log::info('Order item created', ['order_item_id' => $orderItem->id]);

            // Update stock safely (prevent going below 0)
            $product = Product::find($cartItem['id']);

            if (!$product) {
                Log::error('Product not found', ['product_id' => $cartItem['id']]);
                throw new \Exception("Product not found: " . $cartItem['id']);
            }

            $oldStock = $product->stock_quantity;
            $newStock = max(0, $product->stock_quantity - $cartItem['quantity']);

            Log::info('Updating product stock', [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'old_stock' => $oldStock,
                'quantity_ordered' => $cartItem['quantity'],
                'new_stock' => $newStock
            ]);

            $updated = $product->update(['stock_quantity' => $newStock]);

            if ($updated) {
                Log::info('Stock updated successfully', [
                    'product_id' => $product->id,
                    'final_stock' => $product->fresh()->stock_quantity
                ]);
            } else {
                Log::error('Failed to update stock', ['product_id' => $product->id]);
            }
        }
    }

    // Show order details
    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        return view('customer.orders.show', compact('order'));
    }


    // List all orders for user
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        return view('customer.orders.index', compact('orders'));
    }
}
