@extends('customer.layouts.app')

@section('title', 'My Wishlist')
@section('content')

    <style>
        /* Base Styles */
        .wishlist-section {
            background-color: #ffffff;
            /* Main color: white */
            position: relative;
            overflow: hidden;
            padding: 3rem 0;
        }

        /* Floating Shapes Animation */
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

        /* Wishlist Container */
        .wishlist-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
            position: relative;
            z-index: 10;
        }

        /* Header */
        .wishlist-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .wishlist-title {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 1rem;
            color: #374151;
            /* Dark gray text */
        }

        /* Flash Messages */
        .flash-message {
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 8px;
            font-size: 0.95rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .flash-success {
            background-color: rgba(107, 114, 128, 0.1);
            /* Light gray */
            border: 1px solid #6b7280;
            /* Medium gray */
            color: #6b7280;
            /* Medium gray text */
        }

        .flash-info {
            background-color: rgba(107, 114, 128, 0.1);
            /* Light gray */
            border: 1px solid #9ca3af;
            /* Lighter gray */
            color: #9ca3af;
            /* Lighter gray text */
        }

        /* Wishlist Grid */
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        /* Wishlist Card */
        .wishlist-card {
            transition: all 0.3s ease;
        }

        .wishlist-card .card {
            border-radius: 15px;
            overflow: hidden;
            background: #ffffff;
            /* White background */
            border: 1px solid #e5e7eb;
            /* Light gray border */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            /* Lighter shadow */
        }

        .wishlist-card:hover {
            transform: translateY(-5px);
        }

        .wishlist-card:hover .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            /* Lighter shadow on hover */
        }

        .wishlist-link {
            text-decoration: none;
            display: block;
            color: #374151;
            /* Dark gray text */
        }

        /* Image Container */
        .image-container {
            height: 240px;
            width: 100%;
            position: relative;
            background-color: #ffffff;
            /* White background */
        }

        .wishlist-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.5s ease;
        }

        .wishlist-card:hover .wishlist-image {
            transform: scale(1.05);
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

        .wishlist-card:hover .image-overlay {
            opacity: 1;
        }

        .discount-badge {
            position: absolute;
            bottom: 12px;
            left: 12px;
            background: #f9fafb;
            /* Light gray background */
            color: #374151;
            /* Dark gray text */
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            /* Lighter shadow */
        }

        /* Card Body */
        .card-body {
            padding: 1.5rem;
            text-align: center;
        }

        .wishlist-name {
            font-size: 1.2rem;
            color: #374151;
            /* Dark gray text */
            font-weight: 700;
            margin-bottom: 0.75rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .price-container {
            display: flex;
            justify-content: center;
            align-items: baseline;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .wishlist-price {
            font-size: 1.25rem;
            color: #374151;
            /* Dark gray text */
            font-weight: 700;
        }

        .compare-price {
            font-size: 0.95rem;
            color: #9ca3af;
            /* Lighter gray */
            text-decoration: line-through;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            padding: 0 1.5rem 1.5rem;
        }

        .action-btn {
            background: #ffffff;
            /* White background */
            border: 1px solid #e5e7eb;
            /* Light gray border */
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cart-btn {
            color: #6b7280;
            /* Medium gray */
        }

        .cart-btn:hover {
            background: #f9fafb;
            /* Light gray */
            color: #374151;
            /* Dark gray */
        }

        .remove-btn {
            color: #9ca3af;
            /* Lighter gray */
        }

        .remove-btn:hover {
            background: #f9fafb;
            /* Light gray */
            color: #6b7280;
            /* Medium gray */
        }

        /* Empty State */
        .no-wishlist {
            text-align: center;
            padding: 3rem;
            background: #ffffff;
            /* White background */
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            /* Lighter shadow */
            max-width: 500px;
            margin: 0 auto;
        }

        .empty-icon-bg {
            position: absolute;
            width: 120px;
            height: 120px;
            background: rgba(107, 114, 128, 0.05);
            /* Very light gray */
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .animated-icon {
            animation: pulse 2s infinite ease-in-out;
            color: #6b7280;
            /* Medium gray */
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
            /* Light gray background */
            color: #374151;
            /* Dark gray text */
            font-size: 0.95rem;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            /* Subtle border */
        }

        .explore-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            /* Lighter shadow */
            background: #ffffff;
            /* White background on hover */
            border-color: #d1d5db;
            /* Slightly darker border */
        }

        /* Pagination */
        .pagination-wrapper {
            background: #ffffff;
            /* White background */
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
            /* Lighter shadow */
        }

        .pagination a {
            color: #6b7280;
            /* Medium gray */
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background-color: #f9fafb;
            /* Light gray */
            color: #374151;
            /* Dark gray */
        }

        .pagination .current {
            background: #f9fafb;
            /* Light gray */
            color: #374151;
            /* Dark gray */
            font-weight: 600;
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .wishlist-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .wishlist-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .wishlist-title {
                font-size: 2.5rem;
            }

            .image-container {
                height: 200px;
            }
        }

        @media (max-width: 576px) {
            .wishlist-grid {
                grid-template-columns: 1fr;
            }

            .wishlist-title {
                font-size: 2rem;
            }

            .image-container {
                height: 180px;
            }
        }
    </style>



    <section class="wishlist-section position-relative overflow-hidden py-5">
        {{-- Animated Background --}}
        <div class="position-absolute w-100 h-100"
            style="top: 0; left: 0; background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 50%, #fff5f8 100%);">
            <div class="floating-shape floating-shape-1"></div>
            <div class="floating-shape floating-shape-2"></div>
            <div class="floating-shape floating-shape-3"></div>
        </div>

        <div class="wishlist-container">
            <header class="wishlist-header">
                <div class="d-inline-flex align-items-center px-4 py-2 mb-4 rounded-pill"
                    style="background: linear-gradient(45deg, rgba(175, 201, 126, 0.1), rgba(134, 239, 172, 0.1));">
                    <i class="fas fa-heart text-danger me-2"></i>
                    <span class="fw-semibold" style="color: #AFC97E;">Your Wishlist</span>
                </div>
                <h1 class="wishlist-title gradient-text">My Wishlist</h1>
            </header>

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="flash-message flash-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('info'))
                <div class="flash-message flash-info">
                    {{ session('info') }}
                </div>
            @endif

            @if ($wishlists->isEmpty())
                <div class="no-wishlist">
                    <div class="mb-4 position-relative">
                        <div class="empty-icon-bg"></div>
                        <i class="fas fa-heart fa-5x text-muted animated-icon"></i>
                    </div>
                    <h3 class="h2 fw-bold gradient-text">Your Wishlist is Empty</h3>
                    <p class="lead text-muted mb-4">
                        Add some items to your wishlist and start building your dream collection!
                    </p>
                    <a href="{{ route('catalog.index') }}" class="explore-btn">
                        <i class="fas fa-search me-2"></i>
                        Explore Products
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            @else
                <div class="wishlist-grid">
                    @foreach ($wishlists as $item)
                        @php
                            $product = $item->product;
                            $images = json_decode($product->images, true);
                            $firstImage = is_array($images) && !empty($images) ? $images[0] : null;
                            $imageUrl = $firstImage ? asset('storage/' . $firstImage) : asset('images/placeholder.png');
                        @endphp



                        <div class="wishlist-card">
                            <div class="card h-100 position-relative">
                                <div class="gradient-border"></div>
                                <a href="{{ route('catalog.products.show', ['slug' => $product->slug, 'id' => $product->id]) }}"
                                    class="wishlist-link">
                                    <div class="image-container">
                                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="wishlist-image">
                                        <div class="image-overlay"></div>
                                        @if ($product->compare_price && $product->compare_price > $product->price)
                                            <div class="discount-badge">
                                                {{ round(((float) str_replace(',', '', $product->compare_price) - (float) str_replace(',', '', $product->price)) / (float) str_replace(',', '', $product->compare_price) * 100) }}%
                                                OFF
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h3 class="wishlist-name">{{ $product->name }}</h3>
                                        <div class="price-container">
                                            <span class="wishlist-price">
                                                ${{ number_format((float) str_replace(',', '', $product->price), 2) }}
                                            </span>
                                            @if ($product->compare_price)
                                                <span class="compare-price">
                                                    ${{ number_format((float) str_replace(',', '', $product->compare_price), 2) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                                <div class="action-buttons">
                                    <form action="{{ route('cart.add') }}" method="POST" class="action-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="action-btn cart-btn" title="Add to Cart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" class="action-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn remove-btn" title="Remove from Wishlist">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <div class="pagination-wrapper">
                        {{-- {{ $wishlists->links('pagination::bootstrap-5') }} --}}
                    </div>
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
                document.querySelectorAll('.wishlist-card').forEach(card => {
                    card.addEventListener('click', function () {
                        this.classList.toggle('hover-state');
                    });
                });
            }
        });
    </script>
@endsection