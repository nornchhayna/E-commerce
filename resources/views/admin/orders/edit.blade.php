@extends('admin.layouts.admin')

@section('title', 'Edit Order')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Edit Order #{{ $order->order_number }}</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Order Status --}}
            <div class="mb-4">
                <label class="block font-medium text-sm mb-1" for="status">Order Status</label>
                <select name="status" id="status" class="w-full border-gray-300 rounded">
                    @foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'] as $status)
                        <option value="{{ $status }}" {{ old('status', $order->status) === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Payment Status --}}
            <div class="mb-4">
                <label class="block font-medium text-sm mb-1" for="payment_status">Payment Status</label>
                <select name="payment_status" id="payment_status" class="w-full border-gray-300 rounded">
                    @foreach (['pending', 'paid', 'failed', 'refunded'] as $status)
                        <option value="{{ $status }}" {{ old('payment_status', $order->payment_status) === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                @error('payment_status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Shipping Method --}}
            <div class="mb-4">
                <label class="block font-medium text-sm mb-1" for="shipping_method">Shipping Method</label>
                <input type="text" name="shipping_method" id="shipping_method"
                    value="{{ old('shipping_method', $order->shipping_method) }}" class="w-full border-gray-300 rounded" />
                @error('shipping_method')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Notes --}}
            <div class="mb-4">
                <label class="block font-medium text-sm mb-1" for="notes">Notes</label>
                <textarea name="notes" id="notes" rows="4"
                    class="w-full border-gray-300 rounded">{{ old('notes', $order->notes) }}</textarea>
                @error('notes')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update Order
                </button>
            </div>
        </form>
    </div>
@endsection