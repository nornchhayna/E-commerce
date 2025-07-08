<!-- resources/views/customer/catalog/partials/_product_card.blade.php -->
<div class="card h-100 product-card">
    @if($product->is_featured)
        <span class="badge bg-primary position-absolute top-0 start-0 m-2">Featured</span>
    @endif
    <a href="{{ route('customer.products.show', $product->slug) }}">
        @php
            $firstImage = is_array($product->images) && isset($product->images[0]) ? $product->images[0] : null;
            $imagePath = $firstImage ? public_path('storage/' . $firstImage) : null;
        @endphp

        @if($firstImage && file_exists($imagePath))
            <img src="{{ asset('storage/' . $firstImage) }}" class="img-fluid rounded" alt="{{ $product->name }}">
        @else
            <img src="{{ asset('images/placeholder.png') }}" class="img-fluid rounded" alt="{{ $product->name }}">
        @endif
    </a>


    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <a href="{{ route('customer.products.show', $product->slug) }}" class="text-decoration-none">
                <h5 class="card-title">{{ $product->name }}</h5>
            </a>
            @if($product->reviews_avg_rating)
                <div class="text-warning small">
                    ★ {{ number_format($product->reviews_avg_rating, 1) }}
                </div>
            @endif
        </div>

        <div class="mt-2">
            <span class="h5 text-primary">${{ number_format($product->price, 2) }}</span>
            @if($product->compare_price)
                <span
                    class="text-muted text-decoration-line-through ms-2">${{ number_format($product->compare_price, 2) }}</span>
            @endif
        </div>

        @if($product->short_description)
            <p class="card-text mt-2 text-muted small">{{ Str::limit($product->short_description, 100) }}</p>
        @endif
    </div>

    <div class="card-footer bg-white">
        <form action="{{ route('customer.cart.add') }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <form action="{{ route('cart.add') }}" method="POST" class="w-100 ms-1">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-primary w-100">Add toCart</button>
            </form>

        </form>
        <a href="{{ route('customer.products.show', $product->slug) }}" class="btn btn-sm btn-primary ms-2">
            View Details
        </a>
    </div>
</div>