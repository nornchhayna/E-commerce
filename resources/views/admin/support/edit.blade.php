@extends('admin.layouts.admin')

@section('content')
    <div class="ticket-container">
        <style>
            /* Base Styles */
            .ticket-container {
                background-color: #ffffff;
                border-radius: 0.75rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                overflow: hidden;
                max-width: 40rem;
                margin: 2rem auto;
                padding: 1.5rem 2rem;
                transition: box-shadow 0.3s ease;
            }

            .ticket-container:hover {
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            }

            /* Header */
            .ticket-container h1 {
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
            .error-message {
                color: #991b1b;
                font-size: 0.875rem;
                margin-top: 0.25rem;
            }

            /* Form Styles */
            .ticket-form {
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

            .form-group input,
            .form-group textarea,
            .form-group select {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 1px solid #e5e7eb;
                border-radius: 0.375rem;
                background-color: #ffffff;
                color: #1f2937;
                font-size: 0.875rem;
                transition: all 0.3s ease;
            }

            .form-group input:focus,
            .form-group textarea:focus,
            .form-group select:focus {
                outline: none;
                border-color: #9ca3af;
                box-shadow: 0 0 0 2px rgba(156, 163, 175, 0.2);
            }

            .form-group input::placeholder,
            .form-group textarea::placeholder {
                color: #9ca3af;
            }

            .form-group textarea {
                resize: vertical;
                min-height: 5rem;
            }

            /* Buttons */
            .ticket-buttons {
                display: flex;
                gap: 0.75rem;
            }

            .btn-primary,
            .btn-secondary {
                display: inline-block;
                padding: 0.75rem 1.5rem;
                border-radius: 0.375rem;
                font-size: 0.875rem;
                font-weight: 600;
                text-align: center;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }

            .btn-primary {
                background-color: #4b5563;
                color: #ffffff;
            }

            .btn-primary:hover {
                background-color: #374151;
            }

            .btn-secondary {
                background-color: #e5e7eb;
                color: #1f2937;
            }

            .btn-secondary:hover {
                background-color: #d1d5db;
            }

            .btn-primary:focus,
            .btn-secondary:focus {
                outline: none;
                box-shadow: 0 0 0 2px rgba(156, 163, 175, 0.2);
            }

            /* Responsive Design */
            @media (max-width: 767px) {
                .ticket-container {
                    margin: 1rem;
                    padding: 1rem;
                }

                .ticket-container h1 {
                    font-size: 1.25rem;
                    margin-bottom: 1rem;
                }

                .form-group label {
                    font-size: 0.75rem;
                }

                .form-group input,
                .form-group textarea,
                .form-group select {
                    font-size: 0.75rem;
                    padding: 0.5rem 0.75rem;
                }

                .btn-primary,
                .btn-secondary {
                    padding: 0.5rem 1rem;
                    font-size: 0.75rem;
                }
            }
        </style>


        <div class="container mt-5">
            <h1>Update Support Ticket #{{ $ticket->id }}</h1>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('admin.support.update', ['support' => $ticket->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control"
                        value="{{ old('subject', $ticket->subject) }}" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" id="message" class="form-control"
                        required>{{ old('message', $ticket->message) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                        <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Ticket</button>
            </form>
        </div>
@endsection