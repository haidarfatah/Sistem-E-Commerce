@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="checkout-container container">
    <h1 class="text-center mb-4 fw-bold" style="color: #16404D;">Checkout</h1>

    @if (session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @if (!empty($cart) && count($cart) > 0)
        <div class="row g-4">
            <!-- Cart Table -->
            <div class="col-lg-8">
                <div class="table-responsive shadow-sm" style="background-color: #A6CDC6; border-radius: 15px; padding: 20px;">
                    <table class="table table-borderless align-middle">
                        <thead class="text-white text-center" style="background-color: #16404D; border-radius: 15px;">
                            <tr ">
                                <th style="background-color: #A6CDC6" class="text-start">Product Name</th>
                                <th style="background-color: #A6CDC6">Price</th>
                                <th style="background-color: #A6CDC6">Quantity</th>
                                <th style="background-color: #A6CDC6">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr style="border-bottom: 2px solid #DDA853;">
                                    <td style="background-color: #A6CDC6" class="text-start">
                                        <strong>{{ $item['name'] }}</strong>
                                    </td>
                                    <td style="background-color: #A6CDC6" class="text-center">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td style="background-color: #A6CDC6" class="text-center">{{ $item['quantity'] }}</td>
                                    <td style="background-color: #A6CDC6" class="text-center">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="col-lg-4">
                <div class="payment-form shadow p-4 rounded" style="background-color: #A6CDC6;">
                    <h4 class="text-center mb-4" style="color: #16404D;">Complete Your Payment</h4>
                    <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Upload Proof of Payment -->
                        <div class="mb-4">
                            <label for="foto_bukti" class="form-label fw-bold" style="color: #16404D;">Upload Payment Proof</label>
                            <input type="file" name="foto_bukti" class="form-control rounded-pill shadow-sm" style="border: 1px solid #16404D;" required>
                        </div>

                        <!-- Total Amount -->
                        <div class="mb-4 text-center">
                            <h5 style="color: #DDA853;">
                                <strong>Total: Rp {{ number_format($totalAmount, 0, ',', '.') }}</strong>
                            </h5>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <!-- Back to Cart -->
                            <a href="{{ route('cart.index') }}" class="btn btn-light rounded-pill shadow-sm px-4" style="background-color: #FBF5DD; color: #16404D; border: 2px solid #16404D;">
                                <i class="fas fa-arrow-left"></i> Back to Cart
                            </a>

                            <!-- Place Order -->
                            <button type="submit" class="btn rounded-pill shadow-sm px-4" style="background-color: #DDA853; color: #FBF5DD; border: 2px solid #16404D;">
                                <i class="fas fa-check-circle"></i> Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <p class="alert alert-warning text-center mt-5" style="background-color: #FBF5DD; color: #FF6347;">
            <i class="fas fa-info-circle"></i> Your cart is empty. Please add some products before checking out.
        </p>
    @endif
</div>

<!-- Custom CSS -->
<style>
    /* General Styling */
    .table th, .table td {
        vertical-align: middle;
        padding: 15px;
    }

    .table th {
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .checkout-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .payment-form label {
        font-size: 1rem;
    }

    .btn {
        font-size: 1rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .checkout-container {
            padding: 15px;
        }
    }
</style>

<!-- Interaction Script -->

</script>
@endsection
