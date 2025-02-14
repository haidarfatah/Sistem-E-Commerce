@extends('layouts.app')

@section('title', 'Order History')

@section('content')
<div class="container py-4" style="background: linear-gradient(#A6CDC6, #16404D); border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
    <h1 class="text-center mb-4" style="color: #16404D; font-weight: bold;">Order History</h1>

    @if ($orders->isEmpty())
        <div class="alert alert-warning text-center" style="background-color: #FDF2E1; color: #16404D; border: 1px solid #DDA853;">
            No orders found. Please make a purchase to view your order history.
        </div>
    @else
        <!-- Responsive Table -->
        <div class="table-responsive">
            <table class="table table-hover text-center align-middle" style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                <thead style="background-color: #A6CDC6; color: #16404D; font-weight: bold;">
                    <tr>
                        <th style="background-color: #FBF5DD; ">Order ID</th>
                        <th style="background-color: #FBF5DD; ">Date</th>
                        <th style="background-color: #FBF5DD; ">Image</th>
                        <th style="background-color: #FBF5DD; ">Total Amount</th>
                        <th style="background-color: #FBF5DD; ">Status</th>
                        <th style="background-color: #FBF5DD; ">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders->sortByDesc('order_date') as $order)
                        <tr class="order-row" style="transition: background-color 0.3s;">
                            <!-- Order ID -->
                            <td style="background-color: #FBF5DD; "><strong>#{{ $order->order_id }}</strong></td>

                            <!-- Date -->
                            <td style="background-color: #FBF5DD; ">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>

                            <!-- Image -->
                            <td style="background-color: #FBF5DD; ">
                                @if($order->foto_bukti)
                                    <img src="{{ asset('storage/' . $order->foto_bukti) }}" 
                                         alt="Order Image" 
                                         class="rounded shadow-sm" 
                                         style="width: 75px; height: 75px; object-fit: cover; border: 2px solid #DDA853;">
                                @else
                                    <span class="badge" style="background-color: #DDA853; color: white;">No Image</span>
                                @endif
                            </td>

                            <!-- Total Amount -->
                            <td class="text-success" style="color: #16404D; background-color: #FBF5DD; ">
                                <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                            </td>

                            <!-- Status -->
                            <td style="background-color: #FBF5DD; ">
                                @if ($order->status === 'pending')
                                <span class="badge" style="background-color: #FADA7A; color: #16404D; padding: 5px 10px; border-radius: 8px;">Pending</span>
                            @elseif ($order->status === 'completed')
                                <span class="badge" style="background-color: #AEDDCD; color: #16404D; padding: 5px 10px; border-radius: 8px;">Completed</span>
                            @elseif ($order->status === 'cancelled')
                                <span class="badge" style="background-color: #E4508F; color: #16404D; padding: 5px 10px; border-radius: 8px;">Cancelled</span>
                            @else
                                <span class="badge" style="background-color: #E97777; color: #16404D; padding: 5px 10px; border-radius: 8px;">{{ ucfirst($order->status) }}</span>
                            @endif
                            </td>

                            <!-- Details Button -->
                            <td style="background-color: #FBF5DD; ">
                                <a href="{{ route('order.details', $order->order_id) }}" 
                                   class="btn btn-sm btn-view-details">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Additional Styling -->
<style>
  
</style>
@endsection
