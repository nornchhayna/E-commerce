@extends('admin.layouts.admin')

@section('title', 'Admin Support Tickets')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        <!-- Header and Search -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h1 class="text-2xl font-bold text-gray-800">Support Tickets</h1>
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                <form method="GET" action="{{ route('admin.support.index') }}" class="w-full sm:w-auto">
                    <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Search by ID, customer, or subject...">
                    <input type="hidden" name="sort" value="{{ request('sort', 'created_at') }}">
                    <input type="hidden" name="direction" value="{{ request('direction', 'desc') }}">
                </form>
                <form method="GET" action="{{ route('admin.support.index') }}" class="w-full sm:w-auto">
                    <select name="status"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                        <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="sort" value="{{ request('sort', 'created_at') }}">
                    <input type="hidden" name="direction" value="{{ request('direction', 'desc') }}">
                </form>
            </div>
        </div>

        <!-- Tickets Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">
                            <a href="{{ route('admin.support.index', ['sort' => 'id', 'direction' => request('direction', 'asc') === 'asc' ? 'desc' : 'asc', 'search' => request('search'), 'status' => request('status')]) }}"
                                class="hover:text-blue-600">
                                ID {{ request('sort') === 'id' ? (request('direction') === 'asc' ? '↑' : '↓') : '' }}
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Customer</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Subject</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Message</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">
                            <a href="{{ route('admin.support.index', ['sort' => 'status', 'direction' => request('direction', 'asc') === 'asc' ? 'desc' : 'asc', 'search' => request('search'), 'status' => request('status')]) }}"
                                class="hover:text-blue-600">
                                Status
                                {{ request('sort') === 'status' ? (request('direction') === 'asc' ? '↑' : '↓') : '' }}
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody id="ticketsTable">
                    @forelse ($tickets as $ticket)
                        <tr class="border-b hover:bg-gray-50 transition-colors cursor-pointer">
                            <td class="px-6 py-4">{{ $ticket->id }}</td>
                            <td class="px-6 py-4">{{ $ticket->user ? $ticket->user->name : 'Guest' }}</td>
                            <td class="px-6 py-4">{{ $ticket->subject }}</td>
                            <td class="px-6 py-4">{{ Str::limit($ticket->message, 50) }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$ticket->status] ?? $statusClasses['default'] }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('admin.support.edit', $ticket->id) }}"
                                    class="text-blue-600 hover:text-blue-800 transition-colors" data-bs-toggle="tooltip"
                                    title="Update ticket">Update</a>
                                <form action="{{ route('admin.support.destroy', $ticket->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this ticket?');"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition-colors"
                                        data-bs-toggle="tooltip" title="Delete ticket">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <tr class="border-b bg-gray-50 hidden" id="details-{{ $ticket->id }}">
                            <td colspan="6" class="px-6 py-4">
                                <div class="ml-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Ticket Details (ID: {{ $ticket->id }})
                                    </h4>
                                    <div class="text-sm text-gray-600">
                                        <p><strong>Customer:</strong> {{ $ticket->user ? $ticket->user->name : 'Guest' }}</p>
                                        <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
                                        <p><strong>Full Message:</strong> {{ $ticket->message }}</p>
                                        <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                                        <p><strong>Created:</strong> {{ $ticket->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-600">
                                No tickets found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $tickets->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Bootstrap tooltips
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            [...tooltipTriggerList].forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

            // Toggle ticket details
            document.querySelectorAll('tbody tr:not(.bg-gray-50)').forEach(row => {
                row.addEventListener('click', function (e) {
                    if (e.target.tagName !== 'A' && e.target.tagName !== 'BUTTON') {
                        const ticketId = this.querySelector('td').textContent;
                        const detailsRow = document.getElementById(`details-${ticketId}`);
                        if (detailsRow) {
                            detailsRow.classList.toggle('hidden');
                        }
                    }
                });
            });
        });
    </script>
@endsection