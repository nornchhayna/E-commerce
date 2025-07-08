@extends('customer.layouts.app')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Frequently Asked Questions about shopping at YourStore, including shipping, returns, payments, and more.">
    <title>FAQs - YourStore</title>
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

        .faq-section {
            margin-top: 2rem;
        }

        .accordion-button {
            font-weight: 500;
        }

        .accordion-body {
            line-height: 1.6;
        }
    </style>
</head>
@section('content')

    <body>
        <!-- Header (Placeholder, assuming you have a shared header) -->


        <!-- Main Content -->
        <div class="container py-5">
            <h1 class="text-center gradient-text mb-4">Frequently Asked Questions</h1>
            <p class="text-center mb-5">Find answers to common questions about shopping with YourStore. If you need further
                assistance, <a href="{{ route('contact') }}">contact our support team</a>.</p>

            <!-- FAQ Accordion -->
            <div class="faq-section">
                <div class="accordion" id="faqAccordion">
                    <!-- Shipping Questions -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingShipping1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseShipping1" aria-expanded="true" aria-controls="collapseShipping1">
                                How long does shipping take?
                            </button>
                        </h2>
                        <div id="collapseShipping1" class="accordion-collapse collapse show"
                            aria-labelledby="headingShipping1" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Shipping typically takes 3-7 business days within Cambodia and 7-14 business days for
                                international orders, depending on your location and shipping method selected at checkout.
                                You can track your order using the tracking link provided in your confirmation email.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingShipping2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseShipping2" aria-expanded="false" aria-controls="collapseShipping2">
                                What are the shipping costs?
                            </button>
                        </h2>
                        <div id="collapseShipping2" class="accordion-collapse collapse" aria-labelledby="headingShipping2"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Shipping costs vary based on your location and the weight of your order. You can view the
                                exact shipping cost during checkout before completing your purchase. We offer free shipping
                                on orders over $50 within Cambodia.
                            </div>
                        </div>
                    </div>

                    <!-- Returns and Refunds -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingReturns1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseReturns1" aria-expanded="false" aria-controls="collapseReturns1">
                                What is your return policy?
                            </button>
                        </h2>
                        <div id="collapseReturns1" class="accordion-collapse collapse" aria-labelledby="headingReturns1"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                We offer a 30-day return policy for unused and undamaged products in their original
                                packaging. To initiate a return, please visit our <a href="{{ route('returns') }}">Returns
                                    Page</a> or contact our support team at <a
                                    href="mailto:nornchhayna01@gmail.com">nornchhayna01@gmail.com</a>.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingReturns2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseReturns2" aria-expanded="false" aria-controls="collapseReturns2">
                                How do I get a refund?
                            </button>
                        </h2>
                        <div id="collapseReturns2" class="accordion-collapse collapse" aria-labelledby="headingReturns2"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Refunds are processed within 5-10 business days after we receive your returned item. The
                                refund will be issued to your original payment method. Please ensure the item is in its
                                original condition. For more details, see our <a href="{{ route('returns') }}">Returns
                                    Policy</a>.
                            </div>
                        </div>
                    </div>

                    <!-- Payments -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingPayments1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsePayments1" aria-expanded="false" aria-controls="collapsePayments1">
                                What payment methods do you accept?
                            </button>
                        </h2>
                        <div id="collapsePayments1" class="accordion-collapse collapse" aria-labelledby="headingPayments1"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                We accept Visa, Mastercard, PayPal, and American Express. All payments are processed
                                securely through our SSL-certified payment gateway.
                            </div>
                        </div>
                    </div>

                    <!-- Account and Orders -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingAccount1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseAccount1" aria-expanded="false" aria-controls="collapseAccount1">
                                How do I create an account?
                            </button>
                        </h2>
                        <div id="collapseAccount1" class="accordion-collapse collapse" aria-labelledby="headingAccount1"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                To create an account, click the "Sign Up" button at the top of our website and fill in your
                                details. You’ll receive a confirmation email to verify your account. An account allows you
                                to track orders and save your preferences.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingAccount2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseAccount2" aria-expanded="false" aria-controls="collapseAccount2">
                                How can I track my order?
                            </button>
                        </h2>
                        <div id="collapseAccount2" class="accordion-collapse collapse" aria-labelledby="headingAccount2"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Once your order is shipped, you’ll receive a confirmation email with a tracking link. You
                                can also log in to your account and view your order status in the "My Orders" section.
                            </div>
                        </div>
                    </div>

                    <!-- Products -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingProducts1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseProducts1" aria-expanded="false" aria-controls="collapseProducts1">
                                Are your products covered by a warranty?
                            </button>
                        </h2>
                        <div id="collapseProducts1" class="accordion-collapse collapse" aria-labelledby="headingProducts1"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, all our computers and accessories come with a one-year manufacturer’s warranty. For
                                specific warranty details, please check the product page or contact our support team.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support CTA -->
            <div class="text-center mt-5">
                <h5 class="gradient-text">Still Have Questions?</h5>
                <p>Contact our support team for personalized assistance.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary">Get in Touch</a>
            </div>
        </div>



        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
@endsection