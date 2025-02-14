@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
<div class="container">
    <h1 class="my-4">Manage Products</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->product_name }}</td>
                <td>
                    <!-- Image with fixed max-width to ensure consistent size -->
                    <img src="{{ asset('storage/' . $product->foto_product) }}" alt="Product Image" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                </td>
                <td>{{ $product->category->category_name ?? 'No Category' }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->product_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.products.delete', $product->product_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
