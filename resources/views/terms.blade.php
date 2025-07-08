@extends('customer.layouts.app')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="YourStore's Terms of Service outline the rules and responsibilities for using our eCommerce platform to purchase computers and accessories.">
    <title>Terms of Service - YourStore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <style>
        .gradient-text {
            background: linear-gradient(45deg, #007bff, #00ff88);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .terms-section {
            margin-top: 2rem;
        }

        .card {
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            border: none;
            padding: 0.75rem 0;
        }
    </style>
</head>
@section('content')

    <body>


        <!-- Main Content -->
        <div class="container py-5">
            <h1 class="text-center gradient-text mb-4">Terms of Service</h1>
            <p class="text-center mb-5">These Terms of Service govern your use of YourStore’s website and services. By
                accessing or using our platform, you agree to these terms. If you have any questions, please <a
                    href="{{ route('contact') }}">contact us</a>.</p>

            <!-- Introduction -->
            <div class="terms-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Introduction</h3>
                        <p>Welcome to YourStore ("we", "us", or "our"), an eCommerce platform selling computers and
                            accessories. These Terms of Service ("Terms") apply to all users of our website and services. By
                            accessing or using our website, you agree to be bound by these Terms and our related policies,
                            including our <a href="{{ route('privacy') }}">Privacy Policy</a>, <a
                                href="{{ route('shipping') }}">Shipping Policy</a>, and <a
                                href="{{ route('returns') }}">Return Policy</a>.</p>
                        <p>Last updated: June 30, 2025</p>
                    </div>
                </div>
            </div>

            <!-- Acceptance of Terms -->
            <div class="terms-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Acceptance of Terms</h3>
                        <p>By accessing our website, creating an account, or placing an order, you agree to these Terms and
                            all applicable laws. If you do not agree, you must not use our website or services.</p>
                    </div>
                </div>
            </div>

            <!-- Use of the Website -->
            <div class="terms-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Use of the Website</h3>
                        <p>You agree to use our website only for lawful purposes and in accordance with these Terms.
                            Prohibited activities include:</p>
                        <ul>
                            <li>Attempting to gain unauthorized access to our systems or networks.</li>
                            <li>Using the website to transmit harmful content, such as viruses or malware.</li>
                            <li>Engaging in fraudulent activities, including unauthorized use of payment methods.</li>
                            <li>Violating any applicable laws or regulations.</li>
                        </ul>
                        <p>We reserve the right to suspend or terminate your access if you violate these Terms.</p>
                    </div>
                </div>
            </div>

            <!-- Ordering and Payment -->
            <div class="terms-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Ordering and Payment</h3>
                        <p>When you place an order, you agree to:</p>
                        <ul>
                            <li>Provide accurate and complete information for billing and shipping.</li>
                            <li>Pay all applicable charges, including taxes and shipping fees, as displayed at checkout.
                            </li>
                            <li>Accept that all orders are subject to product availability and our confirmation.</li>
                        </ul>
                        <p>Prices are subject to change without notice. We reserve the right to cancel orders due to pricing
                            errors, fraud, or other issues. Payments are processed securely through trusted payment gateways
                            (e.g., Visa, Mastercard, PayPal).</p>
                    </div>
                </div>
            </div>

            <!-- Shipping and Returns -->
            <div class="terms-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Shipping and Returns</h3>
                        <p>Our shipping and return policies govern the delivery and return of products. Please review our <a
                                href="{{ route('shipping') }}">Shipping Policy</a> for details on delivery times and costs,
                            and our <a href="{{ route('returns') }}">Return Policy</a> for eligibility and procedures for
                            returns and refunds.</p>
                    </div>
                </div>
            </div>

            <!-- Warranties and Liability -->
            <div class="terms-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Warranties and Liability</h3>
                        <p>All products come with a one-year manufacturer’s warranty, unless otherwise stated on the product
                            page. We are not liable for:</p>
                        <ul>
                            <li>Indirect, incidental, or consequential damages arising from the use of our products or
                                services.</li>
                            <li>Issues caused by misuse, improper installation, or unauthorized repairs.</li>
                            <li>Delays or failures due to events beyond our control (e.g., natural disasters).</li>
                        </ul>
                        <p>Our liability is limited to the purchase price of the product. For warranty claims, contact us at
                            <a href="mailto:nornchhayna01@gmail.com">nornchhayna01@gmail.com</a>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Intellectual Property -->
            <div class="terms-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Intellectual Property</h3>
                        <p>All content on our website, including text, images, logos, and designs, is owned by YourStore or
                            our licensors and is protected by copyright, trademark, and other intellectual property laws.
                            You may not reproduce, distribute, or modify our content without prior written permission.</p>
                    </div>
                </div>
            </div>

            <!-- Termination -->
            <div class="terms-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Termination</h3>
                        <p>We reserve the right to terminate or suspend your account or access to our website at our
                            discretion, including for violations of these Terms, fraudulent activity, or other misuse of our
                            services. You may terminate your account at any time by contacting us.</p>
                    </div>
                </div>
            </div>

            <!-- Governing Law -->
            <div class="terms-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Governing Law</h3>
                        <p>These Terms are governed by the laws of Cambodia. Any disputes arising from these Terms or your
                            use of our website will be resolved in the courts of Phnom Penh, Cambodia.</p>
                    </div>
                </div>
            </div>

            <!-- Contact Us -->
            <div class="terms-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Contact Us</h3>
                        <p>If you have any questions about these Terms of Service, please contact us:</p>
                        <ul>
                            <li><strong>Email:</strong> <a href="mailto:nornchhayna01@gmail.com">nornchhayna01@gmail.com</a>
                            </li>
                            <li><strong>Phone:</strong> <a href="tel:+0967177746">(885) 0967177746</a></li>
                            <li><strong>Address:</strong> 123 Tech Street, Phnom Penh, Cambodia</li>
                        </ul>
                        <p>We aim to respond to all inquiries within 2 business days.</p>
                    </div>
                </div>
            </div>

            <!-- CTA for Further Assistance -->
            <div class="text-center mt-5">
                <h5 class="gradient-text">Have Questions About Our Terms?</h5>
                <p>Our support team is here to assist with any questions or concerns.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
            </div>
        </div>

        <!-- Footer -->


        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
@endsection