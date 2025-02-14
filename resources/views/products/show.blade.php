@extends('layouts.app')

@section('title', $product->product_name)

@section('content')
    <div class="container mt-5">
        <div class="row g-4">
            <!-- Product Image -->
            <div class="col-12 col-md-6 mb-4 mb-md-0">
                <div class="card border-0 rounded-3 product-card">
                    <img src="{{ asset('storage/' . $product->foto_product) }}" 
                         class="img-fluid rounded mx-auto d-block product-image" 
                         alt="{{ $product->product_name }}">
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-12 col-md-6">
                <div class="card-body">
                    <!-- Product Title -->
                    <h1 class="product-title text-center text-md-start">
                        {{ $product->product_name }}
                    </h1>
                    
                    <!-- Product Description -->
                    <p class="product-description text-dark">
                        {{ $product->description }}
                    </p>

                    <!-- Price and Stock -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mt-4">
                        <div class="mb-3 mb-md-0">
                            <strong class="text-dark">Price:</strong> 
                            <span class="text-success product-price">
                                Rp{{ number_format($product->price, 2) }}
                            </span>
                        </div>
                        <div>
                            <strong class="text-dark">Stock:</strong> 
                            <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }} text-white">
                                {{ $product->stock > 0 ? $product->stock . ' Available' : 'Out of Stock' }}
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4 d-grid gap-3">
                        @if($product->stock > 0)
                            <a href="{{ route('cart.add', $product->product_id) }}" 
                               class="btn btn-warning btn-lg btn-add-to-cart">
                                Add to Cart
                            </a>
                        @else
                            <button class="btn btn-secondary btn-lg" disabled>
                                Out of Stock
                            </button>
                        @endif
                        <a href="{{ route('home') }}" 
                           class="btn btn-outline-dark btn-lg btn-back-home">
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Styling Product Title */
        .product-title {
            color: #16404D;
            font-weight: bold;
            font-size: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        /* Product Description */
        .product-description {
            font-size: 1rem;
            color: #000000;
            margin-top: 1rem;
        }

        /* Price Styling */
        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Image Styling */
        .product-image {
            object-fit: cover;
            height: 100%;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        /* Hover effect on image */
        .product-image:hover {
            transform: scale(1.05);
        }

        /* Action Buttons Styling */
        .btn-add-to-cart {
            background-color: #DDA853;
            color: #FBF5DD;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-add-to-cart:hover {
            background-color: #16404D;
            color: #FBF5DD;
            transform: scale(1.05);
        }

        .btn-back-home {
            background-color: transparent;
            color: #16404D;
            border: 2px solid #16404D;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-back-home:hover {
            background-color: #16404D;
            color: #FBF5DD;
            transform: scale(1.05);
        }

        /* Responsif Styling */
        @media (max-width: 767px) {
            .product-title {
                font-size: 1.5rem;
                text-align: center;
            }

            .product-description {
                font-size: 0.9rem;
                text-align: justify;
            }

            .d-flex {
                flex-direction: column;
            }

            .product-image {
                height: 250px;
            }

            .card-body {
                padding: 1.5rem;
            }

            .btn-add-to-cart, .btn-back-home {
                font-size: 1rem;
                padding: 12px;
            }
        }

        /* Desktop Adjustments */
        @media (min-width: 768px) {
            .product-image {
                height: 350px;
            }

            .card-body {
                padding: 2rem;
            }
        }
    </style>
@endsection
