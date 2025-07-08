@extends('customer.layouts.App')
@section('content')
    <div class="text-center p-4">
        <h1 class="text-2xl font-bold">Payment Cancelled</h1>
        <p>Your payment was cancelled. Please try again.</p>
        <a href="{{ route('customer.checkout') }}" class="text-blue-500">Back to Checkout</a>
    </div>
@endsection