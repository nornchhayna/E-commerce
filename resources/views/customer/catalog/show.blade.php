@extends('customer.layouts.app')

@section('title', $product->name)

@section('content')
    <style>
        /* Product Details Section */
        .product-details-section {
            background-color: #ffffff;
            padding: 3rem 0;
            position: relative;
            z-index: 1;
        }

        /* Product Container */
        .product-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Carousel */
        .product-carousel {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        }

        .carousel-inner img {
            height: 400px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .carousel-inner img:hover {
            transform: scale(1.05);
        }

        .carousel-control-prev,
        .carousel-control-next {
            background: rgba(0, 0, 0, 0.3);
            width: 50px;
            transition: background 0.3s ease;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background: rgba(0, 0, 0, 0.5);
        }

        /* Thumbnails */
        .thumbnail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.5rem;
        }

        .thumbnail-item {
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .thumbnail-item img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .thumbnail-item.active::after,
        .thumbnail-item:hover::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 2px solid var(--primary-color);
            border-radius: 8px;
        }

        .thumbnail-item:hover img {
            transform: scale(1.1);
        }

        /* Product Info */
        .product-info {
            padding: 1.5rem;
        }

        .product-name {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .rating {
            font-size: 1rem;
        }

        .price-container .price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .price-container .original-price {
            font-size: 1.2rem;
            color: var(--gray);
            text-decoration: line-through;
            margin-left: 0.5rem;
        }

        .discount-badge {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: #fff;
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            margin-left: 0.5rem;
        }

        .description {
            font-size: 1rem;
            color: var(--gray);
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .availability,
        .categories {
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .category-badge {
            background: rgba(175, 201, 126, 0.1);
            color: var(--primary-color);
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .category-badge:hover {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: #fff;
        }

        /* Action Buttons */
        .action-group {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .quantity-input {
            width: 120px;
        }

        .quantity-input .btn {
            background: #fff;
            border: 1px solid var(--gray);
            color: var(--dark);
            transition: all 0.3s ease;
        }

        .quantity-input .btn:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff;
        }

        .quantity-input input {
            border: 1px solid var(--gray);
            text-align: center;
            font-size: 0.95rem;
        }

        .add-to-cart-btn,
        .add-to-wishlist-btn {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: #fff;
            font-size: 0.95rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
        }

        .add-to-cart-btn:hover,
        .add-to-wishlist-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(175, 201, 126, 0.3);
            background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
        }

        .add-to-wishlist-btn {
            padding: 0.75rem;
        }

        .auth-alert {
            background: rgba(175, 201, 126, 0.1);
            border: none;
            color: var(--dark);
            font-size: 0.95rem;
            padding: 1rem;
            border-radius: 8px;
        }

        .auth-alert a {
            color: var(--primary-color);
            text-decoration: underline;
        }

        /* Share Buttons */
        .share-buttons {
            font-size: 0.95rem;
        }

        .share-buttons a {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .share-buttons a:hover {
            transform: translateY(-2px);
        }

        /* Tabs */
        .nav-tabs {
            border-bottom: 2px solid rgba(175, 201, 126, 0.1);
        }

        .nav-tabs .nav-link {
            color: var(--gray);
            font-weight: 600;
            padding: 1rem 2rem;
            border: none;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link:hover,
        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
            background: transparent;
        }

        .tab-content {
            background: #fff;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }

        /* Review Form */
        .review-form .form-label {
            font-weight: 600;
            color: var(--dark);
        }

        .rating-input {
            display: flex;
            flex-direction: row-reverse;
            gap: 0.5rem;
        }

        .rating-input input {
            display: none;
        }

        .rating-input label {
            color: #d1d5db;
            cursor: pointer;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .rating-input input:checked~label,
        .rating-input label:hover,
        .rating-input label:hover~label {
            color: #f59e0b;
        }

        .review-form .form-control {
            border: 1px solid var(--gray);
            border-radius: 8px;
            font-size: 0.95rem;
        }

        .review-form .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(175, 201, 126, 0.25);
        }

        .submit-review-btn {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: #fff;
            font-size: 0.95rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
        }

        .submit-review-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(175, 201, 126, 0.3);
        }

        /* Reviews List */
        .review-item {
            padding: 1rem;
            border-radius: 8px;
            background: rgba(175, 201, 126, 0.05);
        }

        .review-item .rating {
            font-size: 0.9rem;
        }

        /* Related Products */
        .related-products {
            margin-top: 3rem;
        }

        .related-products h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .related-card {
            transition: all 0.3s ease;
        }

        .related-card .card {
            border-radius: 15px;
            overflow: hidden;
            background: #ffffff;
            border: none;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        }

        .related-card:hover {
            transform: translateY(-5px);
        }

        .related-card:hover .card {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .related-card .gradient-border {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s ease;
        }

        .related-card:hover .gradient-border {
            transform: scaleX(1);
        }

        .related-card img {
            height: 180px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .related-card:hover img {
            transform: scale(1.05);
        }

        .related-card .card-body {
            padding: 1.5rem;
        }

        .related-card .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .related-card .card-title a {
            color: var(--dark);
            text-decoration: none;
        }

        .related-card .price {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .related-card .original-price {
            font-size: 0.9rem;
            color: var(--gray);
            text-decoration: line-through;
            margin-left: 0.5rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .related-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 992px) {
            .product-carousel img {
                height: 350px;
            }

            .product-name {
                font-size: 1.8rem;
            }

            .price-container .price {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 768px) {
            .related-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .product-carousel img {
                height: 300px;
            }

            .thumbnail-item img {
                height: 60px;
            }

            .product-name {
                font-size: 1.6rem;
            }

            .action-group {
                flex-direction: column;
                align-items: stretch;
            }

            .quantity-input {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 576px) {
            .related-grid {
                grid-template-columns: 1fr;
            }

            .product-carousel img {
                height: 250px;
            }

            .product-name {
                font-size: 1.4rem;
            }

            .price-container .price {
                font-size: 1.4rem;
            }

            .nav-tabs .nav-link {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>

    <section class="product-details-section py-5">
        <div class="product-container">
            <div class="row">
                <!-- Product Images -->
                <div class="col-md-6">
                    <div class="product-carousel carousel slide" id="productCarousel" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                @php
                                    $mainImage = $product->image ?? ($product->images->first()->path ?? 'images/product-placeholder.jpg');
                                    $mainImageUrl = asset('storage/' . $mainImage);
                                @endphp
                                <img src="{{ $mainImageUrl }}" class="d-block w-100" alt="{{ $product->name }}">
                            </div>
                            @foreach($product->images as $image)
                                @if($image->path !== $product->image)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100"
                                            alt="{{ $product->name }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- Thumbnails -->
                    <div class="thumbnail-grid mt-3">
                        <div class="thumbnail-item active">
                            <img src="{{ $mainImageUrl }}" data-bs-target="#productCarousel" data-bs-slide-to="0"
                                alt="{{ $product->name }}">
                        </div>
                        @foreach($product->images as $index => $image)
                            @if($image->path !== $product->image)
                                <div class="thumbnail-item">
                                    <img src="{{ asset('storage/' . $image->path) }}" data-bs-target="#productCarousel"
                                        data-bs-slide-to="{{ $index + 1 }}" alt="{{ $product->name }}">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- Product Info -->
                <div class="col-md-6">
                    <div class="product-info">
                        <h1 class="product-name gradient-text">{{ $product->name }}</h1>
                        <div class="d-flex align-items-center mb-3">
                            <div class="rating me-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $product->average_rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @elseif($i - 0.5 <= $product->average_rating)
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-muted">({{ $product->reviews_count }} reviews)</span>
                        </div>
                        <div class="price-container mb-3">
                            @if($product->discount_price)
                                <span class="price">${{ number_format($product->price, 2) }}</span>
                                <span class="original-price">${{ number_format($product->discount_price, 2) }}</span>
                                <span
                                    class="discount-badge">{{ round(($product->discount_price - $product->price) / $product->discount_price * 100) }}%
                                    OFF</span>
                            @else
                                <span class="price">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        <div class="description">
                            <p>{{ $product->description }}</p>
                        </div>
                        <div class="availability">
                            <strong class="me-2">Availability:</strong>
                            @if($product->stock > 0)
                                <span class="text-success">In Stock ({{ $product->stock }} available)</span>
                            @else
                                <span class="text-danger">Out of Stock</span>
                            @endif
                        </div>
                        <div class="categories mb-4">
                            <strong>Categories:</strong>
                            @foreach($product->categories as $category)
                                <a href="{{ route('catalog.category.show', $category->slug) }}"
                                    class="category-badge">{{ $category->name }}</a>
                            @endforeach
                        </div>
                        @auth
                            <div class="action-group mb-4">
                                <div class="quantity-input input-group">
                                    <button class="btn decrement" type="button">-</button>
                                    <input type="number" class="form-control quantity" value="1" min="1"
                                        max="{{ $product->stock }}">
                                    <button class="btn increment" type="button">+</button>
                                </div>
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-grow-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" class="quantity-hidden">
                                    <button type="submit" class="add-to-cart-btn w-100">Add to Cart</button>
                                </form>
                                <button class="add-to-wishlist-btn" data-id="{{ $product->id }}">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        @else
                            <div class="auth-alert mb-4">
                                Please <a href="{{ route('login') }}">login</a> to add items to your cart or wishlist.
                            </div>
                        @endauth
                        <div class="share-buttons">
                            <strong class="me-2">Share:</strong>
                            <a href="#" class="text-primary me-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-info me-2"><i class="fab faTwitter"></i></a>
                            <a href="#" class="text-danger"><i class="fab fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Tabs -->
            <div class="row mt-5">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                data-bs-target="#description" type="button">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs"
                                type="button">Specifications</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                type="button">Reviews ({{ $product->reviews_count }})</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            {!! $product->long_description !!}
                        </div>
                        <div class="tab-pane fade" id="specs" role="tabpanel">
                            <table class="table">
                                <tbody>
                                    @foreach($product->specifications as $spec)
                                        <tr>
                                            <th width="30%">{{ $spec->name }}</th>
                                            <td>{{ $spec->value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            @auth
                                <div class="review-form mb-4">
                                    <h5 class="gradient-text">Write a Review</h5>
                                    <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Rating</label>
                                            <div class="rating-input">
                                                @for($i = 5; $i >= 1; $i--)
                                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
                                                    <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Review Title</label>
                                            <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Your Review</label>
                                            <textarea class="form-control" name="comment" rows="4"
                                                required>{{ old('comment') }}</textarea>
                                        </div>
                                        <button type="submit" class="submit-review-btn">Submit Review</button>
                                    </form>
                                </div>
                            @else
                                <div class="auth-alert mb-4">
                                    Please <a href="{{ route('login') }}">login</a> to write a review.
                                </div>
                            @endauth
                            <div class="reviews-list">
                                <h5 class="gradient-text">Customer Reviews</h5>
                                @forelse($product->reviews as $review)
                                    <div class="review-item mb-4">
                                        <div class="d-flex justify-content-between">
                                            <div class="rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-warning"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                        </div>
                                        <h6 class="mt-2">{{ $review->title }}</h6>
                                        <p class="mb-1">{{ $review->comment }}</p>
                                        <small class="text-muted">By {{ $review->user->name }}</small>
                                    </div>
                                @empty
                                    <p>No reviews yet. Be the first to review this product!</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="related-products">
                    <h3 class="gradient-text">You May Also Like</h3>
                    <div class="related-grid">
                        @foreach($relatedProducts as $relatedProduct)
                            <div class="related-card">
                                <div class="card h-100 position-relative">
                                    <div class="gradient-border"></div>
                                    <a href="{{ route('catalog.product.show', $relatedProduct->slug) }}"
                                        class="text-decoration-none">
                                        @php
                                            $relatedImage = $relatedProduct->image ?? ($relatedProduct->images->first()->path ?? 'images/product-placeholder.jpg');
                                            $relatedImageUrl = asset('storage/' . $relatedImage);
                                        @endphp
                                        <img src="{{ $relatedImageUrl }}" class="card-img-top" alt="{{ $relatedProduct->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                                            <div class="d-flex align-items-center">
                                                <span class="price">${{ number_format($relatedProduct->price, 2) }}</span>
                                                @if($relatedProduct->discount_price)
                                                    <span
                                                        class="original-price">${{ number_format($relatedProduct->discount_price, 2) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Quantity increment/decrement
            const quantityInput = document.querySelector('.quantity');
            const quantityHidden = document.querySelector('.quantity-hidden');
            const incrementBtn = document.querySelector('.increment');
            const decrementBtn = document.querySelector('.decrement');

            if (incrementBtn && decrementBtn && quantityInput) {
                incrementBtn.addEventListener('click', () => {
                    let value = parseInt(quantityInput.value);
                    const max = parseInt(quantityInput.max);
                    if (value < max) {
                        quantityInput.value = value + 1;
                        quantityHidden.value = value + 1;
                    }
                });

                decrementBtn.addEventListener('click', () => {
                    let value = parseInt(quantityInput.value);
                    if (value > 1) {
                        quantityInput.value = value - 1;
                        quantityHidden.value = value - 1;
                    }
                });

                quantityInput.addEventListener('change', () => {
                    let value = parseInt(quantityInput.value);
                    const max = parseInt(quantityInput.max);
                    if (value < 1) quantityInput.value = 1;
                    if (value > max) quantityInput.value = max;
                    quantityHidden.value = quantityInput.value;
                });
            }

            // Add to wishlist
            const wishlistBtn = document.querySelector('.add-to-wishlist-btn');
            if (wishlistBtn) {
                wishlistBtn.addEventListener('click', () => {
                    const productId = wishlistBtn.dataset.id;
                    fetch("{{ route('wishlist.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ product_id: productId })
                    })
                        .then(response => response.json())
                        .then(data => {
                            document.querySelector('.wishlist-count').textContent = data.wishlistCount;
                            alert('Product added to wishlist!'); // Replace with toastr if available
                        })
                        .catch(error => console.error('Error:', error));
                });
            }

            // Thumbnail click handler
            document.querySelectorAll('.thumbnail-item').forEach(item => {
                item.addEventListener('click', () => {
                    document.querySelectorAll('.thumbnail-item').forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                });
            });
        });
    </script>
@endsection