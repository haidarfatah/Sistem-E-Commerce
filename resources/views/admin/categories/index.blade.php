@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
<div class="container">
    <h1 class="my-4">Manage Categories</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->description }}</td>
                <td>{{ \Carbon\Carbon::parse($category->created_at)->format('d M Y') }}</td> <!-- Menggunakan Carbon untuk format tanggal -->
                <td>
                    <a href="{{ route('admin.categories.edit', $category->category_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.categories.delete', $category->category_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
