@extends('customer.layouts.app')

@section('title', 'Checkout - Shipping & Billing')

@section('styles')
    <style>
        /* Checkout Step 1 Section */
        .checkout-step1-section {
            background-color: #ffffff;
            /* Main color: white */
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

        /* Error Alert */
        .alert-error {
            background: rgba(107, 114, 128, 0.1);
            /* Light gray background */
            color: #9ca3af;
            /* Gray text for error */
            border-radius: 8px;
            padding: 1rem;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        /* Form Grid */
        .checkout-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        /* Form Sections */
        .billing-section,
        .shipping-section {
            background: #ffffff;
            /* White background */
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            /* Lighter shadow */
            padding: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #374151;
            /* Dark gray text */
        }

        /* Form Fields */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            /* Dark gray text */
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            border: 1px solid #e5e7eb;
            /* Light gray border */
            border-radius: 6px;
            padding: 0.75rem;
            font-size: 0.95rem;
            background: #ffffff;
            /* White background */
            color: #374151;
            /* Dark gray text */
            transition: all 0.3s ease;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-input:focus,
        .form-textarea:focus {
            border-color: #374151;
            /* Dark gray focus */
            box-shadow: 0 0 0 0.2rem rgba(55, 65, 81, 0.1);
            /* Subtle gray shadow */
            outline: none;
        }

        /* Checkbox */
        .same-as-billing {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            color: #374151;
            /* Dark gray text */
            margin-bottom: 1.25rem;
        }

        .same-as-billing input {
            width: 1.25rem;
            height: 1.25rem;
            accent-color: #6b7280;
            /* Medium gray for checkbox */
            background: #ffffff;
            /* White background for checkbox */
        }

        /* Submit Button */
        .submit-btn {
            background: #f9fafb;
            /* Light gray background */
            color: #374151;
            /* Dark gray text */
            font-size: 1rem;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            /* Subtle border */
            transition: all 0.3s ease;
            width: 100%;
        }

        .submit-btn:hover {
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
            .checkout-form {
                grid-template-columns: 1fr;
            }

            .billing-section,
            .shipping-section {
                padding: 1rem;
            }

            .section-title {
                font-size: 1.3rem;
            }

            .form-input,
            .form-textarea {
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
            .form-textarea {
                font-size: 0.9rem;
            }

            .submit-btn {
                font-size: 0.95rem;
                padding: 0.6rem 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <section class="checkout-step1-section py-5">
        <div class="checkout-container">
            <h1 class="text-3xl font-bold gradient-text mb-6">Step 1: Shipping & Billing Information</h1>

            <!-- Error Messages -->
            @if (session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            <!-- Checkout Form -->
            <form action="{{ route('orders.store.step1') }}" method="POST" class="checkout-form">
                @csrf

                <!-- Billing Information -->
                <div class="billing-section">
                    <h2 class="section-title gradient-text">Billing Information</h2>
                    <div class="form-group">
                        <label for="billing_first_name" class="form-label">First Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="billing_first_name" id="billing_first_name"
                            value="{{ old('billing_first_name', $shippingData['billing_first_name'] ?? '') }}"
                            class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="billing_last_name" class="form-label">Last Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="billing_last_name" id="billing_last_name"
                            value="{{ old('billing_last_name', $shippingData['billing_last_name'] ?? '') }}"
                            class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="billing_email" class="form-label">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="billing_email" id="billing_email"
                            value="{{ old('billing_email', $shippingData['billing_email'] ?? '') }}" class="form-input"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="billing_phone" class="form-label">Phone</label>
                        <input type="text" name="billing_phone" id="billing_phone"
                            value="{{ old('billing_phone', $shippingData['billing_phone'] ?? '') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="billing_address" class="form-label">Address <span class="text-red-500">*</span></label>
                        <textarea name="billing_address" id="billing_address" class="form-textarea"
                            required>{{ old('billing_address', $shippingData['billing_address'] ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="billing_city" class="form-label">City <span class="text-red-500">*</span></label>
                        <input type="text" name="billing_city" id="billing_city"
                            value="{{ old('billing_city', $shippingData['billing_city'] ?? '') }}" class="form-input"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="billing_state" class="form-label">State <span class="text-red-500">*</span></label>
                        <input type="text" name="billing_state" id="billing_state"
                            value="{{ old('billing_state', $shippingData['billing_state'] ?? '') }}" class="form-input"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="billing_zip_code" class="form-label">Zip Code <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="billing_zip_code" id="billing_zip_code"
                            value="{{ old('billing_zip_code', $shippingData['billing_zip_code'] ?? '') }}"
                            class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="billing_country" class="form-label">Country <span class="text-red-500">*</span></label>
                        <input type="text" name="billing_country" id="billing_country"
                            value="{{ old('billing_country', $shippingData['billing_country'] ?? '') }}" class="form-input"
                            required>
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
                        <label for="shipping_first_name" class="form-label">First Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="shipping_first_name" id="shipping_first_name"
                            value="{{ old('shipping_first_name', $shippingData['shipping_first_name'] ?? '') }}"
                            class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="shipping_last_name" class="form-label">Last Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="shipping_last_name" id="shipping_last_name"
                            value="{{ old('shipping_last_name', $shippingData['shipping_last_name'] ?? '') }}"
                            class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="shipping_address" class="form-label">Address <span class="text-red-500">*</span></label>
                        <textarea name="shipping_address" id="shipping_address" class="form-textarea"
                            required>{{ old('shipping_address', $shippingData['shipping_address'] ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="shipping_city" class="form-label">City <span class="text-red-500">*</span></label>
                        <input type="text" name="shipping_city" id="shipping_city"
                            value="{{ old('shipping_city', $shippingData['shipping_city'] ?? '') }}" class="form-input"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="shipping_state" class="form-label">State <span class="text-red-500">*</span></label>
                        <input type="text" name="shipping_state" id="shipping_state"
                            value="{{ old('shipping_state', $shippingData['shipping_state'] ?? '') }}" class="form-input"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="shipping_zip_code" class="form-label">Zip Code <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="shipping_zip_code" id="shipping_zip_code"
                            value="{{ old('shipping_zip_code', $shippingData['shipping_zip_code'] ?? '') }}"
                            class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="shipping_country" class="form-label">Country <span class="text-red-500">*</span></label>
                        <input type="text" name="shipping_country" id="shipping_country"
                            value="{{ old('shipping_country', $shippingData['shipping_country'] ?? '') }}"
                            class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="shipping_method" class="form-label">Shipping Method</label>
                        <input type="text" name="shipping_method" id="shipping_method"
                            value="{{ old('shipping_method', $shippingData['shipping_method'] ?? '') }}" class="form-input">
                    </div>
                    <button type="submit" class="submit-btn">Continue to Payment</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
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