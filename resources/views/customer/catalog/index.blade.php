@extends('customer.layouts.app')
{{-- @section('content')
<div class="container py-5">
    @include('customer.catalog.partials.breadcrumbs')

    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3">
            @include('customer.catalog.partials.filters')
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between mb-4">
                <h1 class="h2">Our Products</h1>
                @include('customer.catalog.partials.sorting')
            </div>

            <div class="row">
                @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    @include('customer.catalog.partials.product_card', ['product' => $product])
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">No products found matching your criteria.</div>
                </div>
                @endforelse
            </div>

            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
@extends('layouts.app') --}}

@section('title', 'Product Catalog')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Categories Sidebar -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Categories
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                <a href="{{ route('catalog.index', ['category' => $category->slug]) }}">
                                    {{ $category->name }} ({{ $category->products_count }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Filters -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Filters
                </div>
                <div class="card-body">
                    <form id="filter-form">
                        <div class="mb-3">
                            <label class="form-label">Price Range</label>
                            <div class="row">
                                <div class="col">
                                    <input type="number" class="form-control" placeholder="Min" name="min_price">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" placeholder="Max" name="max_price">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Apply Filters</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Product Catalog</h1>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown"
                        data-bs-toggle="dropdown">
                        Sort By: {{ ucfirst(request('sort', 'latest')) }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?sort=latest">Latest</a></li>
                        <li><a class="dropdown-item" href="?sort=price_asc">Price: Low to High</a></li>
                        <li><a class="dropdown-item" href="?sort=price_desc">Price: High to Low</a></li>
                        <li><a class="dropdown-item" href="?sort=name_asc">Name: A-Z</a></li>
                        <li><a class="dropdown-item" href="?sort=name_desc">Name: Z-A</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('catalog.show', $product->slug) }}">{{ $product->name }}</a>
                                </h5>
                                <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 text-primary">${{ number_format($product->price, 2) }}</span>
                                    @if($product->discount_price)
                                        <small
                                            class="text-muted text-decoration-line-through">${{ number_format($product->discount_price, 2) }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                @auth
                                    <div class="d-flex justify-content-between">
                                        <form action="{{ route('cart.add') }}" method="POST" class="w-100 ms-1">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                                        </form>

                                        <button class="btn btn-sm btn-outline-danger add-to-wishlist" data-id="{{ $product->id }}">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary w-100">
                                        Login to Purchase
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // Add to cart functionality
            $('.add-to-cart').click(function () {
                const productId = $(this).data('id');
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId,
                        quantity: 1
                    },
                    success: function (response) {
                        $('.cart-count').text(response.cartCount);
                        toastr.success('Product added to cart!');
                    }
                });
            });

            // Add to wishlist functionality
            $('.add-to-wishlist').click(function () {
                const productId = $(this).data('id');
                $.ajax({
                    url: "{{ route('wishlist.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId
                    },
                    success: function (response) {
                        $('.wishlist-count').text(response.wishlistCount);
                        toastr.success('Product added to wishlist!');
                    }
                });
            });

            // Filter form submission
            $('#filter-form').submit(function (e) {
                e.preventDefault();
                const formData = $(this).serialize();
                window.location.href = "{{ route('catalog.index') }}?" + formData;
            });
        });
    </script>
@endsection