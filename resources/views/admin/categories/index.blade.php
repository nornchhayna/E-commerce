@extends('admin.layouts.admin')

@section('title', 'Categories')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Categories</h1>
            <a href="{{ route('admin.categories.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Category</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Slug</th>
                        <th class="px-4 py-2 border">Parent</th>
                        <th class="text-left px-4 py-2">images</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $category->id }}</td>
                            <td class="px-4 py-2 border">{{ $category->name }}</td>
                            <td class="px-4 py-2 border">{{ $category->slug }}</td>
                            <td class="px-4 py-2 border">
                                {{ $category->parent ? $category->parent->name : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                @php
                                    $image = $category->image;
                                @endphp

                                @if ($image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Category image"
                                        class="w-10 h-10 object-cover rounded">
                                @else
                                    <span>No image</span>
                                @endif
                            </td>

                            <td class="px-4 py-2 border">
                                @if ($category->is_active)
                                    <span class="text-green-600 font-semibold">Active</span>
                                @else
                                    <span class="text-red-600 font-semibold">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('admin.categories.show', $category->id) }}"
                                    class="text-indigo-500 hover:underline mr-2">View</a>
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="text-blue-500 hover:underline mr-2">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center px-4 py-4">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{-- {{ $categories->links('vendor.pagination.tailwind') }} button next slide --}}
        </div>
    </div>

    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Optional: Add smooth hover effects for touch devices
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