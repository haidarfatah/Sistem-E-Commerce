@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center mb-4 alert-success-custom">
            {{ session('success') }}
        </div>
    @endif

    <div class="container position-relative">
        <h2 class="text-center mb-4 section-title">
            Explore Our Latest Products
        </h2>

        <!-- Tombol Add Selected to Cart -->
        <div class="position-absolute top-0 end-0 mt-3 me-3">
            <button type="submit" form="addToCartForm" class="btn btn-sm btn-add-to-cart shadow">
                <i class="fas fa-shopping-cart me-1"></i> Add Selected to Cart
            </button>
        </div>

        <form id="addToCartForm" action="{{ route('cart.addMultiple') }}" method="POST">
            @csrf
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm product-card">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $product->foto_product) }}" 
                                     class="card-img-top product-img" 
                                     alt="{{ $product->product_name }}">
                            </div>
                            <div class="card-body d-flex flex-column p-3">
                                <h5 class="card-title mb-2 product-name">
                                    {{ $product->product_name }}
                                </h5>
                                <p class="card-text text-muted text-center product-description">
                                    {{ \Str::limit($product->description, 50) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="products[]" 
                                                   value="{{ $product->product_id }}" id="product-{{ $product->product_id }}">
                                            <label class="form-check-label" for="product-{{ $product->product_id }}">
                                                Select
                                            </label>
                                        </div>
                                    </div>
                                    <a href="{{ route('products.index', $product->product_id) }}" 
                                       class="btn btn-sm btn-details">
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>

    <style>
       

      
    </style>

    <script>
        // Add hover effects to buttons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('mouseenter', () => {
                button.style.boxShadow = '0 6px 15px rgba(0,0,0,0.2)';
            });

            button.addEventListener('mouseleave', () => {
                button.style.boxShadow = 'none';
            });
        });
    </script>
@endsection


