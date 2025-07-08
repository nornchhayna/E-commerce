@extends('admin.layouts.admin')

@section('title', 'Add Product')

@section('content')
    <div class="max-w-4xl mx-auto bg-gray-200 p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Add New Product</h2>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-4">
            @csrf

            <!-- Product Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    rows="4" required>{{ old('description') }}</textarea>
            </div>

            <!-- Short Description -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Short Description</label>
                <textarea name="short_description"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    rows="2">{{ old('short_description') }}</textarea>
            </div>

            <!-- SKU -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">SKU</label>
                <input type="text" name="sku" value="{{ old('sku') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <!-- Prices -->
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Compare Price</label>
                    <input type="number" step="0.01" name="compare_price" value="{{ old('compare_price') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Cost Price</label>
                    <input type="number" step="0.01" name="cost_price" value="{{ old('cost_price') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Images -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Images (Max 5)</label>
                <input type="file" name="images[]" multiple
                    accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-sm text-gray-500 mt-1">Upload up to 5 images (JPEG, PNG, JPG, GIF, WebP, max 2MB each).</p>
            </div>

            <!-- Dimensions -->
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Length (cm)</label>
                    <input type="number" step="0.01" name="length" value="{{ old('length') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Width (cm)</label>
                    <input type="number" step="0.01" name="width" value="{{ old('width') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Height (cm)</label>
                    <input type="number" step="0.01" name="height" value="{{ old('height') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Stock Information -->
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Weight (g)</label>
                    <input type="number" name="weight" value="{{ old('weight') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Low Stock Threshold</label>
                    <input type="number" name="low_stock_threshold" value="{{ old('low_stock_threshold') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Track Inventory & Status -->
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Track Inventory</label>
                    <input type="checkbox" name="track_inventory" value="1" id="track_inventory"
                        {{ old('track_inventory') ? 'checked' : '' }}
                        class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stock Status</label>
                    <select name="stock_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="in_stock" {{ old('stock_status') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="out_of_stock" {{ old('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        <option value="backorder" {{ old('stock_status') == 'backorder' ? 'selected' : '' }}>Backorder</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Featured</label>
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                        class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                </div>
            </div>

            <!-- Attributes -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Color</label>
                    <input type="text" name="color" value="{{ old('color') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Size</label>
                    <input type="text" name="size" value="{{ old('size') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="form-group">
                <label for="categories">Categories</label>
                <div id="categories">
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="categories[]"
                                value="{{ $category->id }}"
                                id="category_{{ $category->id }}"
                            >
                            <label class="form-check-label" for="category_{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            
            
            
            <!-- Meta Info -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Meta Description</label>
                <textarea name="meta_description"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    rows="2">{{ old('meta_description') }}</textarea>
            </div>

            <!-- Active Status -->
            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <span class="ml-2 text-sm font-medium text-gray-700">Active</span>
                </label>
            </div>

            <!-- Submit -->
            <div class="mt-6">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Create Product
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript for Conditional Stock Quantity -->
    <script>
        document.getElementById('track_inventory').addEventListener('change', function () {
            const stockQuantity = document.getElementById('stock_quantity');
            stockQuantity.required = this.checked;
        });
        // Trigger on page load to set initial state
        document.getElementById('track_inventory').dispatchEvent(new Event('change'));
    </script>
@endsection