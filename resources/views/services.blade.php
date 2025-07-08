@extends('customer.layouts.app')

@section('title', 'Our eCommerce Services')

@section('content')
    <div class="container py-5">
        <h1 class="text-3xl font-bold mb-6 text-center md:text-4xl" id="services-heading">Our eCommerce Services</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" role="region" aria-labelledby="services-heading">
            <!-- Service 1: Product Catalog -->
            <div
                class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition-transform duration-300 transform hover:scale-105">
                <img src="https://images.unsplash.com/photo-1555529669-2242eb2594bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                    alt="Product Catalog icon" class="mx-auto mb-4 h-24 w-24 object-cover rounded-full" loading="lazy"
                    onerror="this.src='https://images.unsplash.com/photo-1625772452859-1c03d5bf1137?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80'">
                <h3 class="text-xl font-semibold mb-2">Product Catalog</h3>
                <p class="text-gray-600 mb-4">Explore thousands of products across fashion, electronics, home goods, and
                    more in our curated catalog.</p>
                <a href="/products"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors"
                    aria-label="Learn more about Product Catalog">
                    Explore Now
                </a>
            </div>

            <!-- Service 2: Fast Shipping -->
            <div
                class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition-transform duration-300 transform hover:scale-105">
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3a8dd22?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                    alt="Fast Shipping icon" class="mx-auto mb-4 h-24 w-24 object-cover rounded-full" loading="lazy"
                    onerror="this.src='https://images.unsplash.com/photo-1625772452859-1c03d5bf1137?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80'">
                <h3 class="text-xl font-semibold mb-2">Fast Shipping</h3>
                <p class="text-gray-600 mb-4">Enjoy reliable and swift delivery to your doorstep with real-time order
                    tracking.</p>
                <a href="/shipping"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors"
                    aria-label="Learn more about Fast Shipping">
                    Explore Now
                </a>
            </div>

            <!-- Service 3: Secure Payments -->
            <div
                class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition-transform duration-300 transform hover:scale-105">
                <img src="https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                    alt="Secure Payments icon" class="mx-auto mb-4 h-24 w-24 object-cover rounded-full" loading="lazy"
                    onerror="this.src='https://images.unsplash.com/photo-1625772452859-1c03d5bf1137?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80'">
                <h3 class="text-xl font-semibold mb-2">Secure Payments</h3>
                <p class="text-gray-600 mb-4">Shop with confidence using secure payment options like credit cards, PayPal,
                    and mobile wallets.</p>
                <a href="/payments"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors"
                    aria-label="Learn more about Secure Payments">
                    Explore Now
                </a>
            </div>
        </div>
    </div>



    <meta name="description"
        content="Discover our eCommerce services including a vast product catalog, fast and reliable shipping, and secure payment options.">
    <meta name="keywords"
        content="eCommerce, online shopping, product catalog, fast shipping, secure payments, online store">
    <script type="application/ld+json">
                        {
                            "@context": "https://schema.org",
                            "@type": "Service",
                            "name": "eCommerce Services",
                            "description": "Comprehensive eCommerce solutions including a vast product catalog, fast shipping, and secure payment options.",
                            "provider": {
                                "@type": "Organization",
                                "name": "Your eCommerce Store"
                            }
                        }
                        </script>
@endsection