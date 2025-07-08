@extends('admin.layouts.admin')

@section('title', 'Product Details')

@section('content')
    @if(isset($product))
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md text-sm sm:text-base">
            <h2 class="text-2xl font-semibold mb-6 text-center">Product Details</h2>

            <div class="grid gap-4">
                <div><strong>Name:</strong> {{ $product->name ?? 'N/A' }}</div>
                <div><strong>Slug:</strong> {{ $product->slug ?? 'N/A' }}</div>
                <div><strong>Description:</strong> {!! nl2br(e($product->description ?? 'No description available')) !!}</div>

                @if(!empty($product->short_description))
                    <div><strong>Short Description:</strong> {{ $product->short_description }}</div>
                @endif

                <div><strong>SKU:</strong> {{ $product->sku ?? 'N/A' }}</div>
                <div><strong>Price:</strong> {{ $product->formatted_price ?? '$0.00' }}</div>

                @if(!empty($product->compare_price))
                    <div><strong>Compare Price:</strong> {{ $product->formatted_compare_price }}</div>
                @endif

                @if(!empty($product->cost_price))
                    <div><strong>Cost Price:</strong> {{ $product->formatted_cost_price }}</div>
                @endif

                @if(!empty($product->images) && is_array($product->images))
                    <div>
                        <strong>Images:</strong>
                        <div class="flex flex-wrap gap-3 mt-2">
                            @foreach ($product->images as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="w-24 h-24 object-cover rounded"
                                    onerror="this.style.display='none'">
                            @endforeach
                        </div>
                    </div>
                @endif

                <div><strong>Weight:</strong> {{ $product->weight ?? 'N/A' }} g</div>

                <div>
                    <strong>Dimensions:</strong>
                    @php
                        $dimensions = $product->dimensions ?? [];
                    @endphp
                    {{ $dimensions['length'] ?? 'N/A' }} x
                    {{ $dimensions['width'] ?? 'N/A' }} x
                    {{ $dimensions['height'] ?? 'N/A' }} cm
                </div>

                <div><strong>Track Inventory:</strong> {{ $product->track_inventory ? 'Yes' : 'No' }}</div>
                <div><strong>Stock Quantity:</strong> {{ $product->stock_quantity ?? 0 }}</div>
                <div><strong>Low Stock Threshold:</strong> {{ $product->low_stock_threshold ?? 'N/A' }}</div>
                <div><strong>Stock Status:</strong> {{ ucfirst(str_replace('_', ' ', $product->stock_status ?? 'unknown')) }}
                </div>
                <div><strong>Featured:</strong> {{ $product->is_featured ? 'Yes' : 'No' }}</div>

                @php
                    $attributes = $product->attributes ?? [];
                @endphp
                <div><strong>Color:</strong> {{ $attributes['color'] ?? 'N/A' }}</div>
                <div><strong>Size:</strong> {{ $attributes['size'] ?? 'N/A' }}</div>
                @foreach ($product->categories as $category)
                    <span class="badge bg-primary me-1">{{ $category->name }}</span>
                @endforeach

                <div><strong>Meta Title:</strong> {{ $product->meta_title ?? 'N/A' }}</div>
                <div><strong>Meta Description:</strong> {{ $product->meta_description ?? 'N/A' }}</div>
            </div>

            <div class="mt-6 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.products.index') }}"
                    class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 text-center">
                    ← Back to Products
                </a>
                <a href="{{ route('admin.products.edit', $product->id) }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-center">
                    ✏️ Edit Product
                </a>
            </div>
        </div>
    @else
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <div class="text-center">
                <h2 class="text-2xl font-semibold mb-4 text-red-600">Product Not Found</h2>
                <p class="mb-4">The requested product could not be found.</p>
                <a href="{{ route('admin.products.index') }}"
                    class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                    ← Back to Products
                </a>
            </div>
        </div>
    @endif

@endsection