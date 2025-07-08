@extends('customer.layouts.app')

@section('title', 'Create Support Ticket')

@section('content')
    <div class="support-ticket-container">
        <style>
            /* Base Styles */
            .support-ticket-container {
                background-color: #ffffff;
                border-radius: 0.75rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                overflow: hidden;
                max-width: 64rem;
                margin: 2rem auto;
                transition: box-shadow 0.3s ease;
            }

            .support-ticket-container:hover {
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            }

            /* Header */
            .support-header {
                background-color: #f9fafb;
                color: #374151;
                padding: 2rem 2rem;
                border-bottom: 1px solid #e5e7eb;
            }

            .support-header h1 {
                font-size: 1.875rem;
                font-weight: 700;
                color: #1f2937;
                margin-bottom: 0.25rem;
            }

            .support-header p {
                font-size: 0.875rem;
                color: #6b7280;
                margin: 0;
            }

            /* Form Container */
            .support-form {
                padding: 1.5rem 2rem;
            }

            .support-form form {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            /* Grid Layout */
            .form-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            @media (min-width: 768px) {
                .form-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            /* Form Fields */
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
                border-radius: 0.5rem;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
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
                min-height: 10rem;
            }

            /* Attachments */
            .attachment-area {
                margin-top: 0.5rem;
                display: flex;
                justify-content: center;
                padding: 1.5rem;
                border: 2px dashed #e5e7eb;
                border-radius: 0.5rem;
                background-color: #ffffff;
                transition: border-color 0.3s ease;
            }

            .attachment-area:hover {
                border-color: #d1d5db;
            }

            .attachment-area .upload-content {
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }

            .attachment-area svg {
                height: 3rem;
                width: 3rem;
                color: #9ca3af;
            }

            .attachment-area label {
                cursor: pointer;
                font-weight: 500;
                color: #4b5563;
                transition: color 0.3s ease;
            }

            .attachment-area label:hover {
                color: #374151;
            }

            .attachment-area input {
                display: none;
            }

            .attachment-area p {
                font-size: 0.75rem;
                color: #6b7280;
            }

            /* Buttons */
            .form-actions {
                display: flex;
                justify-content: flex-end;
                gap: 1rem;
            }

            .form-actions a,
            .form-actions button {
                display: inline-flex;
                align-items: center;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                font-size: 0.875rem;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .form-actions a {
                background-color: #ffffff;
                border: 1px solid #e5e7eb;
                color: #4b5563;
            }

            .form-actions a:hover {
                background-color: #f3f4f6;
                color: #1f2937;
            }

            .form-actions button {
                background-color: #4b5563;
                color: #ffffff;
                border: none;
            }

            .form-actions button:hover {
                background-color: #374151;
            }

            .form-actions button:focus,
            .form-actions a:focus {
                outline: none;
                box-shadow: 0 0 0 2px rgba(156, 163, 175, 0.2);
            }

            /* Responsive Design */
            @media (max-width: 767px) {
                .support-ticket-container {
                    margin: 1rem;
                }

                .support-header {
                    padding: 1.5rem 1rem;
                }

                .support-header h1 {
                    font-size: 1.5rem;
                }

                .support-form {
                    padding: 1rem;
                }

                .form-actions a,
                .form-actions button {
                    padding: 0.5rem 1rem;
                    font-size: 0.75rem;
                }
            }
        </style>

        <div class="support-header">
            <h1>Create Support Ticket</h1>
            <p>Let us assist you with your query.</p>
        </div>

        <div class="support-form">
            <form action="{{ route('support.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" required placeholder="Enter subject">
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select name="priority" id="priority">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" rows="6" required placeholder="Enter your message"></textarea>
                </div>

                <div class="form-group">
                    <label>Attachments</label>
                    <div class="attachment-area">
                        <div class="upload-content">
                            <svg stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div>
                                <label for="file-upload">Upload a file</label>
                                <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                <p>or drag and drop</p>
                            </div>
                            <p>PNG, JPG, PDF up to 10MB</p>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('support.index') }}">Cancel</a>
                    <button type="submit">Submit Ticket</button>
                </div>
            </form>
        </div>
    </div>
@endsection