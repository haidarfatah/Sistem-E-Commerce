@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <h1>Categories</h1>
    <ul class="list-group">
        @foreach($categories as $category)
            <li class="list-group-item">{{ $category->category_name }}</li>
        @endforeach
    </ul>
@endsection
