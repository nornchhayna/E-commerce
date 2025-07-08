@extends('customer.layouts.app')

@section('title', 'Support Tickets')

@section('content')
    <div class="support-tickets-container">
        <style>
            /* Base Styles */
            .support-tickets-container {
                background-color: #ffffff;
                border-radius: 0.75rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                overflow: hidden;
                max-width: 80rem;
                margin: 1.5rem auto;
                transition: box-shadow 0.3s ease;
            }

            .support-tickets-container:hover {
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            }

            /* Header */
            .support-header {
                background-color: #f9fafb;
                color: #374151;
                padding: 2rem 2rem;
                border-bottom: 1px solid #e5e7eb;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .support-header h1 {
                font-size: 1.875rem;
                font-weight: 700;
                color: #1f2937;
            }

            .support-header a {
                display: inline-flex;
                align-items: center;
                padding: 0.5rem 1.5rem;
                background-color: #ffffff;
                color: #4b5563;
                border: 1px solid #e5e7eb;
                border-radius: 0.5rem;
                text-decoration: none;
                font-size: 0.875rem;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .support-header a:hover {
                background-color: #f3f4f6;
                color: #1f2937;
            }

            /* Content */
            .support-content {
                padding: 1.5rem 2rem;
            }

            .support-content.empty {
                text-align: center;
                padding: 4rem 2rem;
                background-color: #ffffff;
                border-radius: 0.5rem;
            }

            .support-content.empty svg {
                height: 4rem;
                width: 4rem;
                color: #9ca3af;
            }

            .support-content.empty h3 {
                font-size: 1.25rem;
                font-weight: 500;
                color: #374151;
                margin-top: 1rem;
            }

            .support-content.empty p {
                color: #6b7280;
                margin: 0.5rem 0 1rem;
            }

            .support-content.empty a {
                display: inline-block;
                padding: 0.75rem 1.5rem;
                background-color: #4b5563;
                color: #ffffff;
                border-radius: 0.5rem;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }

            .support-content.empty a:hover {
                background-color: #374151;
            }

            /* Ticket List */
            .ticket-list {
                display: flex;
                flex-direction: column;
                gap: 1.25rem;
            }

            .ticket-item {
                border: 1px solid #e5e7eb;
                border-radius: 0.5rem;
                padding: 1.25rem;
                background-color: #ffffff;
                transition: box-shadow 0.3s ease;
            }

            .ticket-item:hover {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .ticket-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
            }

            .ticket-header h3 {
                font-size: 1.125rem;
                font-weight: 600;
                color: #1f2937;
            }

            .ticket-header h3 a {
                color: #1f2937;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .ticket-header h3 a:hover {
                color: #4b5563;
            }

            .ticket-header p {
                color: #6b7280;
                font-size: 0.75rem;
                margin-top: 0.25rem;
            }

            .ticket-status {
                padding: 0.25rem 0.75rem;
                font-size: 0.75rem;
                border-radius: 9999px;
            }

            .ticket-status.open {
                background-color: #d1fae5;
                color: #065f46;
            }

            .ticket-status.pending {
                background-color: #fefcbf;
                color: #854d0e;
            }

            .ticket-status.closed {
                background-color: #e5e7eb;
                color: #374151;
            }

            .ticket-message {
                margin-top: 0.75rem;
                color: #4b5563;
                font-size: 0.875rem;
                line-height: 1.5;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .ticket-footer {
                margin-top: 1rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .ticket-footer span {
                font-size: 0.75rem;
                color: #6b7280;
            }

            .ticket-footer a {
                display: flex;
                align-items: center;
                font-size: 0.75rem;
                color: #4b5563;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .ticket-footer a:hover {
                color: #1f2937;
            }

            .ticket-footer a svg {
                width: 1rem;
                height: 1rem;
                margin-left: 0.25rem;
            }

            /* Pagination */
            .pagination {
                margin-top: 1.5rem;
                display: flex;
                justify-content: center;
                gap: 0.5rem;
            }

            .pagination a,
            .pagination span {
                display: inline-flex;
                align-items: center;
                padding: 0.5rem 1rem;
                border-radius: 0.375rem;
                text-decoration: none;
                font-size: 0.875rem;
                color: #4b5563;
                transition: background-color 0.3s ease;
            }

            .pagination a:hover {
                background-color: #f3f4f6;
            }

            .pagination .current {
                background-color: #e5e7eb;
                color: #1f2937;
                font-weight: 600;
            }

            /* Responsive Design */
            @media (max-width: 640px) {
                .support-header h1 {
                    font-size: 1.5rem;
                }

                .support-header a {
                    padding: 0.25rem 1rem;
                    font-size: 0.75rem;
                }

                .support-content {
                    padding: 1rem;
                }

                .ticket-item {
                    padding: 1rem;
                }

                .ticket-header h3 {
                    font-size: 1rem;
                }

                .ticket-message {
                    font-size: 0.75rem;
                }

                .ticket-footer span,
                .ticket-footer a {
                    font-size: 0.625rem;
                }
            }

            @media (min-width: 641px) and (max-width: 1024px) {
                .support-tickets-container {
                    max-width: 60rem;
                }

                .support-header h1 {
                    font-size: 1.75rem;
                }

                .ticket-header h3 {
                    font-size: 1.125rem;
                }
            }
        </style>

        <div class="support-header">
            <h1>Support Tickets</h1>
            <a href="{{ route('support.create') }}">New Ticket</a>
        </div>

        <div class="support-content">
            @if($tickets->isEmpty())
                <div class="empty">
                    {{-- <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c-.549-1.165-2.03-2-3.228-2 1.682-2.392 4.519-4 7.722-4 3.007 0 5.714 1.553 7.291 3.902C21.128 8.79 22 10.557 22 12.5s-.872 3.71-2.209 4.598c-.576.298-1.162.438-1.791.438-2.203 0-3.953-1.608-4.488-2.5h-2.228c-.535.892-2.285 2.5-4.488 2.5-.629 0-1.215-.14-1.791-.438C2.872 16.21 2 14.443 2 12.5s.872-3.71 2.209-4.598c.576-.298 1.162-.438 1.791-.438 1.198 0 2.679.835 3.228 2zm-1.228 6h2.113c.535-.892 2.285-2.5 4.488-2.5 2.203 0 3.953 1.608 4.488 2.5h2.113c-.67-1.228-1.913-2-3.601-2-1.687 0-3.113.835-3.888 2H8.6c-.775-1.165-2.201-2-3.888-2-1.688 0-2.931.772-3.601 2h2.113c.535-.892 2.285-2.5 4.488-2.5 2.203 0 3.953 1.608 4.488 2.5z" />
                    </svg> --}}
                    <h3>No support tickets yet</h3>
                    <p>Have a question or issue? Create your first support ticket.</p>
                    <a href="{{ route('support.create') }}">Create Ticket</a>
                </div>
            @else
                <div class="ticket-list">
                    @foreach($tickets as $ticket)
                        <div class="ticket-item">
                            <div class="ticket-header">
                                <div>
                                    <h3>
                                        <a href="{{ route('support.show', $ticket->id) }}">{{ $ticket->subject }}</a>
                                    </h3>
                                    <p>Created: {{ $ticket->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="ticket-status {{ $ticket->status }}">
                                    {{ ucfirst($ticket->status) }}
                                </div>
                            </div>
                            <div class="ticket-message">
                                {{ $ticket->message }}
                            </div>
                            <div class="ticket-footer">
                                <span>Last updated: {{ $ticket->updated_at->diffForHumans() }}</span>
                                <a href="{{ route('support.show', $ticket->id) }}">
                                    View Details
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination">
                    {{ $tickets->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection