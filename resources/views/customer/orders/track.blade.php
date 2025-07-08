@extends('customer.layouts.app')

@section('content')
    <div class="container">
        <h1>Your Orders</h1>




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
                        <th>Reviews</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>
                                <span class="badge 
                                                                                                        @if($order->status === 'pending') badge-secondary
                                                                                                        @elseif($order->status === 'processing') badge-warning
                                                                                                        @elseif($order->status === 'shipped') badge-info
                                                                                                        @elseif($order->status === 'delivered') badge-success
                                                                                                        @elseif($order->status === 'cancelled') badge-danger
                                                                                                        @elseif($order->status === 'refunded') badge-dark
                                                                                                        @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>${{ number_format($order->total_amount, 2) }} {{ $order->currency }}</td>
                            <td>
                                <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-info">View Details</a>
                            </td>
                            <td>
                                @if($order->status === 'delivered')
                                    @foreach($order->items as $item) <!-- Assuming 'items' is the relationship for order items -->
                                        <a href="{{ route('reviews.create', ['product' => $item->product_id]) }}"
                                            class="btn btn-primary">Add Review for {{ $item->product_name }}</a>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection