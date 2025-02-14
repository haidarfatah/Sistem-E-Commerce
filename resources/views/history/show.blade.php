@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-4" style=" background: linear-gradient(#A6CDC6, #16404D); border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
    <h1 class="text-center mb-4" style="color: #16404D; font-weight: bold;">Order Details</h1>

    <!-- Order Summary -->
    <div class="mb-4 p-4" style="background-color: #FBF5DD; border-radius: 12px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <h3 class="mb-3" style="color: #16404D; font-weight: bold;">Order Summary</h3>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Order ID:</strong> <span style="color: #DDA853;">{{ $order->order_id }}</span></p>
                <p><strong>Order Date:</strong> <span style="color: #16404D;">{{ \Carbon\Carbon::parse($order->order_date)->format('d F Y, H:i') }}</span></p>
            </div>
            <div class="col-md-6">
                <p><strong>Status:</strong>
                    @if ($order->status === 'pending')
                    <span class="badge" style="background-color: #FADA7A; color: #16404D; padding: 5px 10px; border-radius: 8px;">Pending</span>
                @elseif ($order->status === 'completed')
                    <span class="badge" style="background-color: #AEDDCD; color: #16404D; padding: 5px 10px; border-radius: 8px;">Completed</span>
                @elseif ($order->status === 'cancelled')
                    <span class="badge" style="background-color: #E4508F; color: #16404D; padding: 5px 10px; border-radius: 8px;">Cancelled</span>
                @else
                    <span class="badge" style="background-color: #E97777; color: #16404D; padding: 5px 10px; border-radius: 8px;">{{ ucfirst($order->status) }}</span>
                @endif
                </p>
                <p><strong>Total Amount:</strong> <span style="color: #16404D;">Rp {{ number_format($order->total_amount, 2) }}</span></p>
            </div>
        </div>
    </div>

    <!-- Order Details -->
    @if ($order->orderDetails->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover text-center align-middle" style="background-color: #FBF5DD; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                <thead style="background-color: #A6CDC6; color: #16404D;">
                    <tr >
                        <th style="background-color: #FBF5DD; " >Product Name</th>
                        <th style="background-color: #FBF5DD; ">Quantity</th>
                        <th style="background-color: #FBF5DD; ">Price</th>
                        <th style="background-color: #FBF5DD; ">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $detail)
                        @if ($detail->product)
                            <tr style="transition: background-color 0.3s;">
                                <td style="background-color: #FBF5DD; ">{{ $detail->product->product_name }}</td>
                                <td style="background-color: #FBF5DD; ">{{ $detail->quantity }}</td>
                                <td style="background-color: #FBF5DD; ">Rp {{ number_format($detail->price, 2) }}</td>
                                <td style="background-color: #FBF5DD; ">Rp {{ number_format($detail->price * $detail->quantity, 2) }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="4" class="text-danger">Product not found</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning text-center" style="background-color: #FDF2E1; color: #16404D; border: 1px solid #DDA853;">
            No order details found.
        </div>
    @endif
</div>

<!-- Additional Styling -->
<style>
    /* General Styles */
    body {
        background-color: #FBF5DD;
        font-family: 'Arial', sans-serif;
    }

    .table-hover tbody tr:hover {
        background-color: #FDF2E1;
        transition: background-color 0.3s ease-in-out;
    }

    .badge {
        font-size: 0.85rem;
        text-transform: uppercase;
        font-weight: bold;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .table {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 576px) {
        .table thead {
            display: none;
        }

        .table tbody tr {
            display: block;
            margin-bottom: 15px;
        }

        .table tbody td {
            display: flex;
            justify-content: space-between;
            padding: 8px 10px;
            border: none;
            border-bottom: 1px solid #A6CDC6;
        }

        .table tbody td:last-child {
            border-bottom: none;
        }

        .table tbody td:before {
            content: attr(data-label);
            font-weight: bold;
            color: #16404D;
        }
    }
</style>
@endsection
