@extends('admin.layouts.admin')

@section('content')
    <div class="container py-4">
        <h2>Low Stock Notifications</h2>

        @forelse(auth()->user()->notifications as $notification)
            <div class="alert alert-warning mb-3">
                <strong>{{ $notification->data['title'] }}</strong><br>
                {{ $notification->data['message'] }}<br>
                <small>{{ $notification->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <p>No notifications.</p>
        @endforelse
    </div>
@endsection