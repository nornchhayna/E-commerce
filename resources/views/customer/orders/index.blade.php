@extends('customer.layouts.App')

@section('title', 'My Orders')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">My Orders</h1>

        @if($orders->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 shadow rounded">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="py-3 px-4 text-left">Order #</th>
                            <th class="py-3 px-4 text-left">Date</th>
                            <th class="py-3 px-4 text-left">Status</th>
                            <th class="py-3 px-4 text-left">Total</th>
                            <th class="py-3 px-4 text-left">Payment</th>
                            <th class="py-3 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-t border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 font-medium">{{ $order->order_number }}</td>
                                <td class="py-3 px-4">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="py-3 px-4 capitalize">{{ $order->status }}</td>
                                <td class="py-3 px-4">${{ number_format($order->total_amount, 2) }} {{ $order->currency }}</td>
                                <td class="py-3 px-4 capitalize">{{ $order->payment_status }}</td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('customer.orders.show', $order->id) }}"
                                        class="text-blue-600 hover:underline">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        @else
            <div class="bg-yellow-50 text-yellow-800 p-4 rounded">
                You have not placed any orders yet.
            </div>
        @endif
    </div>
    <h1>My Orders</h1>
    @foreach ($orders as $order)
        <div>
            <a href="{{ route('customer.orders.show', $order->id) }}">Order #{{ $order->id }}</a> - {{ $order->status }}
        </div>
    @endforeach

    {{ $orders->links() }}

@endsection