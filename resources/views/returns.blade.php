@extends('customer.layouts.app')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Learn about YourStore's return and refund policies, including how to initiate a return and our refund process for computers and accessories.">
    <title>Return Policy - YourStore</title>
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

        .returns-section {
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
        <!-- Header -->


        <!-- Main Content -->
        <div class="container py-5">
            <h1 class="text-center gradient-text mb-4">Return & Refund Policy</h1>
            <p class="text-center mb-5">At YourStore, we want you to be completely satisfied with your purchase. Below,
                you’ll find our return and refund policies for computers and accessories. For further assistance, <a
                    href="{{ route('contact') }}">contact our support team</a>.</p>

            <!-- Return Policy Overview -->
            <div class="returns-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Return Policy Overview</h3>
                        <p>We offer a 30-day return policy for eligible items. To qualify for a return, items must be:</p>
                        <ul>
                            <li>Unused and in their original condition.</li>
                            <li>In the original packaging with all accessories, manuals, and tags.</li>
                            <li>Returned within 30 days from the delivery date.</li>
                        </ul>
                        <p><strong>Note:</strong> Certain items, such as software, custom-built computers, or clearance
                            items, are non-returnable unless defective. See the Exceptions section below for details.</p>
                    </div>
                </div>
            </div>

            <!-- How to Return -->
            <div class="returns-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">How to Return an Item</h3>
                        <p>Follow these steps to initiate a return:</p>
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item"><strong>Contact Us:</strong> Reach out to our support team at <a
                                    href="mailto:nornchhayna01@gmail.com">nornchhayna01@gmail.com</a> or call <a
                                    href="tel:+0967177746">(885) 0967177746</a> to request a return. Provide your order
                                number and reason for return.</li>
                            <li class="list-group-item"><strong>Receive Return Authorization:</strong> We’ll provide a
                                Return Merchandise Authorization (RMA) number and shipping instructions.</li>
                            <li class="list-group-item"><strong>Pack the Item:</strong> Securely pack the item in its
                                original packaging, including all accessories.</li>
                            <li class="list-group-item"><strong>Ship the Item:</strong> Send the package to our return
                                address (provided with the RMA). Customers are responsible for return shipping costs unless
                                the item is defective.</li>
                            <li class="list-group-item"><strong>Receive Refund or Replacement:</strong> Once we receive and
                                inspect the item, we’ll process your refund or replacement within 5-10 business days.</li>
                        </ol>
                        {{-- <a href="{{ route('account.returns') }}" class="btn btn-primary mt-3">Start a Return</a> --}}
                    </div>
                </div>
            </div>

            <!-- Refund Details -->
            <div class="returns-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Refund Details</h3>
                        <p>Refunds are issued to the original payment method within 5-10 business days after we receive and
                            inspect the returned item. Key points:</p>
                        <ul>
                            <li>Refunds include the item cost, excluding original shipping fees.</li>
                            <li>Return shipping costs are the customer’s responsibility unless the item is defective or
                                incorrect.</li>
                            <li>Restocking fees may apply for non-defective returns (15% of the item price, if applicable).
                            </li>
                        </ul>
                        <p>If you receive a defective or incorrect item, please contact us immediately for a free return and
                            replacement or refund.</p>
                    </div>
                </div>
            </div>

            <!-- Exceptions -->
            <div class="returns-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Return Exceptions</h3>
                        <p>The following items are non-returnable unless defective:</p>
                        <ul>
                            <li>Software or digital downloads.</li>
                            <li>Custom-built computers or personalized products.</li>
                            <li>Clearance or final sale items.</li>
                            <li>Items damaged due to misuse or improper handling.</li>
                        </ul>
                        <p>For defective items, we offer replacements or repairs under our one-year manufacturer’s warranty.
                            Contact us for details.</p>
                    </div>
                </div>
            </div>

            <!-- Common Questions -->
            <div class="returns-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Common Questions</h3>
                        <div class="accordion" id="returnsFaqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFaq1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFaq1" aria-expanded="true" aria-controls="collapseFaq1">
                                        How long does it take to process a refund?
                                    </button>
                                </h2>
                                <div id="collapseFaq1" class="accordion-collapse collapse show"
                                    aria-labelledby="headingFaq1" data-bs-parent="#returnsFaqAccordion">
                                    <div class="accordion-body">
                                        Refunds are processed within 5-10 business days after we receive and inspect the
                                        returned item. You’ll receive a confirmation email once the refund is issued.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFaq2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFaq2" aria-expanded="false" aria-controls="collapseFaq2">
                                        Can I exchange an item instead of a refund?
                                    </button>
                                </h2>
                                <div id="collapseFaq2" class="accordion-collapse collapse" aria-labelledby="headingFaq2"
                                    data-bs-parent="#returnsFaqAccordion">
                                    <div class="accordion-body">
                                        Yes, exchanges are available for eligible items. Please indicate your preference for
                                        an exchange when contacting our support team to initiate the return.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFaq3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFaq3" aria-expanded="false" aria-controls="collapseFaq3">
                                        What if I received a damaged or incorrect item?
                                    </button>
                                </h2>
                                <div id="collapseFaq3" class="accordion-collapse collapse" aria-labelledby="headingFaq3"
                                    data-bs-parent="#returnsFaqAccordion">
                                    <div class="accordion-body">
                                        If you received a damaged or incorrect item, contact us within 7 days of delivery at
                                        <a href="mailto:nornchhayna01@gmail.com">nornchhayna01@gmail.com</a>. We’ll provide
                                        a free return label and arrange a replacement or refund.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support CTA -->
            <div class="text-center mt-5">
                <h5 class="gradient-text">Need Help with Returns?</h5>
                <p>Our support team is here to assist you with any return or refund questions.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
            </div>
        </div>

        <!-- Footer -->


        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
@endsection