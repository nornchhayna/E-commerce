@extends('customer.layouts.app')

@section('title', 'Featured Products')

@section('content')
    <style>
        /* Base Styles */
        .featured-products {
            background-color: #ffffff;
            position: relative;
            overflow: hidden;
            padding: 3rem 0;
        }

        /* Floating Shapes Animation (neutral and subtle) */
        .floating-shape {
            position: absolute;
            background: rgba(107, 114, 128, 0.05);
            /* Very light gray */
            border-radius: 50%;
            filter: blur(30px);
            animation: float 15s infinite ease-in-out;
        }

        .floating-shape-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .floating-shape-2 {
            width: 400px;
            height: 400px;
            bottom: 10%;
            right: 5%;
            animation-delay: 3s;
        }

        .floating-shape-3 {
            width: 250px;
            height: 250px;
            top: 60%;
            left: 30%;
            animation-delay: 6s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }

        /* Featured Container */
        .featured-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
            position: relative;
            z-index: 10;
        }

        /* Header */
        .featured-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .featured-title {
            font-size: 3rem;
            font-weight: 900;
            color: #374151;
            margin-bottom: 1rem;
        }

        .featured-subtitle {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1.5rem;
            margin-bottom: 1rem;
            background: rgba(107, 114, 128, 0.05);
            /* Light gray background */
            border-radius: 50px;
            font-weight: 600;
            color: #6b7280;
        }

        .featured-description {
            font-size: 1.15rem;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        /* Product Card */
        .product-card {
            transition: all 0.3s ease;
        }

        .product-card .card {
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        .product-card:hover {
            transform: translateY(-3px);
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
            height: 240px;
            width: 100%;
            position: relative;
            background-color: #ffffff;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.02);
        }

        .image-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0) 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .product-card:hover .image-overlay {
            opacity: 1;
        }

        .discount-badge {
            position: absolute;
            bottom: 12px;
            left: 12px;
            background: #e5e7eb;
            color: #374151;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.3rem 0.6rem;
            border-radius: 16px;
        }

        .featured-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: #e5e7eb;
            color: #374151;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.3rem 0.6rem;
            border-radius: 16px;
        }

        .category-badge {
            background: rgba(107, 114, 128, 0.1);
            color: #6b7280;
            font-weight: 600;
            padding: 0.3rem 0.6rem;
            border-radius: 16px;
            font-size: 0.85rem;
        }

        /* Card Body */
        .card-body {
            padding: 1.2rem;
        }

        .product-name {
            font-size: 1.1rem;
            color: #374151;
            font-weight: 700;
            margin-bottom: 0.5rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-description {
            font-size: 0.9rem;
            color: #6b7280;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 0.75rem;
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

        .rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #6b7280;
        }

        .stars {
            color: #d1d5db;
            /* Neutral gray for stars */
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            padding: 0 1.2rem 1.2rem;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .product-card:hover .quick-actions {
            opacity: 1;
            transform: translateY(0);
        }

        .action-btn {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            color: #374151;
        }

        /* Empty State */
        .no-products {
            text-align: center;
            padding: 2.5rem;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            max-width: 500px;
            margin: 0 auto;
        }

        .empty-icon-bg {
            position: absolute;
            width: 100px;
            height: 100px;
            background: rgba(107, 114, 128, 0.05);
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .animated-icon {
            animation: pulse 2s infinite ease-in-out;
            color: #6b7280;
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

        .explore-btn {
            background: #f9fafb;
            color: #374151;
            font-size: 0.95rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .explore-btn:hover {
            background: #ffffff;
            border-color: #d1d5db;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        /* Pagination */
        .pagination-wrapper {
            background: #ffffff;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            margin-top: 2.5rem;
            display: flex;
            justify-content: center;
        }

        .pagination a {
            color: #374151;
            padding: 0.25rem 0.75rem;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .pagination a:hover {
            background: #f9fafb;
        }

        .pagination .current {
            background: #f9fafb;
            color: #374151;
            font-weight: 600;
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .product-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .featured-title {
                font-size: 2.5rem;
            }

            .image-container {
                height: 200px;
            }
        }

        @media (max-width: 576px) {
            .product-grid {
                grid-template-columns: 1fr;
            }

            .featured-title {
                font-size: 2rem;
            }

            .image-container {
                height: 180px;
            }
        }
    </style>


    <section class="featured-products position-relative overflow-hidden py-5">
        {{-- Animated Background --}}
        {{-- <div class="position-absolute w-100 h-100"
            style="top: 0; left: 0; background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 50%, #fff5f8 100%);">
            <div class="floating-shape floating-shape-1"></div>
            <div class="floating-shape floating-shape-2"></div>
            <div class="floating-shape floating-shape-3"></div>
        </div> --}}

        <div class="featured-container">
            {{-- Header --}}
            <header class="featured-header">
                <div class="featured-subtitle">
                    <i class="fas fa-star text-warning me-2"></i>
                    Featured Collection
                </div>
                <h1 class="featured-title gradient-text">Premium Products</h1>
                <p class="featured-description">
                    Handcrafted excellence meets modern design. Discover our curated collection of extraordinary products.
                </p>
            </header>

            @if ($products->count())
                {{-- Product Grid --}}
                <div class="product-grid mb-5">
                    @foreach ($products as $product)
                        <article class="product-card h-100">
                            <div class="card h-100 position-relative">
                                <div class="gradient-border"></div>
                                <a href="{{ route('catalog.products.show', ['slug' => $product->slug, 'id' => $product->id]) }}"
                                    class="product-link">
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


                                        <div class="image-overlay"></div>

                                        @if ($product->compare_price && $product->compare_price > $product->price)
                                            <div class="discount-badge">
                                                {{ round((floatval($product->compare_price) - floatval($product->price)) / floatval($product->compare_price) * 100) }}%
                                                OFF
                                            </div>
                                        @endif

                                        @if ($product->is_featured)
                                            <div class="featured-badge">
                                                <i class="fas fa-star me-1"></i>Featured
                                            </div>
                                        @endif
                                    </div>

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

                                    <div class="card-body">
                                        @if ($product->category)
                                            <div class="mb-2">
                                                <span class="category-badge">{{ $product->category->name }}</span>
                                            </div>
                                        @endif

                                        <h3 class="product-name">{{ $product->name }}</h3>

                                        <div class="price-container">
                                            <span
                                                class="product-price">${{ number_format(floatval(str_replace(',', '', $product->price)), 2) }}</span>
                                            @if ($product->compare_price)
                                                <span
                                                    class="compare-price">${{ number_format(floatval(str_replace(',', '', $product->compare_price)), 2) }}</span>
                                            @endif
                                        </div>

                                        @if ($product->description)
                                            <p class="product-description">{{ $product->description }}</p>
                                        @endif

                                        @if ($product->rating)
                                            <div class="rating">
                                                <div class="stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star{{ $i <= $product->rating ? '' : '-o' }}"></i>
                                                    @endfor
                                                </div>
                                                <span>({{ $product->reviews_count ?? 0 }} reviews)</span>
                                            </div>
                                        @endif
                                    </div>
                                </a>

                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center">
                    <div class="pagination-wrapper">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @else
                {{-- Empty State --}}
                <div class="no-products">
                    <div class="mb-4 position-relative">
                        <div class="empty-icon-bg"></div>
                        <i class="fas fa-box-open fa-5x text-muted animated-icon"></i>
                    </div>
                    <h3 class="h2 fw-bold gradient-text">Coming Soon</h3>
                    <p class="lead text-muted mb-4">
                        We're curating an amazing collection of premium products just for you. Something extraordinary is on the
                        way!
                    </p>
                    <a href="{{ route('products.index') }}" class="explore-btn">
                        <i class="fas fa-search me-2"></i>
                        Explore All Products
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

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