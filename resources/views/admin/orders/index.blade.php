@extends('admin.layouts.admin')

@section('title', 'Orders')

@section('content')


    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Orders</h1>
            <div class="w-full max-w-xs">
                <form method="GET" action="{{ route('admin.orders.index') }}">
                    <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Search orders...">
                </form>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Order #</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Customer</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Phone</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Total</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                        {{-- <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">carrier</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tracking Number</th> --}}
                    </tr>
                </thead>
                <tbody id="ordersTable">
                    @forelse ($orders as $order)
                                <tr class="border-b hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">{{ $order->order_number }}</td>
                                    <td class="px-6 py-4">{{ $order->billing_first_name }} {{ $order->billing_last_name }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$order->status] ?? $statusClasses['default'] }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    {{-- <td class="px-6 py-4">{{ $order->carrier }}</td>
                                    <td class="px-6 py-4">{{ $order->tracking_number }}</td> --}}
                                    <td class="px-6 py-4">{{ $order->billing_phone }}</td>
                                    <td class="px-6 py-4">${{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-4 py-2 flex flex-wrap gap-2">
                                        <a href="{{ route('admin.orders.show', $order) }}"
                                            class="text-blue-600 hover:text-blue-800 transition-colors" data-bs-toggle="tooltip"
                                            title="View order details">View</a>
                                        <a href="{{ route('admin.orders.edit', $order) }}"
                                            class="text-yellow-600 hover:text-yellow-800 transition-colors" data-bs-toggle="tooltip"
                                            title="Edit order">Edit</a>
                                        <br>
                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this order?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors"
                                                data-bs-toggle="tooltip" title="Delete order">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <td colspan="6" class="px-6 py-4">
                                    <div class="ml-4">
                                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Order Details (#{{
                        $order->order_number }})</h4>
                                        <div class="text-sm text-gray-600 mb-2">
                                            <p><strong>Name:</strong> {{ $order->billing_first_name }}
                                                {{ $order->billing_last_name }}
                                            </p>
                                            <p><strong>Phone:</strong> {{ $order->billing_phone ?? 'N/A' }}</p>
                                            <p><strong>Address:</strong> {{ $order->billing_address }}, {{ $order->billing_city }},
                                                {{ $order->billing_state }} {{ $order->billing_zip_code }},
                                                {{ $order->billing_country }}
                                            </p>
                                        </div>
                                        <h5 class="text-sm font-semibold text-gray-700 mb-2">Items</h5>
                                        <ul class="list-disc ml-5 text-sm text-gray-600">
                                            @foreach ($order->items as $item)
                                                <li>{{ $item->product_name }} (Qty: {{ $item->quantity }}) -
                                                    ${{ number_format($item->total, 2) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>

                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-600">
                                No orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $orders->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Bootstrap tooltips
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            [...tooltipTriggerList].forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

            // Toggle order details
            document.querySelectorAll('tbody tr:not(.bg-gray-50)').forEach(row => {
                row.addEventListener('click', function (e) {
                    if (e.target.tagName !== 'A' && e.target.tagName !== 'BUTTON') {
                        const orderId = this.querySelector('td').textContent;
                        const detailsRow = document.getElementById(`details-${orderId}`);
                        if (detailsRow) {
                            detailsRow.classList.toggle('hidden');
                        }
                    }
                });
            });
        });
    </script>
@endsection