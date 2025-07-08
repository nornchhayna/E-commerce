@extends('admin.layouts.admin')

@section('title', 'Category Details')

@section('content')
    <div class="container mx-auto p-6">
        <div class="mb-4">
            <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:underline">&larr; Back to
                Categories</a>
        </div>

        <div class="bg-white p-6 rounded shadow-md">
            <h1 class="text-2xl font-bold mb-4">{{ $category->name }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p><strong>ID:</strong> {{ $category->id }}</p>
                    <p><strong>Slug:</strong> {{ $category->slug }}</p>
                    <p><strong>Description:</strong> {{ $category->description ?? 'N/A' }}</p>
                    <p><strong>Parent:</strong> {{ $category->parent ? $category->parent->name : 'None' }}</p>
                    <p><strong>Sort Order:</strong> {{ $category->sort_order }}</p>
                    <p>
                        <strong>Status:</strong>
                        @if ($category->is_active)
                            <span class="text-green-600 font-semibold">Active</span>
                        @else
                            <span class="text-red-600 font-semibold">Inactive</span>
                        @endif
                    </p>
                    <p><strong>Created At:</strong> {{ $category->created_at->format('Y-m-d H:i') }}</p>
                    <p><strong>Updated At:</strong> {{ $category->updated_at->format('Y-m-d H:i') }}</p>
                </div>

                <div>
                    <strong>Image:</strong><br>
                    @if ($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image"
                            class="w-40 h-40 object-cover rounded mt-2">
                    @else
                        <p class="mt-2">No image uploaded</p>
                    @endif
                </div>
            </div>

            <div class="mt-6 flex space-x-4">
                <a href="{{ route('admin.categories.edit', $category->id) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection