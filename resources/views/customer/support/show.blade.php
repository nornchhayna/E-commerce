@extends('customer.layouts.app')

@section('title', 'View Ticket')

@section('content')
    <h1 class="text-xl font-bold mb-4">{{ $ticket->subject }}</h1>
    <p>Status: <strong>{{ ucfirst($ticket->status) }}</strong></p>

    <div class="bg-white border p-4 rounded mt-4">
        <p>{{ $ticket->message }}</p>
    </div>
@endsection