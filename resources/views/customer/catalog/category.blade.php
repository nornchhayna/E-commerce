@extends('customer.layouts.app')

@section('title', 'Categories')
@section('content')

    <style>
        /* Base Styles */
        .categories-section {
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

        /* Categories Container */
        .categories-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
            position: relative;
            z-index: 10;
        }

        /* Header */
        .categories-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .categories-title {
            font-size: 3rem;
            font-weight: 900;
            color: #374151;
            margin-bottom: 1rem;
        }

        .categories-description {
            font-size: 1.15rem;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Category Grid */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        /* Category Card */
        .category-card {
            transition: all 0.3s ease;
        }

        .category-card .card {
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        .category-card:hover {
            transform: translateY(-3px);
        }

        .category-card:hover .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .category-link {
            text-decoration: none;
            display: block;
            color: #374151;
        }

        /* Image Container */
        .image-container {
            height: 180px;
            width: 100%;
            position: relative;
            background-color: #ffffff;
        }

        .category-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-image {
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

        .category-card:hover .image-overlay {
            opacity: 1;
        }

        /* Card Body */
        .card-body {
            padding: 1.2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .category-name {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .child-categories {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .child-category-link {
            background: rgba(107, 114, 128, 0.1);
            /* Light gray background */
            color: #6b7280;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.3rem 0.6rem;
            border-radius: 16px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .child-category-link:hover {
            background: #f9fafb;
            color: #374151;
        }

        /* Empty State */
        .no-categories {
            text-align: center;
            padding: 2.5rem;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            max-width: 500px;
            margin: 2rem auto;
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


        .explore-btn:hover {
            background: #ffffff;
            border-color: #d1d5db;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .category-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .categories-title {
                font-size: 2.5rem;
            }

            .image-container {
                height: 150px;
            }
        }

        @media (max-width: 576px) {
            .category-grid {
                grid-template-columns: 1fr;
            }

            .categories-title {
                font-size: 2rem;
            }

            .image-container {
                height: 120px;
            }
        }
    </style>



    <section class="categories-section position-relative overflow-hidden py-5">
        <!-- Animated Background -->
        {{-- <div class="position-absolute w-100 h-100"
            style="top: 0; left: 0; background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 50%, #fff5f8 100%);">
            <div class="floating-shape floating-shape-1"></div>
            <div class="floating-shape floating-shape-2"></div>
            <div class="floating-shape floating-shape-3"></div>
        </div> --}}

        <div class="categories-container">
            <!-- Header -->
            <header class="categories-header">
                <h1 class="categories-title gradient-text">Explore Categories</h1>
                <p class="categories-description">
                    Discover our curated selection of product categories to find exactly what you’re looking for.
                </p>
            </header>

            @if ($categories->count())
                <!-- Category Grid -->
                <div class="category-grid">
                    @foreach ($categories as $category)
                        <div class="category-card">
                            <div class="card h-100 position-relative">
                                <div class="gradient-border"></div>
                                <a href="{{ route('catalog.category.show', $category->slug) }}" class="category-link">
                                    <div class="image-container">
                                        @php
                                            $image = $category->image ?? null;
                                            $imageUrl = $image ? asset('storage/' . $image) : asset('images/category-placeholder.jpg');
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="{{ $category->name }}" class="category-image">
                                        <div class="image-overlay"></div>
                                    </div>
                                    <div class="card-body">
                                        <h2 class="category-name">{{ $category->name }}</h2>
                                        @if ($category->children->count())
                                            <div class="child-categories">
                                                @foreach ($category->children as $child)
                                                    <a href="{{ route('catalog.category.show', $child->slug) }}"
                                                        class="child-category-link">
                                                        {{ $child->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="no-categories">
                    <div class="mb-4 position-relative">
                        <div class="empty-icon-bg"></div>
                        <i class="fas fa-folder-open fa-5x text-muted animated-icon"></i>
                    </div>
                    <h3 class="h2 fw-bold gradient-text">No Categories Found</h3>
                    <p class="lead text-muted mb-4">
                        We’re working on adding new categories for you to explore. Check back soon!
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
            if ('ontouchstart' in window) {
                document.querySelectorAll('.category-card').forEach(card => {
                    card.addEventListener('click', function () {
                        this.classList.toggle('hover-state');
                    });
                });
            }
        });
    </script>
@endsection