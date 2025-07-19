<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
   public function store(Request $request, $productId)
{
    $request->validate([
        'message' => 'required|string|max:1000',
    ]);

    $message = \App\Models\Message::create([
        'user_id' => auth()->id(),
        'product_id' => $productId,
        'message' => $request->message,
    ]);

    broadcast(new \App\Events\NewMessageSent($message))->toOthers();

    return back();
}
}
