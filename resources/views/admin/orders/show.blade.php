@extends('admin.layouts.admin')

@section('title', 'Order Details')

@section('content')
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Order #{{ $order->order_number }}</h2>

        <div class="mb-6">
            <h3 class="font-semibold mb-2">Order Summary</h3>
            <ul>
                <li>Status: <strong>{{ ucfirst($order->status) }}</strong></li>
                <li>Total: <strong>${{ number_format($order->total_amount, 2) }}</strong></li>
                <li>Payment Method: <strong>{{ $order->payment_method }}</strong></li>
                <li>Payment Status: <strong>{{ ucfirst($order->payment_status) }}</strong></li>
                <li>Transaction ID: <strong>{{ $order->transaction_id ?? 'N/A' }}</strong></li>
                <li>Payment Date: <strong>{{ $order->payment_date ?? 'N/A' }}</strong></li>
            </ul>
        </div>

        <div class="mb-6 grid grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold mb-2">Billing Information</h3>
                <ul>
                    <li>Name: {{ $order->billing_first_name }} {{ $order->billing_last_name }}</li>
                    <li>Email: {{ $order->billing_email }}</li>
                    <li>Phone: {{ $order->billing_phone ?? 'N/A' }}</li>
                    <li>Address: {{ $order->billing_address }}, {{ $order->billing_city }}, {{ $order->billing_state }}
                        {{ $order->billing_zip_code }}, {{ $order->billing_country }}
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-2">Shipping Information</h3>
                <ul>
                    <li>Name: {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</li>
                    <li>Method: {{ $order->shipping_method ?? 'N/A' }}</li>
                    <li>Address: {{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_state }}
                        {{ $order->shipping_zip_code }}, {{ $order->shipping_country }}
                    </li>
                </ul>
            </div>
        </div>

        @if ($order->notes)
            <div class="mb-6">
                <h3 class="font-semibold mb-2">Customer Notes</h3>
                <p class="text-gray-700">{{ $order->notes }}</p>
            </div>
        @endif

        <a href="{{ route('admin.orders.index') }}" class="text-blue-500 hover:underline">← Back to Orders</a>
    </div>
@endsection