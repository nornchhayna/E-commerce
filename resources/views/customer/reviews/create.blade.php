@extends('customer.layouts.app')

@section('title', 'Write a Review')

@section('content')
    <div class="review-container">
        <style>
            /* Base Styles */
            .review-container {
                background-color: #ffffff;
                border-radius: 0.75rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                overflow: hidden;
                max-width: 32rem;
                margin: 2rem auto;
                padding: 1.5rem 2rem;
                transition: box-shadow 0.3s ease;
            }

            .review-container:hover {
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            }

            /* Header */
            .review-container h1 {
                font-size: 1.5rem;
                font-weight: 700;
                color: #1f2937;
                margin-bottom: 1.5rem;
            }

            /* Success Alert */
            .alert-success {
                background-color: #f0fdf4;
                color: #065f46;
                padding: 0.75rem 1rem;
                border-radius: 0.375rem;
                margin-bottom: 1.5rem;
                font-size: 0.875rem;
                text-align: center;
            }

            /* Error Alert */
            .alert-error {
                background-color: #fef2f2;
                color: #991b1b;
                padding: 0.75rem 1rem;
                border-radius: 0.375rem;
                margin-bottom: 1.5rem;
                font-size: 0.875rem;
            }

            .alert-error ul {
                list-style: disc;
                padding-left: 1.5rem;
                margin: 0;
            }

            .alert-error li {
                margin-bottom: 0.25rem;
            }

            /* Form Styles */
            .review-form {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .form-group label {
                display: block;
                font-size: 0.875rem;
                font-weight: 500;
                color: #4b5563;
                margin-bottom: 0.5rem;
            }

            .form-group select,
            .form-group input,
            .form-group textarea {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 1px solid #e5e7eb;
                border-radius: 0.375rem;
                background-color: #ffffff;
                color: #1f2937;
                font-size: 0.875rem;
                transition: all 0.3s ease;
            }

            .form-group select:focus,
            .form-group input:focus,
            .form-group textarea:focus {
                outline: none;
                border-color: #9ca3af;
                box-shadow: 0 0 0 2px rgba(156, 163, 175, 0.2);
            }

            .form-group select option,
            .form-group input::placeholder,
            .form-group textarea::placeholder {
                color: #9ca3af;
            }

            .form-group textarea {
                resize: vertical;
                min-height: 7.5rem;
            }

            /* Submit Button */
            .submit-button {
                display: inline-block;
                padding: 0.75rem 1.5rem;
                background-color: #4b5563;
                color: #ffffff;
                border-radius: 0.375rem;
                font-size: 0.875rem;
                font-weight: 600;
                text-align: center;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }

            .submit-button:hover {
                background-color: #374151;
            }

            .submit-button:focus {
                outline: none;
                box-shadow: 0 0 0 2px rgba(156, 163, 175, 0.2);
            }

            /* Responsive Design */
            @media (max-width: 767px) {
                .review-container {
                    margin: 1rem;
                    padding: 1rem;
                }

                .review-container h1 {
                    font-size: 1.25rem;
                    margin-bottom: 1rem;
                }

                .form-group label {
                    font-size: 0.75rem;
                }

                .form-group select,
                .form-group input,
                .form-group textarea {
                    font-size: 0.75rem;
                    padding: 0.5rem 0.75rem;
                }

                .submit-button {
                    padding: 0.5rem 1rem;
                    font-size: 0.75rem;
                }
            }
        </style>

        <h1>Write a Review for {{ $product->name }}</h1>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reviews.store', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="review-form">
            @csrf

            <div class="form-group">
                <label for="rating">Rating</label>
                <select name="rating" id="rating" required>
                    <option value="">Select rating</option>
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="comment" id="comment" rows="5">{{ old('comment') }}</textarea>
            </div>

            <div class="form-group">
                <label for="images">Upload Images (optional)</label>
                <input type="file" name="images[]" id="images" multiple>
            </div>

            <button type="submit" class="submit-button">Submit Review</button>
        </form>
    </div>
@endsection