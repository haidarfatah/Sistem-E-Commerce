@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5 ">
    <h1 class="text-center mb-4" style="color: #16404D; ">Admin Dashboard</h1>

    <div class="row g-3">
        <!-- Users Count Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-lg h-100 hover-effect" style="background: radial-gradient(circle, #A6CDC6,#16404D); border-radius: 10px; padding: 15px;">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-users fa-2x icon-color"></i>
                    </div>
                    <h6 class="card-title" style="color: #16404D; font-weight: bold; font-size: 1rem;">Total Users</h6>
                    <p class="card-text fs-6" style="color: #16404D; font-size: 1.2rem;">{{ $usersCount }}</p>
                    <a href="{{ route('admin.users') }}" class="btn btn-custom btn-sm">
                        Manage Users
                    </a>
                </div>
            </div>
        </div>

        <!-- Products Count Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-lg h-100 hover-effect" style="background: radial-gradient(circle, #A6CDC6,#16404D); border-radius: 10px; padding: 15px;">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-box fa-2x icon-color"></i>
                    </div>
                    <h6 class="card-title" style="color: #16404D; font-weight: bold; font-size: 1rem;">Total Products</h6>
                    <p class="card-text fs-6" style="color: #16404D; font-size: 1.2rem;">{{ $productCount }}</p>
                    <a href="{{ route('admin.products') }}" class="btn btn-custom btn-sm">
                        Manage Products
                    </a>
                </div>
            </div>
        </div>

        <!-- Categories Count Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-lg h-100 hover-effect" style="background: radial-gradient(circle, #A6CDC6,#16404D); border-radius: 10px; padding: 15px;">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-tags fa-2x icon-color"></i>
                    </div>
                    <h6 class="card-title" style="color: #16404D; font-weight: bold; font-size: 1rem;">Total Categories</h6>
                    <p class="card-text fs-6" style="color: #16404D; font-size: 1.2rem;">{{ $categoryCount }}</p>
                    <a href="{{ route('admin.categories') }}" class="btn btn-custom btn-sm">
                        Manage Categories
                    </a>
                </div>
            </div>
        </div>

        <!-- Orders Count Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-lg h-100 hover-effect" style="background: radial-gradient(circle, #A6CDC6,#16404D); border-radius: 10px; padding: 15px;">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-shopping-cart fa-2x icon-color"></i>
                    </div>
                    <h6 class="card-title" style="color: #16404D; font-weight: bold; font-size: 1rem;">Total Orders</h6>
                    <p class="card-text fs-6" style="color: #16404D; font-size: 1.2rem;">{{ $orderCount }}</p>
                    <a href="{{ route('orders.index') }}" class="btn btn-custom btn-sm">
                        Manage Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
