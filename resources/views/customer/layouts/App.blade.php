<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - Your Store</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Custom Styles -->
    <style>
        /* Base Styles */
        :root {
            --dark: #ffffff;
            /* Main color: white */
            --light: #ffffff;
            /* Light variant: white */
            --gray-light: #f9fafb;
            /* Very light gray for backgrounds */
            --gray-medium: #222c40;
            /* Medium gray for borders */
            --gray-dark: #374151;
            /* Dark gray for text */
        }



        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        /* Navbar */


        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            /* White background with transparency */
            border-radius: 6px;
        }

        .navbar-toggler {
            border-color: rgba(9, 9, 9, 0.3);
        }

        .navbar-toggler-icon {

            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='black' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Search Form */
        .search-form {
            max-width: 300px;
        }

        .search-form .form-control {
            border-radius: 8px 0 0 8px;
            border: 1px solid var(--gray-medium);
            background: var(--gray-light);
            color: var(--gray-dark);
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .search-form .form-control::placeholder {
            color: var(--gray-dark);
            opacity: 0.7;
        }

        .search-form .form-control:focus {
            border-color: var(--gray-dark);
            background: var(--gray-light);
            color: var(--gray-dark);
            box-shadow: 0 0 0 0.2rem rgba(55, 65, 81, 0.1);
        }

        .search-form .btn-outline-light {
            border-radius: 0 8px 8px 0;
            border: 1px solid var(--gray-medium);
            background: var(--light);
            /* White background for icon */
            color: var(--gray-dark);
            transition: all 0.3s ease;
        }

        .search-form .btn-outline-light:hover {
            background: var(--gray-dark);
            color: var(--gray-light);
        }

        /* Auth Links */
        .auth-links .nav-link {
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .auth-links .badge {
            background: var(--light);
            /* White background for badge */
            color: var(--gray-dark);
            font-size: 0.7rem;
            padding: 0.3em 0.6em;
            margin-left: 0.3rem;
        }

        .logout-btn {
            color: var(--gray-light) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            background: none;
            border: none;
            font-size: 0.9rem;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
        }

        /* Catalog Header */
        .catalog-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            gap: 1.5rem;
            flex-wrap: wrap;
            padding: 0 1rem;
        }

        /* Filter Row */
        .filter-row {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            width: 100%;
            max-width: 900px;
            background-color: var(--light);
            /* White background */
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-label {
            font-weight: 500;
            color: var(--gray-dark);
            margin-right: 1rem;
            white-space: nowrap;
            font-size: 0.95rem;
        }

        .filter-input {
            border: 1px solid var(--gray-medium);
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            background-color: var(--gray-light);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            width: 100px;
        }

        .filter-input:focus {
            border-color: var(--gray-dark);
            box-shadow: 0 0 0 2px rgba(55, 65, 81, 0.2);
            outline: none;
        }

        .filter-btn {
            background-color: var(--gray-dark);
            color: var(--light);
            /* White text on dark gray */
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            border: none;
            transition: background-color 0.2s ease, transform 0.2s ease;
            cursor: pointer;
        }

        .filter-btn:hover {
            background-color: #4b5563;
            transform: translateY(-1px);
        }

        .sort-select {
            border: 1px solid var(--gray-medium);
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            color: var(--gray-dark);
            background-color: var(--gray-light);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            min-width: 180px;
        }

        .sort-select:focus {
            border-color: var(--gray-dark);
            box-shadow: 0 0 0 2px rgba(55, 65, 81, 0.2);
            outline: none;
        }

        /* Catalog Title */
        .catalog-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--gray-dark);
            margin: 0;
        }

        /* Main Content */
        main {
            min-height: calc(100vh - 200px);
            padding: 3rem 0;
            position: relative;
            z-index: 1;
        }

        /* Footer */


        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .navbar-nav {
                margin-top: 1rem;
            }

            .search-form {
                margin: 1rem 0;
                max-width: 100%;
            }

            .auth-links .nav-link {
                padding: 0.75rem 1rem;
            }

            .filter-row {
                padding: 0.75rem;
                gap: 1rem;
            }

            .filter-group {
                gap: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            main {
                padding: 2rem 0;
            }

            footer .col-md-4 {
                text-align: center;
            }

            footer h5::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .catalog-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .catalog-title {
                font-size: 1.75rem;
            }

            .filter-row {
                gap: 0.5rem;
                padding: 0.5rem;
            }

            .filter-input {
                width: 90px;
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="container pt-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>




    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold gradient-text" href="{{ route('catalog.index') }}">CHHAYNA.IO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon ">
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('catalog.index') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('catalog.featured') }}">Featured</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('catalog.category.index') }}">Categories</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.orders.track', '') }}">Track Order</a>
                    </li>
                </ul>

                <form class="search-form d-flex me-3" action="{{ route('catalog.search') }}" method="GET">
                    <input class="form-control me-0" name="query" placeholder="Search products..."
                        aria-label="Search products" />
                    <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <ul class="navbar-nav auth-links">
                    @auth
                        @if(Auth::user()->role === 'customer')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('addresses') }}">
                                    <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                                </a>
                            </li>
                        @endif
                        @php
                            $wishlistCount = auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->id())->count() : 0;
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('wishlist.index') }}">
                                <i class="fas fa-heart me-1"></i>
                                <span class="badge">{{ $wishlistCount }}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart me-1"></i>
                                <span class="badge">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.notifications.index') }}">
                                <i class="fas fa-bell me-1"></i>
                                <span class="badge">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="logout-btn-gray">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item   btn-outline-light"><a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item   btn-outline-light"><a class="nav-link  "
                                href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>



    <!-- Main Content -->
    <main class="container py-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="pt-5 pb-3 mt-5 bg-light">
        <div class="container">
            <div class="row gy-4">
                <!-- About Us Section -->
                <div class="col-md-4 col-sm-6">
                    <h5 class="gradient-text">About YourStore</h5>
                    <p>YourStore is your one-stop shop for quality computers and accessories at unbeatable prices. We
                        are committed to delivering top-notch products and exceptional customer service.</p>
                    <!-- Social Media Links -->
                    <div class="social-links mt-3">
                        <a href="https://facebook.com/yourstore" target="_blank" class="me-2"><i
                                class="bi bi-facebook"></i></a>
                        <a href="https://twitter.com/yourstore" target="_blank" class="me-2"><i
                                class="bi bi-twitter"></i></a>
                        <a href="https://instagram.com/yourstore" target="_blank" class="me-2"><i
                                class="bi bi-instagram"></i></a>
                        <a href="https://linkedin.com/company/yourstore" target="_blank"><i
                                class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <!-- Quick Links Section -->
                <div class="col-md-2 col-sm-6">
                    <h5 class="gradient-text">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('catalog.index') }}">Catalog</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('services') }}">Services</a></li>
                        <li><a href="{{ route('support.index') }}">Support</a></li>
                        <li><a href="{{ route('faq') }}">FAQs</a></li>
                    </ul>
                </div>

                <!-- Customer Service Section -->
                <div class="col-md-3 col-sm-6">
                    <h5 class="gradient-text">Customer Service</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('shipping') }}">Shipping Information</a></li>
                        <li><a href="{{ route('returns') }}">Returns & Refunds</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                        {{-- <li><a href="{{ route('contact') }}">Contact Us</a></li> --}}
                    </ul>
                </div>

                <!-- Contact Us & Newsletter Section -->
                <div class="col-md-3 col-sm-6">
                    <h5 class="gradient-text">Get in Touch</h5>
                    <p>Email: <a href="mailto:nornchhayna01@gmail.com">nornchhayna01@gmail.com</a></p>
                    <p>Phone: <a href="tel:+0967177746">(885) 0967177746</a></p>
                    <p>Address: 123 Tech Street, Phnom Penh, Cambodia</p>
                    <!-- Newsletter Signup -->
                    <h5 class="gradient-text mt-4">Stay Updated</h5>
                    {{-- <form action="{{ route('newsletter.subscribe') }}" method="POST" class="d-flex">
                        <input type="email" class="form-control me-2" placeholder="Enter your email" required>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form> --}}
                </div>
            </div>

            <!-- Payment Methods & Trust Signals -->
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <h6 class="gradient-text">We Accept</h6>
                    <div class="payment-methods mb-3">
                        <img src="/images/payment/visa.png" alt="Visa" class="me-2" style="height: 30px;">
                        <img src="/images/payment/mastercard.png" alt="Mastercard" class="me-2" style="height: 30px;">
                        <img src="/images/payment/paypal.png" alt="PayPal" class="me-2" style="height: 30px;">
                        <img src="/images/payment/amex.png" alt="American Express" style="height: 30px;">
                    </div>
                    <div class="trust-seals">
                        <img src="/images/trust/secure-checkout.png" alt="Secure Checkout" style="height: 40px;">
                        <img src="/images/trust/ssl-certified.png" alt="SSL Certified" style="height: 40px;">
                    </div>
                </div>
            </div>

            <!-- Copyright & Legal Links -->
            <div class="text-center pt-3 border-top mt-4">
                <small>© {{ date('Y') }} YourStore. All Rights Reserved. Designed and Built by <a
                        href="https://chhaynadev.com" target="_blank">Chhayna Dev</a>.</small><br>
                <small>
                    <a href="{{ route('privacy') }}">Privacy Policy</a> |
                    <a href="{{ route('terms') }}">Terms of Service</a>
                    {{-- <a href="{{ route('cookies') }}">Cookie Policy</a> --}}
                </small>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (el) {
                return new bootstrap.Tooltip(el);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')

</body>

</html>