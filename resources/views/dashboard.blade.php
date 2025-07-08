@extends('customer.layouts.app')

@section('content')




<style>
    /* Base Styles */
.catalog-section {
    background-color: #ffffff;
    position: relative;
    overflow: hidden;
    padding: 2.5rem 0;
}

/* Floating Shapes Animation (neutral and subtle) */
.floating-shape {
    position: absolute;
    background: rgba(107, 114, 128, 0.05); /* Very light gray */
    border-radius: 50%;
    filter: blur(30px);
    animation: float 12s infinite ease-in-out;
}

.floating-shape-1 {
    width: 250px;
    height: 250px;
    top: 15%;
    left: 5%;
    animation-delay: 0s;
}

.floating-shape-2 {
    width: 350px;
    height: 350px;
    bottom: 15%;
    right: 5%;
    animation-delay: 3s;
}

.floating-shape-3 {
    width: 200px;
    height: 200px;
    top: 65%;
    left: 25%;
    animation-delay: 6s;
}

@keyframes float {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-15px);
    }
}

/* Catalog Header */
.catalog-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    gap: 1.5rem;
    flex-wrap: wrap;
    padding: 0 1rem;
}

/* Filter Row */
.filter-row {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    flex-wrap: wrap;
    width: 100%;
    max-width: 900px;
    background-color: #ffffff;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
}

.filter-group {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.filter-label {
    font-weight: 500;
    color: #374151;
    margin-right: 1rem;
    white-space: nowrap;
    font-size: 0.95rem;
}

.filter-input {
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 0.5rem 0.75rem;
    font-size: 0.9rem;
    background-color: #ffffff;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    width: 100px;
}

.filter-input:focus {
    border-color: #374151;
    box-shadow: 0 0 0 2px rgba(55, 65, 81, 0.1);
    outline: none;
}

.filter-btn {
    background-color: #374151;
    color: #ffffff;
    font-weight: 500;
    padding: 0.5rem 1.25rem;
    border-radius: 6px;
    border: none;
    transition: background-color 0.2s ease, transform 0.2s ease;
    cursor: pointer;
}

.filter-btn:hover {
    background-color: #4b5563;
    transform: translateY(-1px);
}

.sort-select {
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    color: #374151;
    background-color: #ffffff;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    min-width: 180px;
}

.sort-select:focus {
    border-color: #374151;
    box-shadow: 0 0 0 2px rgba(55, 65, 81, 0.1);
    outline: none;
}

/* Catalog Title */
.catalog-title {
    font-size: 2.25rem;
    font-weight: 700;
    color: #374151;
    margin: 0;
}

/* Product Grid */
.product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem;
    padding: 0 1rem;
}

/* Product Card */
.product-card {
    transition: transform 0.2s ease;
}

.product-card .card {
    border-radius: 8px;
    overflow: hidden;
    background: #ffffff;
    border: 1px solid #e5e7eb;
}

.product-card:hover {
    transform: translateY(-4px);
}

