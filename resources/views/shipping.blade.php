<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Learn about YourStore's shipping policies, including delivery times, costs, and tracking information for domestic and international orders.">
    <title>Shipping Information - YourStore</title>
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

        .shipping-section {
            margin-top: 2rem;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .card {
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
@extends('customer.layouts.app')
@section('content')

    <body>
        <!-- Header -->


        <!-- Main Content -->
        <div class="container py-5">
            <h1 class="text-center gradient-text mb-4">Shipping Information</h1>
            <p class="text-center mb-5">At YourStore, we strive to deliver your computers and accessories quickly and
                reliably. Below, you’ll find everything you need to know about our shipping policies. For further
                assistance, <a href="{{ route('contact') }}">contact our support team</a>.</p>

            <!-- Shipping Overview -->
            <div class="shipping-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Shipping Overview</h3>
                        <p>We offer fast and reliable shipping options for customers in Cambodia and worldwide. All orders
                            are processed within 1-2 business days, and you’ll receive a tracking number once your order
                            ships.</p>
                        <ul>
                            <li><strong>Free Shipping:</strong> Available on orders over $50 within Cambodia.</li>
                            <li><strong>Standard Shipping:</strong> Affordable rates for domestic and international
                                deliveries.</li>
                            <li><strong>Express Shipping:</strong> Faster delivery for urgent orders (additional fees
                                apply).</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Shipping Rates and Times -->
            <div class="shipping-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Shipping Rates & Delivery Times</h3>
                        <p>Shipping costs and delivery times depend on your location and selected shipping method. Rates are
                            calculated at checkout.</p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Shipping Method</th>
                                    <th scope="col">Estimated Delivery</th>
                                    <th scope="col">Cost</th>
                                </tr>
                                Rady>
                            <tbody>
                                <tr>
                                    <td>Cambodia</td>
                                    <td>Standard Shipping</td>
                                    <td>3-7 business days</td>
                                    <td>$5 or Free (orders over $50)</td>
                                </tr>
                                <tr>
                                    <td>Cambodia</td>
                                    <td>Express Shipping</td>
                                    <td>1-3 business days</td>
                                    <td>$10</td>
                                </tr>
                                <tr>
                                    <td>International</td>
                                    <td>Standard Shipping</td>
                                    <td>7-14 business days</td>
                                    <td>Calculated at checkout</td>
                                </tr>
                                <tr>
                                    <td>International</td>
                                    <td>Express Shipping</td>
                                    <td>3-7 business days</td>
                                    <td>Calculated at checkout</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tracking Orders -->
            <div class="shipping-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Tracking Your Order</h3>
                        <p>Once your order ships, you’ll receive a confirmation email with a tracking link. You can also
                            {{-- track your order by logging into your account and visiting the <a
                                href="{{ route('account.orders') }}">My Orders</a> section. If you encounter any issues,
                            --}}
                            please contact us at <a href="mailto:nornchhayna01@gmail.com">nornchhayna01@gmail.com</a> or
                            call <a href="tel:+0967177746">(885) 0967177746</a>.</p>
                    </div>
                </div>
            </div>

            <!-- International Shipping -->
            <div class="shipping-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">International Shipping</h3>
                        <p>We ship to over 50 countries worldwide. Please note that international orders may be subject to
                            customs fees, duties, or taxes, which are the responsibility of the customer. Delivery times may
                            vary due to customs processing.</p>
                        <p>For specific shipping rates, select your country at checkout or contact our support team for
                            assistance.</p>
                    </div>
                </div>
            </div>

            <!-- Common Shipping Questions -->
            <div class="shipping-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Common Questions</h3>
                        <div class="accordion" id="shippingFaqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFaq1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFaq1" aria-expanded="true" aria-controls="collapseFaq1">
                                        What happens if my order is delayed?
                                    </button>
                                </h2>
                                <div id="collapseFaq1" class="accordion-collapse collapse show"
                                    aria-labelledby="headingFaq1" data-bs-parent="#shippingFaqAccordion">
                                    <div class="accordion-body">
                                        While we strive to meet estimated delivery times, delays may occur due to weather,
                                        customs, or other unforeseen circumstances. If your order is delayed, we’ll notify
                                        you via email and work to resolve the issue promptly.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFaq2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFaq2" aria-expanded="false" aria-controls="collapseFaq2">
                                        Can I change my shipping address after placing an order?
                                    </button>
                                </h2>
                                <div id="collapseFaq2" class="accordion-collapse collapse" aria-labelledby="headingFaq2"
                                    data-bs-parent="#shippingFaqAccordion">
                                    <div class="accordion-body">
                                        If your order hasn’t shipped yet, you can update your shipping address by contacting
                                        our support team at <a
                                            href="mailto:nornchhayna01@gmail.com">nornchhayna01@gmail.com</a>. Once shipped,
                                        address changes are not possible.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFaq3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFaq3" aria-expanded="false" aria-controls="collapseFaq3">
                                        What if my package is lost?
                                    </button>
                                </h2>
                                <div id="collapseFaq3" class="accordion-collapse collapse" aria-labelledby="headingFaq3"
                                    data-bs-parent="#shippingFaqAccordion">
                                    <div class="accordion-body">
                                        If your package is lost, please contact us within 30 days of your order date. We’ll
                                        investigate with the carrier and provide a replacement or refund as needed.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support CTA -->
            <div class="text-center mt-5">
                <h5 class="gradient-text">Need Help with Shipping?</h5>
                <p>Our support team is here to assist you with any shipping-related questions.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
            </div>
        </div>

        <!-- Footer -->


        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
@endsection