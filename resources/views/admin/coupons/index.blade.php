@extends('admin.layouts.admin')

@section('content')
    <div class="px-6 py-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold">Coupons</h1>
            <a href="{{ route('admin.coupons.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + New Coupon
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 text-green-600 bg-green-100 border border-green-300 rounded px-4 py-2">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded overflow-x-auto">
            <table class="w-full text-left table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3">Code</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Value</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Valid From</th>
                        <th class="px-4 py-3">Expires At</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $coupon)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 font-mono">{{ $coupon->code }}</td>
                            <td class="px-4 py-3">{{ $coupon->name }}</td>
                            <td class="px-4 py-3 capitalize">{{ $coupon->type }}</td>
                            <td class="px-4 py-3">
                                {{ $coupon->type === 'percentage' ? $coupon->value . '%' : '₹' . number_format($coupon->value, 2) }}
                            </td>
                            <td class="px-4 py-3">
                                @if($coupon->is_active)
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-sm">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-sm">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $coupon->starts_at?->format('Y-m-d') ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $coupon->expires_at?->format('Y-m-d') ?? '-' }}</td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('admin.coupons.edit', $coupon) }}"
                                    class="text-blue-600 hover:underline text-sm">Edit</a>
                                <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this coupon?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-gray-500">No coupons found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{-- {{ $coupons->links('vendor.pagination.tailwind') }} --}}
        </div>
        <div class="mt-4">
            {{-- {{ $coupons->links() }} --}}
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