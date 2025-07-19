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

    <hr>

    <!-- Bid Form -->
    <h3>Place a Bid</h3>
    <form action="{{ route('bids.store', $product) }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="number" name="amount" step="0.01" min="0" class="form-control" placeholder="Enter your bid" required>
            @error('amount') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-success">Place Bid</button>
    </form>

    <hr>

    <!-- Live Bids Section -->
    <!-- <h3>Live Bids</h3>
    <ul id="bids-list" class="list-group">
        @foreach($product->bids()->orderByDesc('created_at')->get() as $bid)
            <li class="list-group-item">
                <strong>{{ $bid->user->name ?? 'User' }}</strong> bid ${{ $bid->amount }} at {{ $bid->created_at->format('H:i:s d-m-Y') }}
            </li>
        @endforeach
    </ul> -->
<hr>
<h3>Live Chat</h3>
<div id="chat-messages" style="max-height:200px;overflow-y:auto;">
    @foreach($product->messages()->orderBy('created_at')->get() as $msg)
        <div>
            <strong>{{ $msg->user->name ?? 'User' }}:</strong> {{ $msg->message }}
            <span class="text-muted" style="font-size:0.8em;">{{ $msg->created_at->format('H:i') }}</span>
        </div>
    @endforeach
</div>
<form action="{{ route('messages.store', $product) }}" method="POST" id="chat-form">
    @csrf
    <div class="input-group mt-2">
        <input type="text" name="message" class="form-control" placeholder="Type a message..." required>
        <button class="btn btn-primary" type="submit">Send</button>
    </div>
</form>
    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back</a>
    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning mt-3">Edit</a>
</div>
@endsection
<div>
    <strong>Auction ends in:</strong>
    <span id="countdown"></span>
</div>
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("{{ $product->end_time }}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "Auction ended";
        } else {
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("countdown").innerHTML = hours + "h "
                + minutes + "m " + seconds + "s ";
        }
    }, 1000);
</script>
@section('scripts')
<script>
    window.Echo.channel('product.{{ $product->id }}')
        .listen('NewBidPlaced', (e) => {
            location.reload();
        });
</script>
@endsection


@section('scripts')
<script>
    window.Echo.channel('product-chat.{{ $product->id }}')
        .listen('NewMessageSent', (e) => {
            // Reload chat messages (simple way)
            location.reload();
        });
</script>
@endsection