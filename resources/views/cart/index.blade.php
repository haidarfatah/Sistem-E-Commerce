@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
<div class="cart-container" style="background-color: #FBF5DD; padding: 20px; border-radius: 10px;">
    <h1 class="text-center mb-4" style="color: #16404D;">Your Cart</h1>

    @php
        $cart = session()->get('cart', []);
    @endphp

    @if (!empty($cart) && count($cart) > 0)
        <div class="cart-table">
            <!-- Header Row -->
            <div class="row cart-grid-header d-none d-md-flex fw-bold text-center mb-3" style="color: #16404D;">
                <div class="col-md-4">Product</div>
                <div class="col-md-2">Price</div>
                <div class="col-md-2">Quantity</div>
                <div class="col-md-2">Total</div>
                <div class="col-md-2">Action</div>
            </div>

            <!-- Cart Items -->
            @foreach ($cart as $productId => $item)
                @if (isset($item['product_id']))
                <div class="row cart-grid-item align-items-center text-center mb-3 p-3 shadow-sm rounded" 
                style="background-color: #A6CDC6;" 
                data-product-id="{{ $productId }}">
           
                        <!-- Product -->
                        <div class="col-12 col-md-4 d-flex align-items-center text-start mb-3 mb-md-0">
                            <img src="{{ asset('storage/' . ($item['foto_product'] ?? 'default.jpg')) }}" 
                                alt="{{ $item['name'] }}" 
                                class="product-image me-3 rounded-circle border" 
                                style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #16404D;">
                            <span class="product-name fw-bold" style="color: #16404D;">{{ $item['name'] }}</span>
                        </div>

                        <!-- Price -->
                        <div class="col-6 col-md-2 text-center">
                            <span class="badge" style="background-color: #DDA853; color: #FBF5DD; padding: 10px;">
                                Rp {{ number_format($item['price'], 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Quantity -->
                        <div class="col-6 col-md-2">
                            <div class="quantity-wrapper d-flex justify-content-center align-items-center">
                                <button class="btn btn-sm quantity-decrement" style="background-color: #16404D; color: #FBF5DD;" data-product-id="{{ $productId }}">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                    max="{{ $item['stock'] ?? 1 }}" 
                                    class="form-control quantity-input text-center mx-2 rounded-pill" 
                                    data-product-id="{{ $productId }}" 
                                    style="border: 1px solid #16404D; width: 60px;">
                                <button class="btn btn-sm quantity-increment" style="background-color: #16404D; color: #FBF5DD;" data-product-id="{{ $productId }}">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="col-6 col-md-2 text-center mt-3 mt-md-0">
                            <strong style="color: #16404D;">Rp <span class="total-price" data-product-id="{{ $productId }}">
                                {{ number_format($item['quantity'] * $item['price'], 0, ',', '.') }}
                            </span></strong>
                        </div>

                        <!-- Action -->
                        <div class="col-6 col-md-2 text-center mt-3 mt-md-0">
                            <a href="javascript:void(0);" 
                            class="btn btn-sm w-100 btn-remove-ajax" 
                            style="background-color: #DDA853; color: #FBF5DD;" 
                            data-product-id="{{ $productId }}"
                            data-bs-toggle="modal" 
                            data-bs-target="#removeModal">
                            <i class="fas fa-trash-alt"></i> Remove
                         </a>
                         
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger text-center">Product data is missing. Please try again.</div>
                @endif
            @endforeach
        </div>

        <!-- Subtotal -->
        <div class="cart-summary mt-4 text-end">
            <h4 style="color: #16404D;">
                <strong>Subtotal:</strong> 
                <span class="cart-subtotal" style="color: #DDA853;">
                    Rp {{ number_format(array_sum(array_map(function ($item) { 
                        return $item['quantity'] * $item['price']; 
                    }, $cart)), 0, ',', '.') }}
                </span>
            </h4>
        </div>

        <!-- Actions -->
        <div class="cart-actions mt-4">
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
                <!-- Back to Shop Button (Kiri) -->
                <a href="{{ route('home') }}" class="btn btn-sm shadow-sm mb-2 mb-md-0" 
                    style="background-color: #A6CDC6; color: #16404D; border: 2px solid #16404D;">
                    <i class="fas fa-shopping-bag"></i> Back to Shop
                </a>
                
                <!-- Proceed to Checkout Button (Kanan) -->
                <a href="{{ route('checkout.index') }}" class="btn btn-sm shadow-sm" 
                    style="background-color: #DDA853; color: #FBF5DD; border: 2px solid #16404D;">
                    <i class="fas fa-credit-card"></i> Proceed to Checkout
                </a>
            </div>
        </div>
        
    @else
        <p class="alert alert-warning text-center mt-4" style="background-color: #FBF5DD; color: #16404D;">
            <i class="fas fa-info-circle"></i> Your cart is empty. Please add some products to your cart.
        </p>
    @endif
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #FBF5DD; border: 2px solid #16404D; border-radius: 10px;">
            <div class="modal-header" style="background-color: #A6CDC6; color: #16404D; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <h5 class="modal-title fw-bold" id="removeModalLabel">
                    <i class="fas fa-exclamation-triangle me-2" style="color: #DDA853;"></i> Confirm Removal
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" 
                        style="background-color: #DDA853; color: #FBF5DD; border-radius: 50%;"></button>
            </div>
            <div class="modal-body text-center" style="color: #16404D;">
                <p class="fs-5">
                    Are you sure you want to remove this product from your cart?
                </p>
                <i class="fas fa-shopping-cart fa-3x" style="color: #A6CDC6;"></i>
            </div>
            <div class="modal-footer" style="background-color: #FBF5DD;">
                <button type="button" class="btn" data-bs-dismiss="modal" 
                        style="background-color: #A6CDC6; color: #16404D; border: 2px solid #16404D; border-radius: 8px;">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" id="confirmRemoveButton" class="btn" 
                        style="background-color: #DDA853; color: #FBF5DD; border: 2px solid #16404D; border-radius: 8px;">
                    <i class="fas fa-trash-alt"></i> Remove
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateCart = async (productId, quantityInput) => {
            const quantity = parseInt(quantityInput.value);
            const button = document.querySelector(`button[data-product-id="${productId}"]`);

            if (quantity < 1) {
                alert('Quantity cannot be less than 1.');
                quantityInput.value = 1;
                return;
            }

            button.disabled = true; // Disable button
            try {
                const response = await fetch(`/cart/update-ajax/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ quantity })
                });
                const data = await response.json();
                if (data.success) {
                    document.querySelector(`.total-price[data-product-id="${productId}"]`).textContent = 'Rp ' + data.total_price;
                    document.querySelector('.cart-subtotal').textContent = 'Rp ' + data.cart_subtotal;
                } else {
                    alert(data.error || 'Failed to update quantity.');
                }
            } catch (error) {
                alert('An error occurred. Please try again.');
            } finally {
                button.disabled = false; // Re-enable button
            }
        };

        document.querySelectorAll('.quantity-decrement, .quantity-increment').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.productId;
                const quantityInput = document.querySelector(`.quantity-input[data-product-id="${productId}"]`);
                const increment = this.classList.contains('quantity-increment');
                const newValue = increment ? parseInt(quantityInput.value) + 1 : parseInt(quantityInput.value) - 1;
                if (newValue >= 1) {
                    quantityInput.value = newValue;
                    updateCart(productId, quantityInput);
                }
            });
        });

        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('input', function () {
                const productId = this.dataset.productId;
                updateCart(productId, this);
            });
        });
    });


    // remove 
    document.addEventListener('DOMContentLoaded', function () {
    let productIdToRemove = null;

    document.querySelectorAll('.btn-remove-ajax').forEach(button => {
        button.addEventListener('click', function () {
            productIdToRemove = this.dataset.productId;
        });
    });

    document.getElementById('confirmRemoveButton').addEventListener('click', function () {
        if (productIdToRemove) {
            fetch(`/cart/remove/${productIdToRemove}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector(`.cart-grid-item[data-product-id="${productIdToRemove}"]`).remove();
                    const modal = bootstrap.Modal.getInstance(document.getElementById('removeModal'));
                    modal.hide();
                }
            });
        }
    });
});

</script>
@endsection
