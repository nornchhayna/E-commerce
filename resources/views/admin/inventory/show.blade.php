@extends('admin.layouts.admin')

@section('title', 'Inventory Details')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Inventory Record Details</h1>

    <div class="bg-white p-6 rounded shadow">
        <p><strong>Product:</strong> {{ $inventory->product->name ?? 'N/A' }}</p>
        <p><strong>Type:</strong> {{ ucfirst($inventory->type) }}</p>
        <p><strong>Quantity Change:</strong> {{ $inventory->quantity_change }}</p>
        <p><strong>Quantity Before:</strong> {{ $inventory->quantity_before }}</p>
        <p><strong>Quantity After:</strong> {{ $inventory->quantity_after }}</p>
        <p><strong>Reason:</strong> {{ $inventory->reason ?? 'N/A' }}</p>
        <p><strong>Notes:</strong> {{ $inventory->notes ?? 'N/A' }}</p>
        <p><strong>Changed By:</strong> {{ $inventory->user->name ?? 'Unknown' }}</p>
        <p><strong>Created At:</strong> {{ $inventory->created_at->format('Y-m-d H:i:s') }}</p>
    </div>

    <a href="{{ route('admin.inventory.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">Back to Inventory
        List</a>
@endsection