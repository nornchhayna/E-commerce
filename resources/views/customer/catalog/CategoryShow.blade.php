@extends('customer.layouts.app')

@section('title', $category->name)

@section('content')
    <style>
        .card-product {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            border: none;
        }

        .card-product:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .card-product .card-img-top {
            height: 230px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }

        .card-product .card-body {
            padding: 1rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .price-current {
            font-size: 1.2rem;
            color: #e53935;
            font-weight: 700;
        }

        .price-compare {
            text-decoration: line-through;
            color: #888;
            font-size: 0.9rem;
            margin-left: 0.5rem;
        }

        .btn-add-cart {
            background-color: #e53935;
            color: white;
            border: none;
            font-weight: 600;
        }

        .btn-add-cart:hover {
            background-color: #c62828;
        }

        .category-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .category-header h1 {
            font-weight: 700;
            font-size: 2rem;
        }

        .alert-info {
            background-color: #f3f4f6;
            color: #333;
        }
    </style>

    <div class="container py-5">
        <div class="category-header">
            <h1>{{ $category->name }}</h1>
        </div>

        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card card-product shadow-sm h-100">

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

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" title="{{ $product->name }}">{{ Str::limit($product->name, 40) }}</h5>

                            <div class="mt-auto d-flex align-items-center">
                                <span
                                    class="price-current">${{ number_format((float) str_replace(',', '', $product->price), 2) }}</span>
                                @if($product->compare_price)
                                    <span
                                        class="price-compare">${{ number_format((float) str_replace(',', '', $product->compare_price), 2) }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer bg-white d-flex gap-2 px-3 py-2 border-0">
                            <form action="{{ route('wishlist.store') }}" method="POST" class="position-absolute top-0 end-0 m-3"
                                style="z-index: 20;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-light btn-sm rounded-circle p-2 shadow action-btn"
                                    data-bs-toggle="tooltip" title="Add to Wishlist" aria-label="Add to wishlist">
                                    <i
                                        class="fas fa-heart {{ in_array($product->id, $wishlistProductIds ?? []) ? 'text-danger' : 'text-muted' }}"></i>
                                </button>
                            </form>
                            <a href="{{ route('catalog.products.show', ['slug' => $product->slug, 'id' => $product->id]) }}"
                                class="btn-view-details">Details</a>

                            <form action="{{ route('cart.add') }}" method="POST" class="w-50 m-0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-add-cart w-100">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No products found in this category.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function (el) {
                return new bootstrap.Tooltip(el);
            });
        });
    </script>
@endsection