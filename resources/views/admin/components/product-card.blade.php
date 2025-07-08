{{-- resources/views/admin/components/product-card.blade.php --}}
<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-xl font-semibold mb-4">{{ $title ?? 'Product Details' }}</h3>

    <div class="grid md:grid-cols-2 gap-6">
        <!-- Product Images -->
        @if(!empty($product->images) && is_array($product->images))
            <div>
                <div class="flex flex-wrap gap-3">
                    @foreach ($product->images as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Product Image"
                            class="w-24 h-24 object-cover rounded-lg" onerror="this.style.display='none'">
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Product Details -->
        <div class="space-y-3">
            <div><strong>Name:</strong> {{ $product->name ?? 'N/A' }}</div>
            <div><strong>SKU:</strong> {{ $product->sku ?? 'N/A' }}</div>
            <div><strong>Price:</strong> ${{ number_format((float) ($product->price ?? 0), 2) }}</div>

            @if(!empty($product->compare_price))
                <div><strong>Compare Price:</strong> ${{ number_format((float) $product->compare_price, 2) }}</div>
            @endif

            <div><strong>Stock:</strong> {{ $product->stock_quantity ?? 0 }}</div>
            <div><strong>Status:</strong>
                <span
                    class="px-2 py-1 rounded text-sm {{ $product->stock_status === 'in_stock' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ ucfirst(str_replace('_', ' ', $product->stock_status ?? 'unknown')) }}
                </span>
            </div>

            @if($showActions ?? true)
                <div class="flex gap-3 pt-4">
                    <a href="{{ route('admin.products.show', $product->id) }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                        View Details
                    </a>
                    <a href="{{ route('admin.products.edit', $product->id) }}"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                        Edit
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>