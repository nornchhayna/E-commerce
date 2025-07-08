@extends('customer.layouts.app')

@section('title', 'Write a Review')

@section('content')
    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Write a Review for {{ $product->name }}</h1>

        <form action="{{ route('reviews.store', $product->id) }}" method="POST" enctype="multipart/form-data">
            class="space-y-4">
            @csrf
            <div>
                <label for="rating">Rating:</label>
                <select name="rating" id="rating" class="border rounded p-2 w-full">
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="border rounded p-2 w-full">
            </div>

            <div>
                <label for="comment">Comment:</label>
                <textarea name="comment" id="comment" class="border rounded p-2 w-full"></textarea>
            </div>

            <div>
                <label for="images">Upload Images:</label>
                <input type="file" name="images[]" multiple class="w-full">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit Review</button>
        </form>
    </div>
@endsection