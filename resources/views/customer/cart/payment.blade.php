@extends('layouts.customer')
@section('content')
    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Payment - Order #{{ $order->order_number }}</h1>
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="mb-4">
            <p><strong>Total:</strong> ${{ $order->total_amount }}</p>
            <p><strong>Shipping:</strong> {{ $order->shipping_method }}</p>
            <p><strong>Address:</strong> {{ $order->shipping_address }}, {{ $order->shipping_city }},
                {{ $order->shipping_country }}</p>
        </div>
        <form action="{{ route('customer.payment.process', $order->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-medium">Payment Method</label>
                <select name="payment_method" id="payment_method" class="w-full border rounded p-2"
                    onchange="toggleCardFields()">
                    <option value="payway" {{ $order->payment_method === 'PayWay' ? 'selected' : '' }}>PayWay (Visa/Local
                        Cards)</option>
                    <option value="paypal" {{ $order->payment_method === 'PayPal' ? 'selected' : '' }}>PayPal/Visa</option>
                </select>
            </div>
            <div id="card_fields" class="{{ $order->payment_method !== 'PayPal' ? 'hidden' : '' }}">
                <div class="mb-4">
                    <label for="card_number" class="block">Card Number</label>
                    <input type="text" name="card_number" id="card_number" class="w-full border rounded p-2">
                </div>
                <div class="mb-4 flex gap-4">
                    <div>
                        <label for="expiry_month" class="block">Expiry Month</label>
                        <input type="text" name="expiry_month" id="expiry_month" placeholder="MM"
                            class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label for="expiry_year" class="block">Expiry Year</label>
                        <input type="text" name="expiry_year" id="expiry_year" placeholder="YYYY"
                            class="w-full border rounded p-2">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="cvv" class="block">CVV</label>
                    <input type="text" name="cvv" id="cvv" class="w-full border rounded p-2">
                </div>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Pay Now</button>
        </form>
    </div>
    <script>
        function toggleCardFields() {
            const method = document.getElementById('payment_method').value;
            document.getElementById('card_fields').classList.toggle('hidden', method !== 'paypal');
        }
    </script>
@endsection