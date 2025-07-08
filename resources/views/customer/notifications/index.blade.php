@extends('customer.layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Your Notifications</h2>

        @forelse ($notifications as $notification)
            <div class="alert alert-info mb-4">
                <strong>{{ $notification->data['title'] }}</strong><br>
                {{ $notification->data['message'] }}<br>
                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <p class="text-muted">You have no notifications.</p>
        @endforelse


    </div>
@endsection