.product-card:hover .card {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.product-link {
    text-decoration: none;
    display: block;
    color: #374151;
}

/* Image Container */
.image-container {
    height: 220px;
    width: 100%;
    position: relative;
    background-color: #ffffff;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.product-card:hover .product-image {
    transform: scale(1.02);
}

.discount-badge {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background-color: #e5e7eb;
    color: #374151;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
}

/* Card Body */
.card-body {
    padding: 1rem;
}

.product-name {
    font-size: 1.1rem;
    color: #374151;
    font-weight: 600;
    margin-bottom: 0.5rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.price-container {
    display: flex;
    align-items: baseline;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
}

.product-price {
    font-size: 1.15rem;
    color: #374151;
    font-weight: 600;
}

.compare-price {
    font-size: 0.85rem;
    color: #9ca3af;
    text-decoration: line-through;
}

/* Card Footer */
.card-footer {
    background: #ffffff;
    border: none;
    padding: 0.75rem;
    display: flex;
    gap: 0.5rem;
    border-top: 1px solid #e5e7eb;
}

.btn-view-details {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    color: #374151;
    font-weight: 500;
    padding: 0.25rem 0.75rem;
    border-radius: 6px;
    transition: all 0.2s ease;
    text-align: center;
    flex-grow: 1;
}

.btn-view-details:hover {
    background: #f9fafb;
    border-color: #374151;
    color: #374151;
}

.btn-add-cart {
    background-color: #374151;
    color: #ffffff;
    font-weight: 500;
    padding: 0.25rem 0.75rem;
    border-radius: 6px;
    border: none;
    transition: background-color 0.2s ease, transform 0.2s ease;
    text-align: center;
    flex-grow: 1;
    cursor: pointer;
}

.btn-add-cart:hover {
    background-color: #4b5563;
    transform: translateY(-1px);
}

/* Empty State */
.no-products {
    text-align: center;
    padding: 2rem;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    margin: 1.5rem auto;
    max-width: 400px;
}

.empty-icon-bg {
    position: absolute;
    width: 80px;
    height: 80px;
    background: rgba(107, 114, 128, 0.05);
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.animated-icon {
    animation: pulse 1.5s infinite ease-in-out;
    color: #9ca3af;
    font-size: 2rem;
}

@keyframes pulse {
    0%,
    100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

/* Pagination */
.pagination-wrapper {
    background: #ffffff;
    border-radius: 6px;
    padding: 0.5rem 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    margin-top: 2rem;
    display: inline-flex;
    justify-content: center;
}

.pagination a {
    color: #374151;
    padding: 0.25rem 0.75rem;
    border-radius: 4px;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.2s ease;
}

.pagination a:hover {
    color: #4b5563;
    background-color: #f9fafb;
}

.pagination .current {
    background-color: #f9fafb;
    color: #374151;
    font-weight: 600;
}

/* Responsive Adjustments */
@media (max-width: 1200px) {
    .product-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 992px) {
    .product-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .filter-row {
        gap: 1rem;
    }
}

@media (max-width: 576px) {
    .product-grid {
        grid-template-columns: 1fr;
    }

    .catalog-title {
        font-size: 1.75rem;
    }

    .image-container {
        height: 180px;
    }

    .filter-row {
        gap: 0.75rem;
    }
}
</style>



    <section class="catalog-section position-relative overflow-hidden py-5">
    

        <div class="catalog-container">


            <div class="catalog-header">
                <div class="filter-row">
                    <form method="GET" action="{{ route('catalog.index') }}">
                        <div class="filter-group">
                            <label class="filter-label">Price Range</label>
                            <div class="d-flex gap-2">
                                <input type="number" name="min_price" class="filter-input" placeholder="Min"
                                    value="{{ request('min_price') }}">
                                <input type="number" name="max_price" class="filter-input" placeholder="Max"
                                    value="{{ request('max_price') }}">
                            </div>
                            <button type="submit" class="filter-btn">Apply Filters</button>
                        </div>
                    </form>
                 
                </div>
                <select class="sort-select" onchange="window.location.href=this.value">
                    <option value="{{ route('catalog.index', array_merge(request()->query(), ['sort' => 'newest'])) }}"
                        {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option
                        value="{{ route('catalog.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}"
                        {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option
                        value="{{ route('catalog.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}"
                        {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>
            <!-- Product List -->
            <div class="col-lg-12">

                @if ($products->count())
                    <div class="product-grid">
                        @foreach ($products as $product)
                            <div class="product-card">
                                <div class="card h-90 position-relative">
                                    <div class="gradient-border"></div>
                                    <a href="{{ route('catalog.products.show', ['slug' => $product->slug, 'id' => $product->id]) }}" class="product-link">
                                      
                                            
                                            <div class="image-container">
                                                @php
                                                    $images = json_decode($product->images, true);
                                                    $firstImage = is_array($images) && !empty($images) ? $images[0] : null;
                                                    $imageUrl = $firstImage ? asset('storage/' . $firstImage) : asset('images/placeholder.png');
                                                @endphp
                                                <img src="{{ $imageUrl }}" class="product-image" alt="{{ $product->name }}">
                                                <div class="image-overlay"></div>
                                                @if ($product->compare_price && $product->compare_price > $product->price)
                                                    <div class="discount-badge">
                                                        {{ round((floatval(str_replace(',', '', $product->compare_price)) - floatval(str_replace(',', '', $product->price))) / floatval(str_replace(',', '', $product->compare_price)) * 100) }}%
                                                        OFF
                                                    </div>
                                                @endif
                                            </div>
                                       
                                        <div class="card-body">
                                            <h5 class="product-name" title="{{ $product->name }}">{{ $product->name }}
                                            </h5>
                                            <div class="price-container">
                                                <span
                                                    class="product-price">${{ number_format(floatval(str_replace(',', '', $product->price)), 2) }}</span>
                                                @if ($product->compare_price)
                                                    <span
                                                        class="compare-price">${{ number_format(floatval(str_replace(',', '', $product->compare_price)), 2) }}</span>
                                                @endif
                                            </div>
                                         
                                        </div>
                                    </a>
                                    <div class="card-footer">
                                        <form action="{{ route('wishlist.store') }}" method="POST"
                                        class="position-absolute top-0 end-0 m-3" style="z-index: 20;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-light btn-sm rounded-circle p-2 shadow action-btn"
                                            data-bs-toggle="tooltip" title="Add to Wishlist" aria-label="Add to wishlist">
                                            <i
                                                class="fas fa-heart {{ in_array($product->id, $wishlistProductIds ?? []) ? 'text-danger' : 'text-muted' }}"></i>
                                        </button>
                                    </form>
                                        <a href="{{ route('catalog.products.show', ['slug' => $product->slug, 'id' => $product->id]) }}" class="btn-view-details">
                                            Details</a>
                                        <form action="{{ route('cart.add') }}" method="POST" class="m-0">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn-add-cart">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="pagination-wrapper">
                            {{ $products->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @else
                    <div class="no-products">
                        <div class="mb-4 position-relative">
                            <div class="empty-icon-bg"></div>
                            <i class="fas fa-box-open fa-5x text-muted animated-icon"></i>
                        </div>
                        <h3 class="h2 fw-bold gradient-text">No Products Found</h3>
                        <p class="lead text-muted mb-4">
                            Try adjusting your filters or explore our full collection.
                        </p>
                        <a href="{{ route('catalog.index') }}" class="btn-add-cart">
                            <i class="fas fa-search me-2"></i>
                            Explore All Products
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
        </div>
    </section>


    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Optional: Add smooth hover effects for touch devices
            if ('ontouchstart' in window) {
                document.querySelectorAll('.product-card').forEach(card => {
                    card.addEventListener('click', function () {
                        this.classList.toggle('hover-state');
                    });
                });
            }
        });
    </script>
@endsection