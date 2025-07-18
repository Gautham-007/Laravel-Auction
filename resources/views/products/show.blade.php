@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->title }}</h1>
    <div class="mb-3">
        <strong>Description:</strong>
        <p>{{ $product->description }}</p>
    </div>
    <div class="mb-3">
        <strong>Starting Price:</strong> ${{ $product->starting_price }}
    </div>
    <div class="mb-3">
        <strong>Start Time:</strong> {{ $product->start_time }}
    </div>
    <div class="mb-3">
        <strong>End Time:</strong> {{ $product->end_time }}
    </div>
    @if($product->image)
        <div class="mb-3">
            <strong>Image:</strong><br>
            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="200">
        </div>
    @endif
    @if($product->stream_url)
        <div class="mb-3">
            <strong>Live Stream:</strong><br>
            <a href="{{ $product->stream_url }}" target="_blank">{{ $product->stream_url }}</a>
        </div>
    @endif
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
</div>
@endsection