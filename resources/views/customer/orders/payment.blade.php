@extends('customer.layouts.app')

@section('title', 'Checkout - Payment Method')

@section('styles')
   <style>/* Payment Step 2 Section */
    .payment-step2-section {
        background-color: #ffffff; /* Main color: white */
        padding: 3rem 0;
        position: relative;
        z-index: 1;
    }
    
    /* Payment Container */
    .payment-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    /* Error Alert */
    .alert-error {
        background: rgba(107, 114, 128, 0.1); /* Light gray background */
        color: #9ca3af; /* Gray text for error */
        border-radius: 8px;
        padding: 1rem;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }
    
    .alert-error ul {
        margin: 0;
        padding-left: 1.5rem;
    }
    
    /* Shipping Summary */
    .shipping-summary {
        background: #ffffff; /* White background */
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03); /* Lighter shadow */
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .summary-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #374151; /* Dark gray text */
    }
    
    .summary-list {
        list-style: none;
        padding: 0;
        font-size: 0.95rem;
        color: #374151; /* Dark gray text */
    }
    
    .summary-list li {
        padding: 0.5rem 0;
        border-bottom: 1px solid #e5e7eb; /* Light gray border */
    }
    
    .summary-list li:last-child {
        border-bottom: none;
    }
    
    /* Payment Form */
    .payment-form {
        background: #ffffff; /* White background */
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03); /* Lighter shadow */
        padding: 1.5rem;
    }
    
    .form-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #374151; /* Dark gray text */
    }
    
    .form-group {
        margin-bottom: 1.25rem;
    }
    
    .radio-group {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .radio-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.95rem;
        color: #374151; /* Dark gray text */
        cursor: pointer;
        padding: 0.75rem;
        border: 1px solid #e5e7eb; /* Light gray border */
        border-radius: 6px;
        transition: all 0.3s ease;
        background: #ffffff; /* White background for radio */
    }
    
    .radio-label:hover {
        border-color: #6b7280; /* Medium gray on hover */
        background: rgba(107, 114, 128, 0.05); /* Very light gray */
    }
    
    .radio-label input {
        width: 1.25rem;
        height: 1.25rem;
        accent-color: #6b7280; /* Medium gray for radio */
        background: #ffffff; /* White background for radio */
        margin: 0;
    }
    
    .radio-icon {
        font-size: 1.2rem;
        color: #6b7280; /* Medium gray for icon */
    }
    
    /* Order Info */
    .order-info {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #374151; /* Dark gray text */
    }
    
    /* Submit Button */
    .submit-btn {
        background: #f9fafb; /* Light gray background */
        color: #374151; /* Dark gray text */
        font-size: 1rem;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        border: 1px solid #e5e7eb; /* Subtle border */
        transition: all 0.3s ease;
        width: 100%;
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); /* Lighter shadow */
        background: #ffffff; /* White background on hover */
        border-color: #d1d5db; /* Slightly darker border */
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .shipping-summary,
        .payment-form {
            padding: 1rem;
        }
    
        .summary-title,
        .form-title {
            font-size: 1.3rem;
        }
    
        .radio-label {
            padding: 0.6rem;
        }
    }
    
    @media (max-width: 576px) {
        .payment-container {
            padding: 0 0.5rem;
        }
    
        .summary-title,
        .form-title {
            font-size: 1.2rem;
        }
    
        .summary-list,
        .radio-label {
            font-size: 0.9rem;
        }
    
        .submit-btn {
            font-size: 0.95rem;
            padding: 0.6rem 1.5rem;
        }
    }</style>
@endsection

@section('content')
    <section class="payment-step2-section py-5">
        <div class="payment-container">
            <h1 class="text-3xl font-bold gradient-text mb-6">Step 2: Payment Method</h1>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            <!-- Shipping Info Summary -->
            <div class="shipping-summary">
                <h2 class="summary-title gradient-text">Shipping Information</h2>
                <ul class="summary-list">
                    <li>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</li>
                    <li>{{ $order->shipping_address }}</li>
                    <li>{{ $order->shipping_city }}, {{ $order->shipping_state }}, {{ $order->shipping_zip_code }}</li>
                    <li>{{ $order->shipping_country }}</li>
                    <li><strong>Shipping Method:</strong> {{ $order->shipping_method ?? 'N/A' }}</li>
                </ul>
            </div>

            <!-- Payment Form -->
            <div class="payment-form">
                <h2 class="form-title gradient-text">Select Payment Method</h2>
                <h3 class="order-info">Order #{{ $order->id }}</h3>
                <form action="{{ route('customer.orders.payment.process', $order->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="payment_method" value="credit_card" required
                                    {{ old('payment_method') == 'credit_card' ? 'checked' : '' }}>
                                <i class="fas fa-credit-card radio-icon"></i>
                                Credit Card
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="payment_method" value="paypal" required
                                    {{ old('payment_method') == 'paypal' ? 'checked' : '' }}>
                                <i class="fab fa-paypal radio-icon"></i>
                                PayPal
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="payment_method" value="cod" required
                                    {{ old('payment_method') == 'cod' ? 'checked' : '' }}>
                                <i class="fas fa-money-bill-wave radio-icon"></i>
                                Cash on Delivery
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">Pay Now</button>
                </form>
            </div>
        </div>
    </section>
@endsection