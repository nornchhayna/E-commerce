@extends('admin.layouts.admin')

@section('title', 'Add Inventory Record')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add Inventory Record</h1>

    <form action="{{ route('admin.inventory.store') }}" method="POST" class="max-w-lg bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="product_id" class="block font-medium mb-1">Product</label>
            <select name="product_id" id="product_id"
                class="w-full border rounded p-2 @error('product_id') border-red-500 @enderror">
                <option value="">Select a product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="type" class="block font-medium mb-1">Type</label>
            <select name="type" id="type" class="w-full border rounded p-2 @error('type') border-red-500 @enderror">
                <option value="">Select type</option>
                <option value="adjustment" {{ old('type') == 'adjustment' ? 'selected' : '' }}>Adjustment</option>
                <option value="sale" {{ old('type') == 'sale' ? 'selected' : '' }}>Sale</option>
                <option value="purchase" {{ old('type') == 'purchase' ? 'selected' : '' }}>Purchase</option>
                <option value="return" {{ old('type') == 'return' ? 'selected' : '' }}>Return</option>
            </select>
            @error('type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="quantity_change" class="block font-medium mb-1">Quantity Change</label>
            <input type="number" name="quantity_change" id="quantity_change" value="{{ old('quantity_change') }}"
                class="w-full border rounded p-2 @error('quantity_change') border-red-500 @enderror" required>
            @error('quantity_change')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="quantity_before" class="block font-medium mb-1">Quantity Before</label>
            <input type="number" name="quantity_before" id="quantity_before" value="{{ old('quantity_before') }}"
                class="w-full border rounded p-2 @error('quantity_before') border-red-500 @enderror" required>
            @error('quantity_before')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="quantity_after" class="block font-medium mb-1">Quantity After</label>
            <input type="number" name="quantity_after" id="quantity_after" value="{{ old('quantity_after') }}"
                class="w-full border rounded p-2 @error('quantity_after') border-red-500 @enderror" required>
            @error('quantity_after')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="reason" class="block font-medium mb-1">Reason (optional)</label>
            <input type="text" name="reason" id="reason" value="{{ old('reason') }}"
                class="w-full border rounded p-2 @error('reason') border-red-500 @enderror">
            @error('reason')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="notes" class="block font-medium mb-1">Notes (optional)</label>
            <textarea name="notes" id="notes" rows="3"
                class="w-full border rounded p-2 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
            @error('notes')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Save
        </button>
    </form>
@endsection