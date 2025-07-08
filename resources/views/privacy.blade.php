@extends('customer.layouts.app')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="YourStore's Privacy Policy outlines how we collect, use, protect, and share your personal information when shopping for computers and accessories.">
    <title>Privacy Policy - YourStore</title>
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

        .privacy-section {
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
            <h1 class="text-center gradient-text mb-4">Privacy Policy</h1>
            <p class="text-center mb-5">At YourStore, we are committed to protecting your privacy. This Privacy Policy
                explains how we collect, use, protect, and share your personal information when you shop with us. If you
                have any questions, please <a href="{{ route('contact') }}">contact us</a>.</p>

            <!-- Introduction -->
            <div class="privacy-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Introduction</h3>
                        <p>YourStore ("we", "us", or "our") operates an eCommerce platform selling computers and
                            accessories. This Privacy Policy applies to all users of our website and services. By using our
                            website, you agree to the practices described in this policy. We comply with applicable data
                            protection laws, including GDPR and CCPA, where relevant.</p>
                        <p>Last updated: June 30, 2025</p>
                    </div>
                </div>
            </div>

            <!-- Information We Collect -->
            <div class="privacy-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Information We Collect</h3>
                        <p>We collect information to provide you with a seamless shopping experience. This includes:</p>
                        <ul>
                            <li><strong>Personal Information:</strong> Name, email address, phone number, billing and
                                shipping addresses provided during account creation or checkout.</li>
                            <li><strong>Payment Information:</strong> Credit card details or other payment data, processed
                                securely via our payment gateway.</li>
                            <li><strong>Order Information:</strong> Details about products you purchase, order history, and
                                return requests.</li>
                            <li><strong>Usage Data:</strong> Information about how you interact with our website, such as
                                pages visited, IP address, browser type, and device information.</li>
                            <li><strong>Communications:</strong> Information you provide when contacting our support team or
                                subscribing to our newsletter.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- How We Use Your Information -->
            <div class="privacy-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">How We Use Your Information</h3>
                        <p>We use your information to:</p>
                        <ul>
                            <li>Process and fulfill your orders, including shipping and returns.</li>
                            <li>Communicate with you about your account, orders, or support inquiries.</li>
                            <li>Send promotional emails or newsletters (you can opt out at any time).</li>
                            <li>Improve our website, products, and services through analytics.</li>
                            <li>Prevent fraud and ensure the security of our platform.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Data Sharing -->
            <div class="privacy-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Data Sharing</h3>
                        <p>We may share your information with:</p>
                        <ul>
                            <li><strong>Service Providers:</strong> Third parties that assist with order fulfillment (e.g.,
                                shipping carriers), payment processing, or customer support.</li>
                            <li><strong>Marketing Partners:</strong> If you opt in to marketing, we may share limited data
                                with trusted partners for promotional purposes.</li>
                            <li><strong>Legal Authorities:</strong> If required by law or to protect our rights, we may
                                disclose your information to comply with legal obligations.</li>
                        </ul>
                        <p>We do not sell your personal information to third parties.</p>
                    </div>
                </div>
            </div>

            <!-- Data Security -->
            <div class="privacy-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Data Security</h3>
                        <p>We take data security seriously and use industry-standard measures to protect your information,
                            including:</p>
                        <ul>
                            <li>SSL encryption for secure data transmission.</li>
                            <li>Secure storage of payment information through trusted payment gateways.</li>
                            <li>Regular security audits to identify and address vulnerabilities.</li>
                        </ul>
                        <p>While we strive to protect your data, no system is completely secure. Please notify us
                            immediately if you suspect unauthorized access to your account.</p>
                    </div>
                </div>
            </div>

            <!-- Your Rights -->
            <div class="privacy-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Your Rights</h3>
                        <p>Depending on your location, you may have the following rights regarding your personal data:</p>
                        <ul>
                            <li><strong>Access:</strong> Request a copy of the personal information we hold about you.</li>
                            <li><strong>Correction:</strong> Request updates to inaccurate or incomplete data.</li>
                            <li><strong>Deletion:</strong> Request deletion of your data, subject to legal obligations.</li>
                            <li><strong>Opt-Out:</strong> Unsubscribe from marketing communications at any time.</li>
                        </ul>
                        <p>To exercise these rights, contact us at <a
                                href="mailto:nornchhayna01@gmail.com">nornchhayna01@gmail.com</a>.</p>
                    </div>
                </div>
            </div>

            <!-- Cookies and Tracking -->
            <div class="privacy-section">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="gradient-text">Cookies and Tracking</h3>
                        <p>We use cookies and similar technologies to enhance your experience, analyze website performance,
                            and deliver personalized content. Types of cookies we use:</p>
                        <ul>
                            <li><strong>Essential Cookies:</strong> Necessary for website functionality (e.g., cart
                                management).</li>
                            <li><strong>Analytics Cookies:</strong> Track website usage to improve our services ..


                                <xaiArtifact artifact_id="ac28075f-a96e-40db-bbf5-7a4bad81633a"
                                    artifact_version_id="ffbec073-d0fb-41ce-bc9c-636036bf7f2f" title="privacy.blade.php"
                                    contentType="text/html">


                                    <!DOCTYPE html>
                                    <html lang="en">

                                    <head>
                                        <meta charset="UTF-8">
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                        <meta name="description"
                                            content="YourStore's Privacy Policy outlines how we collect, use, protect, and share your personal όταν shopping for computers and accessories.">
                                        <title>Privacy Policy - YourStore</title>
                                        <!-- Bootstrap CSS -->
                                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
                                            rel="stylesheet">
                                        <!-- Bootstrap Icons -->
                                        <link rel="stylesheet"
                                            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
                                        <!-- Custom CSS -->
                                        <style>
                                            .gradient-text {
                                                background: linear-gradient(45deg, #007bff, #00ff88);
                                                -webkit-background-clip: text;
                                                -webkit-text-fill-color: transparent;
                                            }

                                            .privacy-section {
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

                                    <body>
                                        <!-- Header -->


                                        <!-- Main Content -->
                                        <div class="container py-5">
                                            <h1 class="text-center gradient-text mb-4">Privacy Policy</h1>
                                            <p class="text-center mb-5">At YourStore, we are committed to protecting your
                                                privacy. This Privacy Policy explains how we collect, use, protect, and
                                                share your personal information when you shop with us. If you have any
                                                questions, please <a href="{{ route('contact') }}">contact us</a>.</p>

                                            <!-- Introduction -->
                                            <div class="privacy-section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h3 class="gradient-text">Introduction</h3>
                                                        <p>YourStore ("we", "us", or "our") operates an eCommerce platform
                                                            selling computers and accessories. This Privacy Policy applies
                                                            to all users of our website and services. By using our website,
                                                            you agree to the practices described in this policy. We comply
                                                            with applicable data protection laws, including GDPR and CCPA,
                                                            where relevant.</p>
                                                        <p>Last updated: June 30, 2025</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Information We Collect -->
                                            <div class="privacy-section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h3 class="gradient-text">Information We Collect</h3>
                                                        <p>We collect information to provide you with a seamless shopping
                                                            experience. This includes:</p>
                                                        <ul>
                                                            <li><strong>Personal Information:</strong> Name, email address,
                                                                phone number, billing and shipping addresses provided during
                                                                account creation or checkout.</li>
                                                            <li><strong>Payment Information:</strong> Credit card details or
                                                                other payment data, processed securely via our payment
                                                                gateway.</li>
                                                            <li><strong>Order Information:</strong> Details about products
                                                                you purchase, order history, and return requests.</li>
                                                            <li><strong>Usage Data:</strong> Information about how you
                                                                interact with our website, such as pages visited, IP
                                                                address, browser type, and device information.</li>
                                                            <li><strong>Communications:</strong> Information you provide
                                                                when contacting our support team or subscribing to our
                                                                newsletter.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- How We Use Your Information -->
                                            <div class="privacy-section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h3 class="gradient-text">How We Use Your Information</h3>
                                                        <p>We use your information to:</p>
                                                        <ul>
                                                            <li>Process and fulfill your orders, including shipping and
                                                                returns.</li>
                                                            <li>Communicate with you about your account, orders, or support
                                                                inquiries.</li>
                                                            <li>Send promotional emails or newsletters (you can opt out at
                                                                any time).</li>
                                                            <li>Improve our website, products, and services through
                                                                analytics.</li>
                                                            <li>Prevent fraud and ensure the security of our platform.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Sharing -->
                                            <div class="privacy-section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h3 class="gradient-text">Data Sharing</h3>
                                                        <p>We may share your information with:</p>
                                                        <ul>
                                                            <li><strong>Service Providers:</strong> Third parties that
                                                                assist with order fulfillment (e.g., shipping carriers),
                                                                payment processing, or customer support.</li>
                                                            <li><strong>Marketing Partners:</strong> If you opt in to
                                                                marketing, we may share limited data with trusted partners
                                                                for promotional purposes.</li>
                                                            <li><strong>Legal Authorities:</strong> If required by law or to
                                                                protect our rights, we may disclose your information to
                                                                comply with legal obligations.</li>
                                                        </ul>
                                                        <p>We do not sell your personal information to third parties.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Security -->
                                            <div class="privacy-section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h3 class="gradient-text">Data Security</h3>
                                                        <p>We take data security seriously and use industry-standard
                                                            measures to protect your information, including:</p>
                                                        <ul>
                                                            <li>SSL encryption for secure data transmission.</li>
                                                            <li>Secure storage of payment information through trusted
                                                                payment gateways.</li>
                                                            <li>Regular security audits to identify and address
                                                                vulnerabilities.</li>
                                                        </ul>
                                                        <p>While we strive to protect your data, no system is completely
                                                            secure. Please notify us immediately if you suspect unauthorized
                                                            access to your account.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Your Rights -->
                                            <div class="privacy-section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h3 class="gradient-text">Your Rights</h3>
                                                        <p>Depending on your location, you may have the following rights
                                                            regarding your personal data:</p>
                                                        <ul>
                                                            <li><strong>Access:</strong> Request a copy of the personal
                                                                information we hold about you.</li>
                                                            <li><strong>Correction:</strong> Request updates to inaccurate
                                                                or incomplete data.</li>
                                                            <li><strong>Deletion:</strong> Request deletion of your data,
                                                                subject to legal obligations.</li>
                                                            <li><strong>Opt-Out:</strong> Unsubscribe from marketing
                                                                communications at any time.</li>
                                                        </ul>
                                                        <p>To exercise these rights, contact us at <a
                                                                href="mailto:nornchhayna01@gmail.com">nornchhayna01@gmail.com</a>.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Cookies and Tracking -->
                                            <div class="privacy-section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h3 class="gradient-text">Cookies and Tracking</h3>
                                                        <p>We use cookies and similar technologies to enhance your
                                                            experience, analyze website performance, and deliver
                                                            personalized content. Types of cookies we use:</p>
                                                        <ul>
                                                            <li><strong>Essential Cookies:</strong> Necessary for website
                                                                functionality (e.g., cart management, user login).</li>
                                                            <li><strong>Analytics Cookies:</strong> Track website usage to
                                                                improve our services (e.g., Google Analytics).</li>
                                                            <li><strong>Marketing Cookies:</strong> Used for personalized
                                                                ads and promotions, only with your consent.</li>
                                                        </ul>
                                                        {{-- <p>You can manage your cookie preferences through our <a
                                                                href="{{ route('cookies') }}">Cookie Settings</a> or your
                                                            browser settings. Disabling certain cookies may affect website
                                                            functionality.</p> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Updates to This Policy -->
                                            <div class="privacy-section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h3 class="gradient-text">Updates to This Policy</h3>
                                                        <p>We may update this Privacy Policy from time to time to reflect
                                                            changes in our practices or legal requirements. Any updates will
                                                            be posted on this page with the "Last updated" date revised. We
                                                            encourage you to review this policy periodically.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Contact Us -->
                                            <div class="privacy-section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h3 class="gradient-text">Contact Us</h3>
                                                        <p>If you have any questions or concerns about our Privacy Policy or
                                                            how your data is handled, please reach out to us:</p>
                                                        <ul>
                                                            <li><strong>Email:</strong> <a
                                                                    href="mailto:nornchhayna01@gmail.com">nornchhayna01@gmail.com</a>
                                                            </li>
                                                            <li><strong>Phone:</strong> <a href="tel:+0967177746">(885)
                                                                    0967177746</a></li>
                                                            <li><strong>Address:</strong> 123 Tech Street, Phnom Penh,
                                                                Cambodia</li>
                                                        </ul>
                                                        <p>We aim to respond to all inquiries within 2 business days.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- CTA for Further Assistance -->
                                            <div class="text-center mt-5">
                                                <h5 class="gradient-text">Have Questions About Your Privacy?</h5>
                                                <p>Our support team is here to assist with any privacy-related concerns.</p>
                                                <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
                                            </div>
                                        </div>

                                        <!-- Footer -->


                                        <!-- Bootstrap JS -->
                                        <script
                                            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                                    </body>

                                    </html>
@endsection