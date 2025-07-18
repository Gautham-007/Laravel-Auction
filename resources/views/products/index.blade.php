@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Starting Price</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Image</th>
                <th>Stream URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>${{ $product->starting_price }}</td>
                <td>{{ $product->start_time }}</td>
                <td>{{ $product->end_time }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="60">
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if($product->stream_url)
                        <a href="{{ $product->stream_url }}" target="_blank">View Stream</a>
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No products found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection