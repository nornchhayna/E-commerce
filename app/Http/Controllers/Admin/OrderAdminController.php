<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Str;

class OrderAdminController extends Controller
{
    public function store(Request $request)
    {
        // Fetch order items for the authenticated user
        $orderItems = OrderItem::where('user_id', Auth::id())->with('product')->get();

        // Group items by admin_id
        $itemsByAdmin = $orderItems->groupBy('product.admin_id');

        // Store created orders
        $orders = [];

        foreach ($itemsByAdmin as $adminId => $items) {
            $total = $items->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            // Create a new order
            $order = Order::create([
                'user_id' => Auth::id(),
                'admin_id' => $adminId,
                'total' => $total,
                'status' => 'pending',
            ]);

            // Create order items for the order
            foreach ($items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            $orders[] = $order;
        }

        // Clear cart items
        OrderItem::where('user_id', Auth::id())->delete();

        return redirect()->route('customer.orders.index')
            ->with('success', 'Orders placed successfully');
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $user = Auth::user();

        // Get the store ID for the logged-in admin.
        // We assume every admin is associated with a store to see orders.
        $storeId = $user->store_id;

        // Start the query and filter by the admin's store ID.
        // If storeId is null, this will correctly return no orders.
        $query = Order::where('store_id', $storeId)->with('user')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhere('billing_first_name', 'like', "%{$search}%")
                    ->orWhere('billing_last_name', 'like', "%{$search}%")
                    ->orWhere('billing_phone', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(10);
        $statusClasses = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'default' => 'bg-gray-100 text-gray-800',
        ];

        return view('admin.orders.index', compact('orders', 'statusClasses'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,refunded',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
            'shipping_method' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $oldStatus = $order->status;
        $order->update($validated);

        // Notify user only if status changed
        if ($oldStatus !== $order->status) {
            $notification = new OrderStatusUpdated($order);

            // Manually create the database notification to include the custom 'store_id'
            DatabaseNotification::create([
                'id' => Str::uuid(),
                'type' => get_class($notification),
                'notifiable_type' => get_class($order->user),
                'notifiable_id' => $order->user->id,
                'data' => $notification->toDatabase($order->user),
                'store_id' => $order->store_id,
            ]);

            // Send the email notification
            $order->user->notify($notification);
        }

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        // Consider adding a confirmation check before deletion
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
