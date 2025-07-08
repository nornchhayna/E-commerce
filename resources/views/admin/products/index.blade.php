@extends('admin.layouts.admin')

@section('title', 'Products')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Products</h1>
    <a href="{{ route('admin.products.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow inline-block mb-4">+ Add Product</a>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-100 text-left text-sm text-gray-700">
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3">Images</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach ($products as $product)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">${{ $product->price }}</td>
                        <td class="px-4 py-2">{{ $product->stock_quantity }}</td>
                        <td class="px-4 py-2">
                            @php
                                $images = $product->images;
                                if (is_string($images)) {
                                    $images = json_decode($images, true);
                                }
                            @endphp

                            @if (!empty($images) && is_array($images))
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($images as $image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="product image"
                                            class="w-10 h-10 object-cover rounded border">
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-500">No images</span>
                            @endif
                        </td>

                        <td class="px-4 py-2">{{ ucfirst(str_replace('_', ' ', $product->stock_status)) }}</td>

                        <td class="px-4 py-2 flex flex-wrap gap-2">
                            <a href="{{ route('admin.products.show', $product) }}"
                                class="text-blue-600 hover:underline">View</a>

                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded shadow text-sm">Edit</a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this product?');"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow text-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links('vendor.pagination.tailwind') }}
    </div>

    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            if ('ontouchstart' in window) {
                document.querySelectorAll('.product-card').forEach(card => {
                    card.addEventListener('click', function () {
                        this.classList.toggle('hover-state');
                    });
                });
            }
        });
    </script>
@endsection