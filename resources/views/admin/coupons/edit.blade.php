@extends('admin.layouts.admin')

@section('content')
    <div class="px-6 py-4">
        <h1 class="text-2xl font-semibold mb-4">Edit Coupon</h1>
        @if ($errors->any())
            <div class="mb-4 text-red-600 bg-red-100 border border-red-300 rounded px-4 py-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
            @csrf
            @method('PUT')
            @if (Auth::user()->role === 'super_admin')
                <div class="mb-4">
                    <label for="store_id" class="block text-sm font-medium">Store</label>
                    <select name="store_id" id="store_id" class="border rounded px-3 py-2 w-full" required>
                        <option value="">Select a store</option>
                        @foreach ($stores as $store)
                            <option value="{{ $store->id }}" {{ old('store_id', $coupon->store_id) == $store->id ? 'selected' : '' }}>
                                {{ $store->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('store_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            @endif
            <div class="mb-4">
                <label for="code" class="block text-sm font-medium">Code</label>
                <input type="text" name="code" id="code" value="{{ old('code', $coupon->code) }}"
                    class="border rounded px-3 py-2 w-full" required>
                @error('code') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $coupon->name) }}"
                    class="border rounded px-3 py-2 w-full" required>
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium">Type</label>
                <select name="type" id="type" class="border rounded px-3 py-2 w-full" required>
                    <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                    <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }}>Percentage
                    </option>
                </select>
                @error('type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="value" class="block text-sm font-medium">Value</label>
                <input type="number" name="value" id="value" step="0.01" value="{{ old('value', $coupon->value) }}"
                    class="border rounded px-3 py-2 w-full" required>
                @error('value') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium">Description</label>
                <textarea name="description" id="description"
                    class="border rounded px-3 py-2 w-full">{{ old('description', $coupon->description) }}</textarea>
                @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="minimum_amount" class="block text-sm font-medium">Minimum Amount</label>
                <input type="number" name="minimum_amount" id="minimum_amount" step="0.01"
                    value="{{ old('minimum_amount', $coupon->minimum_amount) }}" class="border rounded px-3 py-2 w-full">
                @error('minimum_amount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="maximum_discount" class="block text-sm font-medium">Maximum Discount</label>
                <input type="number" name="maximum_discount" id="maximum_discount" step="0.01"
                    value="{{ old('maximum_discount', $coupon->maximum_discount) }}"
                    class="border rounded px-3 py-2 w-full">
                @error('maximum_discount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="usage_limit" class="block text-sm font-medium">Usage Limit</label>
                <input type="number" name="usage_limit" id="usage_limit"
                    value="{{ old('usage_limit', $coupon->usage_limit) }}" class="border rounded px-3 py-2 w-full">
                @error('usage_limit') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="usage_limit_per_user" class="block text-sm font-medium">Usage Limit Per User</label>
                <input type="number" name="usage_limit_per_user" id="usage_limit_per_user"
                    value="{{ old('usage_limit_per_user', $coupon->usage_limit_per_user) }}"
                    class="border rounded px-3 py-2 w-full">
                @error('usage_limit_per_user') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="is_active" class="block text-sm font-medium">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}> Active
                </label>
                @error('is_active') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="starts_at" class="block text-sm font-medium">Starts At</label>
                <input type="date" name="starts_at" id="starts_at"
                    value="{{ old('starts_at', $coupon->starts_at ? $coupon->starts_at->format('Y-m-d') : '') }}"
                    class="border rounded px-3 py-2 w-full">
                @error('starts_at') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="expires_at" class="block text-sm font-medium">Expires At</label>
                <input type="date" name="expires_at" id="expires_at"
                    value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : '') }}"
                    class="border rounded px-3 py-2 w-full">
                @error('expires_at') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Coupon</button>
        </form>
    </div>
@endsection