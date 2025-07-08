@extends('customer.layouts.app')

@section('title', 'Shopping Cart')
@section('content')
    <style>
        /* Cart Section */
        .cart-section {
            background-color: #ffffff;
            /* Main color: white */
            padding: 3rem 0;
            position: relative;
            z-index: 1;
        }

        /* Cart Container */
        .cart-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Alerts */
        .alert-success,
        .alert-error {
            border-radius: 8px;
            padding: 1rem;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: rgba(107, 114, 128, 0.1);
            /* Light gray for success */
            color: #6b7280;
            /* Gray text */
        }

        .alert-error {
            background: rgba(107, 114, 128, 0.1);
            /* Light gray for error */
            color: #9ca3af;
            /* Darker gray for error text */
        }

        /* Empty State */
        .empty-cart {
            text-align: center;
            padding: 3rem;
            background: #ffffff;
            /* White background */
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            /* Lighter shadow */
            max-width: 500px;
            margin: 2rem auto;
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
            /* Gray text */
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
            display: inline-block;
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

        /* Cart Table */
        .cart-table {
            background: #ffffff;
            /* White background */
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            /* Lighter shadow */
            padding: 1.5rem;
        }

        .cart-table table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .cart-table th {
            font-weight: 600;
            color: #374151;
            /* Dark gray text */
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            /* Light gray border */
        }

        .cart-table td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #e5e7eb;
            /* Light gray border */
        }

        .cart-table tr:last-child td {
            border-bottom: none;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            background: #ffffff;
            /* White background for image container */
        }

        .product-name {
            font-size: 1rem;
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
            font-size: 1rem;
            font-weight: 600;
            color: #374151;
            /* Dark gray text */
        }

        .quantity-form {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-input {
            width: 60px;
            border: 1px solid #e5e7eb;
            /* Light gray border */
            border-radius: 6px;
            padding: 0.5rem;
            text-align: center;
            font-size: 0.95rem;
            background: #ffffff;
            /* White background */
            color: #374151;
            /* Dark gray text */
        }

        .update-btn,
        .remove-btn {
            font-size: 0.85rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .update-btn {
            color: #6b7280;
            /* Medium gray */
        }

        .update-btn:hover {
            color: #9ca3af;
            /* Lighter gray */
        }

        .remove-btn {
            color: #9ca3af;
            /* Lighter gray for remove */
        }

        .remove-btn:hover {
            color: #6b7280;
            /* Medium gray on hover */
        }

        /* Coupon Form */
        .coupon-form {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .coupon-input {
            border: 1px solid #e5e7eb;
            /* Light gray border */
            border-radius: 6px;
            padding: 0.75rem;
            font-size: 0.95rem;
            width: 50%;
            background: #ffffff;
            /* White background */
            color: #374151;
            /* Dark gray text */
        }

        .apply-coupon-btn {
            background: #f9fafb;
            /* Light gray background */
            color: #374151;
            /* Dark gray text */
            font-size: 0.95rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            /* Subtle border */
            transition: all 0.3s ease;
        }

        .apply-coupon-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            /* Lighter shadow */
            background: #ffffff;
            /* White background on hover */
            border-color: #d1d5db;
            /* Slightly darker border */
        }

        .coupon-applied {
            font-size: 0.95rem;
            color: #6b7280;
            /* Medium gray */
            margin-top: 0.5rem;
        }

        .remove-coupon-btn {
            font-size: 0.85rem;
            color: #9ca3af;
            /* Lighter gray */
            text-decoration: none;
        }

        .remove-coupon-btn:hover {
            color: #6b7280;
            /* Medium gray on hover */
        }

        /* Totals */
        .totals {
            margin-top: 2rem;
            text-align: right;
            font-size: 1rem;
            color: #374151;
            /* Dark gray text */
        }

        .totals p {
            margin: 0.5rem 0;
        }

        .totals .total {
            font-size: 1.2rem;
            font-weight: 700;
            color: #374151;
            /* Dark gray text */
        }

        .checkout-btn {
            background: #f9fafb;
            /* Light gray background */
            color: #374151;
            /* Dark gray text */
            font-size: 1rem;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            /* Subtle border */
        }

        .checkout-btn:hover {
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

            .cart-table th,
            .cart-table td {
                font-size: 0.9rem;
                padding: 0.75rem;
            }

            .product-image {
                width: 60px;
                height: 60px;
            }

            .quantity-input {
                width: 50px;
            }

            .coupon-form {
                flex-direction: column;
            }

            .coupon-input {
                width: 100%;
            }

            .totals {
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .cart-table {
                padding: 1rem;
            }

            .product-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .quantity-form {
                flex-wrap: wrap;
            }

            .cart-table th,
            .cart-table td {
                font-size: 0.85rem;
                padding: 0.5rem;
            }
        }
    </style>



    <section class="cart-section py-5">
        <div class="cart-container">
            <h1 class="text-3xl font-bold gradient-text mb-6">Shopping Cart</h1>

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            @if (empty($cartItems) || collect($cartItems)->isEmpty())
                <!-- Empty State -->
                <div class="empty-cart">
                    <div class="mb-4 position-relative">
                        <div class="empty-icon-bg"></div>
                        <i class="fas fa-shopping-cart fa-5x text-muted animated-icon"></i>
                    </div>
                    <h3 class="h2 fw-bold gradient-text">Your Cart is Empty</h3>
                    <p class="lead text-muted mb-4">
                        Looks like you haven't added any items yet. Explore our catalog to find great products!
                    </p>
                    <a href="{{ route('catalog.index') }}" class="explore-btn">
                        <i class="fas fa-shopping-bag me-2"></i>
                        Explore Catalog
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            @else
                <!-- Cart Table -->
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td>
                                        @php
                                            $productImagePath = $item['image'] ? 'products/' . $item['image'] : null;
                                            $placeholderPath = 'images/product-placeholder.jpg';
                                            $imageUrl = $productImagePath && Storage::disk('public')->exists($productImagePath)
                                                ? asset('storage/' . $productImagePath)
                                                : asset($placeholderPath);
                                        @endphp

                                        <img src="{{ $imageUrl }}" alt="{{ $item['name'] }}" style="width: 60px; height: 60px;">
                                    </td>
                                    <td class="price">${{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $item['id']) }}" method="POST"
                                            class="quantity-form d-flex align-items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                                max="{{ $item['stock'] ?? 10 }}" class="quantity-input form-control form-control-sm"
                                                style="width: 70px;">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                        </form>
                                    </td>
                                    <td class="subtotal">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Coupon Form -->
                    <div class="coupon-form mt-6">
                        <form action="{{ route('cart.applyCoupon') }}" method="POST" class="flex gap-4 items-center">
                            @csrf
                            <input type="text" name="code" placeholder="Coupon Code" class="coupon-input" required>
                            <button type="submit" class="apply-coupon-btn">Apply Coupon</button>
                        </form>
                    </div>

                    @if (Session::has('coupon'))
                        <p class="coupon-applied mt-2">
                            Coupon "<strong>{{ session('coupon.code') }}</strong>" applied:
                            -${{ number_format(session('coupon.discount'), 2) }}
                        </p>
                        <form action="{{ route('cart.removeCoupon') }}" method="POST" class="inline-block mt-2">
                            @csrf
                            <button type="submit" class="remove-coupon-btn">Remove Coupon</button>
                        </form>
                    @endif

                    <!-- Totals -->
                    <div class="totals mt-6">
                        <p><strong>Subtotal:</strong> ${{ number_format($subtotal, 2) }}</p>
                        <p><strong>Tax (10%):</strong> ${{ number_format($tax, 2) }}</p>
                        @if (session('coupon'))
                            <p><strong>Coupon:</strong> {{ session('coupon.code') }}</p>
                            <p><strong>Discount:</strong> -${{ number_format(session('coupon.discount'), 2) }}</p>
                        @endif
                        <p class="total text-lg font-semibold mt-2"><strong>Total:</strong> ${{ number_format($total, 2) }}</p>

                        <a href="{{ route('orders.create') }}" class="checkout-btn mt-4">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection