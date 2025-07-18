@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}" required>
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="starting_price" class="form-label">Starting Price</label>
            <input type="number" step="0.01" name="starting_price" class="form-control" value="{{ old('starting_price', $product->starting_price) }}" required>
            @error('starting_price') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{ old('start_time', \Carbon\Carbon::parse($product->start_time)->format('Y-m-d\TH:i')) }}" required>
            @error('start_time') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{ old('end_time', \Carbon\Carbon::parse($product->end_time)->format('Y-m-d\TH:i')) }}" required>
            @error('end_time') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            @if($product->image)
                <div>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="120">
                </div>
            @endif
            <input type="file" name="image" class="form-control">
            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="stream_url" class="form-label">Live Stream URL (optional)</label>
            <input type="url" name="stream_url" class="form-control" value="{{ old('stream_url', $product->stream_url) }}">
            @error('stream_url') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection