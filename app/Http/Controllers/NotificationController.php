<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderShipped;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications->sortByDesc('created_at');

        return view('customer.notifications.index', compact('notifications'));
    }

    public function sendToCustomer($customerId, $orderId)
    {
        $customer = User::findOrFail($customerId);
        $order = Order::findOrFail($orderId);

        $customer->notify(new OrderShipped($order));

        return response()->json(['message' => 'Notification sent to customer.']);
    }
}
