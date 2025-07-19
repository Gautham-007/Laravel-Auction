<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BidController extends Controller
{
    public function store(Request $request, $productId)
{
    $request->validate([
        'amount' => 'required|numeric|min:0.01',
    ]);

    $product = Product::findOrFail($productId);

    // Optionally: Check if bid is higher than last bid
    $lastBid = $product->bids()->orderByDesc('amount')->first();
    if ($lastBid && $request->amount <= $lastBid->amount) {
        return back()->withErrors(['amount' => 'Bid must be higher than the last bid.']);
    }

    $bid = $product->bids()->create([
        'user_id' => auth()->id(),
        'amount' => $request->amount,
    ]);

    broadcast(new \App\Events\NewBidPlaced($bid))->toOthers();

    return back()->with('success', 'Bid placed!');
}
}
