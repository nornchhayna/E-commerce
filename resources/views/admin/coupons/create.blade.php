@extends('admin.layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto px-6 py-6">
        <h1 class="text-2xl font-semibold mb-6">Create New Coupon</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-600 bg-red-100 border border-red-300 rounded px-4 py-2">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.coupons.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
            @csrf

            <div>
                <label class="block text-sm font-medium">Coupon Code <span class="text-red-600">*</span></label>
                <input type="text" name="code" value="{{ old('code') }}" required
                    class="mt-1 w-full border-gray-300 rounded shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium">Name <span class="text-red-600">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="mt-1 w-full border-gray-300 rounded shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" rows="3"
                    class="mt-1 w-full border-gray-300 rounded shadow-sm">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Type <span class="text-red-600">*</span></label>
                <select name="type" required class="mt-1 w-full border-gray-300 rounded shadow-sm">
                    <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>Fixed</option>
                    <option value="percentage" {{ old('type') === 'percentage' ? 'selected' : '' }}>Percentage</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">Value <span class="text-red-600">*</span></label>
                <input type="number" step="0.01" name="value" value="{{ old('value') }}" required
                    class="mt-1 w-full border-gray-300 rounded shadow-sm">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Minimum Amount</label>
                    <input type="number" step="0.01" name="minimum_amount" value="{{ old('minimum_amount') }}"
                        class="mt-1 w-full border-gray-300 rounded shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium">Maximum Discount</label>
                    <input type="number" step="0.01" name="maximum_discount" value="{{ old('maximum_discount') }}"
                        class="mt-1 w-full border-gray-300 rounded shadow-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Usage Limit</label>
                    <input type="number" name="usage_limit" value="{{ old('usage_limit') }}"
                        class="mt-1 w-full border-gray-300 rounded shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium">Usage Limit Per User</label>
                    <input type="number" name="usage_limit_per_user" value="{{ old('usage_limit_per_user') }}"
                        class="mt-1 w-full border-gray-300 rounded shadow-sm">
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <label class="text-sm font-medium">Active?</label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Starts At</label>
                    <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}"
                        class="mt-1 w-full border-gray-300 rounded shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium">Expires At</label>
                    <input type="datetime-local" name="expires_at" value="{{ old('expires_at') }}"
                        class="mt-1 w-full border-gray-300 rounded shadow-sm">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded">
                    Save Coupon
                </button>
                <a href="{{ route('admin.coupons.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection