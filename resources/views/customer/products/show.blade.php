@extends('customer.layouts.app')

@section('content')
    <div class="product-details-container">
        <style>
            /* Base Styles */
            .product-details-container {
                background-color: #ffffff;
                border-radius: 0.75rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                overflow: hidden;
                max-width: 80rem;
                margin: 2rem auto;
                padding: 1.5rem 2rem;
                transition: box-shadow 0.3s ease;
            }

            .product-details-container:hover {
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            }

            /* Layout */
            .product-layout {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-bottom: 1.5rem;
            }

            @media (min-width: 768px) {
                .product-layout {
                    grid-template-columns: 1fr 1fr;
                }
            }

            /* Image */
            .product-image img,
            .review-item .review-images img {
                width: 80%;
                max-width: 500px;
                height: 500px;
                object-fit: contain;


                transition: transform 0.3s ease;
            }

            .product-image img:hover,
            .review-item .review-images img:hover {
                transform: scale(1.05);
            }

            @media (max-width: 767px) {

                .product-image img,
                .review-item .review-images img {
                    max-width: 80px;
                    height: 80px;
                }
            }

            /* Product Info */
            .product-info h2 {
                font-size: 1.5rem;
                font-weight: 700;
                color: #1f2937;
                margin-bottom: 0.5rem;
            }

            .product-info .price {
                font-size: 1.25rem;
                font-weight: 600;
                color: #4b5563;
                margin-bottom: 0.25rem;
            }

            .product-info .compare-price {
                font-size: 1rem;
                color: #6b7280;
                text-decoration: line-through;
                margin-left: 0.5rem;
            }

            .product-info .short-description {
                font-size: 0.875rem;
                color: #6b7280;
                margin-bottom: 1rem;
            }

            .product-info form {
                margin-top: 1rem;
            }

            .add-to-cart {
                display: inline-block;
                padding: 0.75rem 1.5rem;
                background-color: #4b5563;
                color: #ffffff;
                border-radius: 0.375rem;
                font-size: 0.875rem;
                font-weight: 600;
                text-align: center;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }

            .add-to-cart:hover {
                background-color: #374151;
            }

            .add-to-cart:focus {
                outline: none;
                box-shadow: 0 0 0 2px rgba(156, 163, 175, 0.2);
            }

            /* Details */
            .product-details {
                margin-top: 1.5rem;
            }

            .product-details p {
                font-size: 0.875rem;
                color: #4b5563;
                margin-bottom: 0.5rem;
            }

            .product-details p strong {
                color: #1f2937;
            }

            .product-details ul {
                list-style: disc;
                padding-left: 1.5rem;
                margin-bottom: 0.5rem;
            }

            .product-details ul li {
                font-size: 0.875rem;
                color: #4b5563;
                margin-bottom: 0.25rem;
            }

            /* Description */
            .product-description h4 {
                font-size: 1.25rem;
                font-weight: 600;
                color: #1f2937;
                margin-bottom: 1rem;
            }

            .product-description div {
                font-size: 0.875rem;
                color: #4b5563;
                line-height: 1.6;
            }

            /* Reviews */
            .reviews-section h5 {
                font-size: 1.25rem;
                font-weight: 600;
                color: #1f2937;
                margin-top: 2rem;
                margin-bottom: 1rem;
            }

            .reviews-section .no-reviews {
                font-size: 0.875rem;
                color: #6b7280;
            }

            .review-item {
                border-bottom: 1px solid #e5e7eb;
                padding-bottom: 1rem;
                margin-bottom: 1rem;
            }

            .review-item .rating {
                margin-bottom: 0.5rem;
            }

            .review-item .rating .rating-star {
                font-style: normal;
                display: inline-block;
                width: 1rem;
                height: 1rem;
                background-color: #6b7280;
                clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
            }

            .review-item .rating .filled {
                background-color: #f59e0b;
            }

            .review-item h6 {
                font-size: 1rem;
                font-weight: 600;
                color: #1f2937;
                margin-top: 0.5rem;
            }

            .review-item p {
                font-size: 0.875rem;
                color: #4b5563;
                margin-bottom: 0.5rem;
            }

            .review-item small {
                font-size: 0.75rem;
                color: #6b7280;
            }

            .review-item .review-images {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                gap: 0.5rem;
                margin-top: 0.75rem;
            }

            /* Responsive Design */
            @media (max-width: 767px) {
                .product-details-container {
                    margin: 1rem;
                    padding: 1rem;
                }

                .product-layout {
                    gap: 1rem;
                }

                .product-info h2 {
                    font-size: 1.25rem;
                }

                .product-info .price {
                    font-size: 1rem;
                }

                .product-description h4,
                .reviews-section h5 {
                    font-size: 1rem;
                }

                .review-item h6 {
                    font-size: 0.875rem;
                }
            }
        </style>

        <div class="product-layout">
            <div class="product-image">
                @php
                    $images = json_decode($product->images, true);
                    $firstImage = is_array($images) && !empty($images) ? $images[0] : null;
                    $imageUrl = $firstImage ? asset('storage/' . $firstImage) : asset('images/placeholder.png');
                @endphp
                <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
            </div>
            <div class="product-info">
                <h2>{{ $product->name }}</h2>
                <div class="mb-2">
                    <span class="price">
                        ${{ number_format((float) str_replace(',', '', $product->price), 2) }}
                    </span>
                    @if(!empty($product->compare_price))
                        <span class="compare-price">
                            ${{ number_format((float) str_replace(',', '', $product->compare_price), 2) }}
                        </span>
                    @endif
                </div>
                <p class="short-description">{{ $product->short_description }}</p>
                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="add-to-cart">Add to Cart</button>
                </form>
                <div class="product-details mt-4">
                    <p><strong>SKU:</strong> {{ $product->sku }}</p>
                    <p><strong>Stock:</strong> {{ ucfirst(str_replace('_', ' ', $product->stock_status)) }}</p>
                    <p><strong>Weight:</strong> {{ $product->weight ? $product->weight . ' g' : 'N/A' }}</p>
                    @if(!empty($product->dimensions) && is_array($product->dimensions))
                        <p><strong>Dimensions:</strong> {{ implode(' x ', $product->dimensions) }} mm</p>
                    @endif
                    @if(!empty($product->attributes) && is_array($product->attributes))
                        <p><strong>Attributes:</strong></p>
                        <ul>
                            @foreach($product->attributes as $key => $value)
                                <li>{{ ucfirst($key) }}: {{ $value }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="product-description mt-5">
            <h4>Description</h4>
            <div>{!! nl2br(e($product->description)) !!}</div>
        </div>

        <div class="reviews-section">
            <h5>Customer Reviews</h5>
            @forelse($product->reviews as $review)
                <div class="review-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="rating-star {{ $i <= $review->rating ? 'filled' : '' }}"></span>
                            @endfor
                        </div>
                        <small>{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                    <h6 class="mt-2">{{ $review->title }}</h6>
                    <p class="mb-2">{{ $review->comment }}</p>
                    <small>By {{ $review->user->name }}</small>
                    @if ($review->images && is_array($review->images))
                        <div class="review-images">
                            @foreach ($review->images as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Review Image" onerror="this.style.display='none';">
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <p class="no-reviews">No reviews yet.</p>
            @endforelse
        </div>
    </div>
@endsection