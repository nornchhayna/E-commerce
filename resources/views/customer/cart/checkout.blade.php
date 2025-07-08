@extends('customer.layouts.app')

@section('title', 'Checkout')

@section('content')
    <style>
        /* Checkout Section */
        .checkout-section {
            background-color: #ffffff;
            padding: 3rem 0;
            position: relative;
            z-index: 1;
        }

        /* Checkout Container */
        .checkout-container {
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

        /* Error Alert */
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-radius: 8px;
            padding: 1rem;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 1.5rem;
        }

        /* Form Grid */
        .checkout-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        /* Form Sections */
        .billing-section,
        .shipping-section,
        .summary-section {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        /* Form Fields */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-input,
        .form-select {
            width: 100%;
            border: 1px solid var(--gray);
            border-radius: 6px;
            padding: 0.75rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(175, 201, 126, 0.25);
            outline: none;
        }

        /* Checkbox */
        .same-as-billing {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            color: var(--dark);
        }

        .same-as-billing input {
            width: 1.25rem;
            height: 1.25rem;
            accent-color: var(--primary-color);
        }

        /* Order Summary */
        .order-summary {
            background: rgba(175, 201, 126, 0.05);
            padding: 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            color: var(--dark);
        }

        .order-summary p {
            margin: 0.5rem 0;
            display: flex;
            justify-content: space-between;
        }

        .order-summary .total {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        /* Submit Button */
        .submit-btn {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(175, 201, 126, 0.3);
            background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .checkout-form {
                grid-template-columns: 1fr;
            }

            .billing-section,
            .shipping-section,
            .summary-section {
                padding: 1rem;
            }

            .section-title {
                font-size: 1.3rem;
            }

            .form-input,
            .form-select {
                padding: 0.6rem;
            }
        }

        @media (max-width: 576px) {
            .checkout-container {
                padding: 0 0.5rem;
            }

            .section-title {
                font-size: 1.2rem;
            }

            .form-label {
                font-size: 0.9rem;
            }

            .form-input,
            .form-select {
                font-size: 0.9rem;
            }

            .submit-btn {
                font-size: 0.95rem;
                padding: 0.6rem 1.5rem;
            }
        }
    </style>


    <section class="checkout-section py-5">
        <div class="checkout-container">
            <h1 class="text-3xl font-bold gradient-text mb-6">Checkout</h1>

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

            <!-- Checkout Form -->
            <form action="{{ route('orders.store') }}" method="POST" class="checkout-form">
                @csrf

                <!-- Billing Information -->
                <div class="billing-section">
                    <h2 class="section-title gradient-text">Billing Information</h2>
                    <div class="form-group">
                        <label for="billing_first_name" class="form-label">First Name</label>
                        <input type="text" name="billing_first_name" id="billing_first_name"
                            value="{{ old('billing_first_name', auth()->user()->name ?? '') }}"
                            class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="billing_last_name" class="form-label">Last Name</label>
                        <input type="text" name="billing_last_name" id="billing_last_name"
                            value="{{ old('billing_last_name') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="billing_email" class="form-label">Email</label>
                        <input type="email" name="billing_email" id="billing_email"
                            value="{{ old('billing_email', auth()->user()->email ?? '') }}"
                            class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="billing_phone" class="form-label">Phone</label>
                        <input type="text" name="billing_phone" id="billing_phone"
                            value="{{ old('billing_phone') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="billing_address" class="form-label">Address</label>
                        <input type="text" name="billing_address" id="billing_address"
                            value="{{ old('billing_address') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="billing_city" class="form-label">City</label>
                        <input type="text" name="billing_city" id="billing_city"
                            value="{{ old('billing_city') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="billing_state" class="form-label">State</label>
                        <input type="text" name="billing_state" id="billing_state"
                            value="{{ old('billing_state') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="billing_zip_code" class="form-label">Zip Code</label>
                        <input type="text" name="billing_zip_code" id="billing_zip_code"
                            value="{{ old('billing_zip_code') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="billing_country" class="form-label">Country</label>
                        <input type="text" name="billing_country" id="billing_country"
                            value="{{ old('billing_country') }}" class="form-input">
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="shipping-section">
                    <h2 class="section-title gradient-text">Shipping Information</h2>
                    <div class="form-group">
                        <label class="same-as-billing">
                            <input type="checkbox" id="same_as_billing" onclick="copyBillingInfo()">
                            Same as Billing
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="shipping_first_name" class="form-label">First Name</label>
                        <input type="text" name="shipping_first_name" id="shipping_first_name"
                            value="{{ old('shipping_first_name') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="shipping_last_name" class="form-label">Last Name</label>
                        <input type="text" name="shipping_last_name" id="shipping_last_name"
                            value="{{ old('shipping_last_name') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="shipping_address" class="form-label">Address</label>
                        <input type="text" name="shipping_address" id="shipping_address"
                            value="{{ old('shipping_address') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="shipping_city" class="form-label">City</label>
                        <input type="text" name="shipping_city" id="shipping_city"
                            value="{{ old('shipping_city') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="shipping_state" class="form-label">State</label>
                        <input type="text" name="shipping_state" id="shipping_state"
                            value="{{ old('shipping_state') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="shipping_zip_code" class="form-label">Zip Code</label>
                        <input type="text" name="shipping_zip_code" id="shipping_zip_code"
                            value="{{ old('shipping_zip_code') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="shipping_country" class="form-label">Country</label>
                        <input type="text" name="shipping_country" id="shipping_country"
                            value="{{ old('shipping_country') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="shipping_method" class="form-label">Shipping Method</label>
                        <select name="shipping_method" id="shipping_method" class="form-select">
                            @foreach ($shippingMethods as $method)
                                <option value="{{ $method['id'] }}"
                                    {{ old('shipping_method') == $method['id'] ? 'selected' : '' }}>
                                    {{ $method['name'] }} - ${{ number_format($method['cost'], 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-select">
                            <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>
                                PayPal/Visa
                            </option>
                            <option value="payway" {{ old('payment_method') == 'payway' ? 'selected' : '' }}>
                                PayWay (Visa/Local Cards)
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="summary-section col-span-1 md:col-span-2">
                    <h2 class="section-title gradient-text">Order Summary</h2>
                    <div class="order-summary">
                        <p><span>Subtotal:</span> ${{ number_format($subtotal, 2) }}</p>
                        <p><span>Tax:</span> ${{ number_format($tax, 2) }}</p>
                        <p class="total"><span>Total:</span> ${{ number_format($total, 2) }}</p>
                    </div>
                    <button type="submit" class="submit-btn">Proceed to Payment</button>
                </div>
            </form>
        </div>
    </section>



    <script>
        function copyBillingInfo() {
            const same = document.getElementById('same_as_billing').checked;
            if (same) {
                const fields = ['first_name', 'last_name', 'address', 'city', 'state', 'zip_code', 'country'];
                fields.forEach(field => {
                    document.getElementById(`shipping_${field}`).value = document.getElementById(`billing_${field}`).value;
                });
            }
        }
    </script>
@endsection