@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
    <div class="container">
        <h1 class="my-4">Manage Orders</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Product Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->user ? $order->user->name : 'User Tidak Ditemukan' }}</td>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-info btn-sm">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
