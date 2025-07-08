@extends('admin.layouts.admin')

@section('title', 'Inventory')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Inventory Records</h1>

    <a href="{{ route('admin.inventory.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
        Add Inventory Record
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($inventories->count())
        <table class="w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-100">
                    <th class="text-left px-4 py-2">ID</th>
                    <th class="text-left px-4 py-2">Product</th>
                    <th class="text-left px-4 py-2">Type</th>
                    <th class="text-left px-4 py-2">Quantity Change</th>
                    <th class="text-left px-4 py-2">Before</th>
                    <th class="text-left px-4 py-2">After</th>
                    <th class="text-left px-4 py-2">Reason</th>
                    <th class="text-left px-4 py-2">Notes</th>
                    <th class="text-left px-4 py-2">Changed By</th>
                    <th class="text-left px-4 py-2">Date</th>
                    <th class="text-left px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventories as $inventory)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $inventory->id }}</td>
                        <td class="px-4 py-2">{{ $inventory->product ? $inventory->product->name : 'Deleted Product' }}</td>
                        <td class="px-4 py-2 capitalize">{{ $inventory->type }}</td>
                        <td class="px-4 py-2">{{ $inventory->quantity_change }}</td>
                        <td class="px-4 py-2">{{ $inventory->quantity_before }}</td>
                        <td class="px-4 py-2">{{ $inventory->quantity_after }}</td>
                        <td class="px-4 py-2">{{ $inventory->reason ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $inventory->notes ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $inventory->user ? $inventory->user->name : 'Unknown' }}</td>
                        <td class="px-4 py-2">{{ $inventory->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.inventory.show', $inventory->id) }}"
                                class="text-indigo-500 hover:underline mr-2">View</a>
                            <a href="{{ route('admin.inventory.edit', $inventory->id) }}"
                                class="text-blue-500 hover:underline mr-2">Edit</a>
                            <form action="{{ route('admin.inventory.destroy', $inventory->id) }}" method="POST"
                                style="display:inline-block;" onsubmit="return confirm('Delete this record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $inventories->links('vendor.pagination.tailwind') }}
        </div>
        <div class="mt-4">
            {{ $inventories->links() }}
        </div>
    @else
        <p>No inventory records found.</p>
    @endif
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