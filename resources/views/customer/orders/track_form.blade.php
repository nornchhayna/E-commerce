<!-- resources/views/orders/track.blade.php -->
@extends('customer.layouts.app')

@section('content')
    <div class="container">
        <h1>Your Orders</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($orders->isEmpty())
            <p>You have no orders yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>${{ number_format($order->total_amount, 2) }} {{ $order->currency }}</td>
                            <td>
                                <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-info">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection