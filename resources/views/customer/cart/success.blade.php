@extends('customer.layouts.App')
@section('content')
    <div class="text-center p-4">
        <h1 class="text-2xl font-bold">Payment Successful!</h1>
        <p>Your order has been processed. Check your email for confirmation.</p>
        <a href="{{ route('customer.orders.index') }}" class="text-blue-500">View Orders</a>
    </div>
@endsection