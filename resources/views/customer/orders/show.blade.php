@extends('customer.layouts.app')

@section('title', 'Order #{{ $order->order_number }}')

@section('styles')
    <style>
        /* Order Details Section */
        .order-details-section {
            background-color: #ffffff;
            /* Main color: white */
            padding: 3rem 0;
            position: relative;
            z-index: 1;
        }

        /* Order Container */
        .order-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Card Sections */
        .order-card,
        .info-card,
        .items-card {
            background: #ffffff;
            /* White background */
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            /* Lighter shadow */
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #374151;
            /* Dark gray text */
        }

        /* Order Header */
        .order-header {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #374151;
            /* Dark gray text */
        }

        /* Summary Info */
        .summary-info {
            font-size: 1rem;
            color: #374151;
            /* Dark gray text */
            margin-bottom: 0.75rem;
        }

        .summary-info strong {
            color: #6b7280;
            /* Medium gray for emphasis */
        }

        /* Info List */
        .info-list {
            list-style: none;
            padding: 0;
            font-size: 0.95rem;
            color: #374151;
            /* Dark gray text */
        }

        .info-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #e5e7eb;
            /* Light gray border */
        }

        .info-list li:last-child {
            border-bottom: none;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .items-table th {
            font-weight: 600;
            color: #374151;
            /* Dark gray text */
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            /* Light gray border */
        }

        .items-table td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #e5e7eb;
            /* Light gray border */
        }

        .items-table tr:last-child td {
            border-bottom: none;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            background: #ffffff;
            /* White background for image */
        }

        .product-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: #374151;
            /* Dark gray text */
            text-decoration: none;
        }

        .product-name:hover {
            color: #6b7280;
            /* Medium gray on hover */
        }

        .price,
        .subtotal {
            font-size: 0.95rem;
            font-weight: 600;
            color: #374151;
            /* Dark gray text */
        }

        /* Review Button */
        .review-btn {
            background: #f9fafb;
            /* Light gray background */
            color: #374151;
            /* Dark gray text */
            font-size: 0.9rem;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            border: 1px solid #e5e7eb;
            /* Subtle border */
        }

        .review-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            /* Lighter shadow */
            background: #ffffff;
            /* White background on hover */
            border-color: #d1d5db;
            /* Slightly darker border */
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {

            .order-card,
            .info-card,
            .items-card {
                padding: 1rem;
            }

            .card-title {
                font-size: 1.3rem;
            }

            .order-header {
                font-size: 1.8rem;
            }

            .items-table th,
            .items-table td {
                font-size: 0.9rem;
                padding: 0.75rem;
            }

            .product-image {
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 576px) {
            .order-container {
                padding: 0 0.5rem;
            }

            .card-title {
                font-size: 1.2rem;
            }

            .order-header {
                font-size: 1.5rem;
            }

            .summary-info,
            .info-list,
            .items-table th,
            .items-table td {
                font-size: 0.85rem;
            }

            .product-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .review-btn {
                font-size: 0.85rem;
                padding: 0.4rem 0.8rem;
            }
        }
    </style>
@endsection

@section('content')
<section class="order-details-section py-5">
    <div class="order-container">
        <h1 class="order-header gradient-text">Order #{{ $order->order_number }}</h1>

        <!-- Order Summary -->
        <div class="order-card">
            <h2 class="card-title gradient-text">Order Summary</h2>
            <p class="summary-info"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p class="summary-info"><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }} {{ $order->currency }}</p>
        </div>

        <!-- Order Items -->
        @if ($order->items->isNotEmpty())
            <div class="items-card">
                <h2 class="card-title gradient-text">Order Items</h2>
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            @if ($order->status === 'delivered')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>
                                    <div class="product-info">
                                        @php
                                            $image = $item->product->image ?? 'images/product-placeholder.jpg';
                                            $imageUrl = asset('storage/' . $image);
                                        @endphp
   <div class="order-item">
    <img src="{{ $imageUrl }}" class="product-image" alt="{{ $item->product->name }}">
    <a href="{{ route('catalog.products.show', ['slug' => $item->product->slug, 'id' => $item->product->id]) }}" class="product-name">{{ $item->product->name }}</a>
</div>
                                    </div>
                                </td>
                                <td class="price">${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="subtotal">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                @if ($order->status === 'delivered')
                                    <td>
                                        <a href="{{ route('reviews.create', $item->product->id) }}" class="btn btn-primary">Add Review</a>
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <h2>Reviews</h2>
                                    @foreach($item->product->reviews as $review)
                                        <div class="review">
                                            <p><strong>Rating:</strong> {{ $review->rating }} Stars</p>
                                            <p><strong>Review:</strong> {{ $review->content }}</p>
                                        </div>
                                    @endforeach

                                    @if($item->product->reviews->isEmpty())
                                        <p>No reviews yet.</p>
                                    @endif

                                    <!-- Review Creation Form -->
                                    {{-- @if ($order->status === 'delivered') if admin change to delivered it show create review --}}
                                    @if ($order->status === 'delivered')
                                        <form action="{{ route('reviews.store', $item->product->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="rating" class="form-label">Rating</label>
                                                <select name="rating" id="rating" class="form-select" required>
                                                    <option value="">Select a rating</option>
                                                    <option value="1">1 Star</option>
                                                    <option value="2">2 Stars</option>
                                                    <option value="3">3 Stars</option>
                                                    <option value="4">4 Stars</option>
                                                    <option value="5">5 Stars</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="content" class="form-label">Review Content</label>
                                                <textarea name="content" id="content" class="form-control" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit Review</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Billing Information -->
        <div class="info-card">
            <h2 class="card-title gradient-text">Billing Information</h2>
            <ul class="info-list">
                <li>{{ $order->billing_first_name }} {{ $order->billing_last_name }}</li>
                <li>{{ $order->billing_address }}</li>
                <li>{{ $order->billing_city }}, {{ $order->billing_state }}, {{ $order->billing_zip_code }}</li>
                <li>{{ $order->billing_country }}</li>
            </ul>
        </div>

        <!-- Shipping Information -->
        <div class="info-card">
            <h2 class="card-title gradient-text">Shipping Information</h2>
            <ul class="info-list">
                <li>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</li>
                <li>{{ $order->shipping_address }}</li>
                <li>{{ $order->shipping_city }}, {{ $order->shipping_state }}, {{ $order->shipping_zip_code }}</li>
                <li>{{ $order->shipping_country }}</li>
            </ul>
        </div>

        <!-- Payment Method -->
        <div class="info-card">
            <h2 class="card-title gradient-text">Payment Method</h2>
            <p class="summary-info">{{ ucfirst($order->payment_method) }}</p>
        </div>
    </div>
</section>
@endsection