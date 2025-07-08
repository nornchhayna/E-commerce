@extends('admin.layouts.admin')

@section('title', 'Product Stored')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow text-center">
        <h2 class="text-2xl font-semibold mb-4">Product Created Successfully!</h2>
        <p>Your new product <strong>{{ $product->name }}</strong> has been saved.</p>

        <a href="{{ route('admin.products.index') }}"
            class="inline-block mt-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Back to Products
        </a>
    </div>
@endsection