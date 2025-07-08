@extends('admin.layouts.admin')

@section('title', 'Add Category')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Add New Category</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 border border-red-400 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow-md">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1" for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full border px-4 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1" for="slug">Slug (optional)</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="w-full border px-4 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1" for="description">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border px-4 py-2 rounded">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1" for="image">Image</label>
                <input type="file" name="image" id="image" class="w-full">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1" for="parent_id">Parent Category</label>
                <select name="parent_id" id="parent_id" class="w-full border px-4 py-2 rounded">
                    <option value="">-- None --</option>
                    @foreach ($categories as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1" for="sort_order">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                    class="w-full border px-4 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="mr-2">
                    Active
                </label>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save
                    Category</button>
            </div>
        </form>
    </div>
@endsection