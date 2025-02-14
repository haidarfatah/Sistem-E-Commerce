@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
    <div class="container">
        <h1 class="my-4">Order Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order ID: {{ $order->order_id }}</h5>
                <hr>
                <p><strong>User:</strong> {{ $order->user ? $order->user->name : 'User Tidak Ditemukan' }}</p>
                <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Total Amount:</strong>Rp {{ $order->total_amount }}</p>

                <hr>
                <h5>Order Items</h5>
                @if ($order->details->isEmpty())
                    <p>No items found for this order.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->details as $detail)
                                <tr>
                                    <td>{{ $detail->product ? $detail->product->product_name : 'Product Tidak Ditemukan' }}</td>
                                    <td> {{ $detail->quantity }}</td>
                                    <td>Rp {{ $detail->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <hr>
                <p><strong>Payment Proof:</strong></p>
                @if ($order->foto_bukti)
                    <img src="{{ asset('storage/' . $order->foto_bukti) }}" alt="Payment Proof"
                        class="img-fluid" style="max-width: 350px;">
                @else
                    <p>No payment proof uploaded.</p>
                @endif

                <hr>
                <form action="{{ route('orders.updateStatus', $order->order_id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="status">Change Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Update Status</button>
                </form>
            </div>
        </div>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-4">Back to Orders</a>
    </div>
@endsection
