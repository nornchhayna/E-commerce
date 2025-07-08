@extends('customer.layouts.App')

@section('title', 'Place Order')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Place Your Order</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            {{-- Billing Info --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Billing Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="billing_first_name" placeholder="First Name" class="input" required>
                    <input type="text" name="billing_last_name" placeholder="Last Name" class="input" required>
                    <input type="email" name="billing_email" placeholder="Email" class="input" required>
                    <input type="text" name="billing_phone" placeholder="Phone" class="input">
                    <input type="text" name="billing_address" placeholder="Address" class="input" required>
                    <input type="text" name="billing_city" placeholder="City" class="input" required>
                    <input type="text" name="billing_state" placeholder="State" class="input" required>
                    <input type="text" name="billing_zip_code" placeholder="Zip Code" class="input" required>
                    <input type="text" name="billing_country" placeholder="Country" class="input" required>
                </div>
            </div>

            {{-- Shipping Info --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Shipping Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="shipping_first_name" placeholder="First Name" class="input" required>
                    <input type="text" name="shipping_last_name" placeholder="Last Name" class="input" required>
                    <input type="text" name="shipping_address" placeholder="Address" class="input" required>
                    <input type="text" name="shipping_city" placeholder="City" class="input" required>
                    <input type="text" name="shipping_state" placeholder="State" class="input" required>
                    <input type="text" name="shipping_zip_code" placeholder="Zip Code" class="input" required>
                    <input type="text" name="shipping_country" placeholder="Country" class="input" required>
                    <input type="text" name="shipping_method" placeholder="Shipping Method" class="input">
                </div>
            </div>

            {{-- Payment Method --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Payment Method</h2>
                <select name="payment_method" class="input w-full" required>
                    <option value="cod">Cash on Delivery</option>
                    <option value="card">Credit/Debit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            {{-- Notes --}}
            <div class="mb-6">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                <textarea name="notes" rows="3" class="input w-full" placeholder="Any instructions or notes..."></textarea>
            </div>

            {{-- Order Summary --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Order Summary</h2>
                <div class="bg-gray-50 p-4 border rounded">
                    <table class="w-full text-sm">
                        <thead>
                            <tr>
                                <th class="text-left py-2">Product</th>
                                <th class="text-right py-2">Quantity</th>
                                <th class="text-right py-2">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                </tr>
                            @endforeach

                            <tr class="border-t font-semibold">
                                <td class="pt-3">Subtotal</td>
                                <td></td>
                                <td class="pt-3 text-right">${{ number_format($subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <td></td>
                                <td class="text-right">${{ number_format($tax, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td></td>
                                <td class="text-right">${{ number_format($shipping, 2) }}</td>
                            </tr>
                            <tr class="text-xl font-bold border-t">
                                <td class="pt-3">Total</td>
                                <td></td>
                                <td class="pt-3 text-right">${{ number_format($total, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <!-- form fields -->
                <button type="submit">Confirm Order</button>
            </form>


        </form>
    </div>
@endsection

@push('styles')
    <style>
        .input {
            @apply border border-gray-300 rounded px-3 py-2 w-full;
        }
    </style>
@endpush