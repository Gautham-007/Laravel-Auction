<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'starting_price', 'start_time', 'end_time', 'image', 'stream_url'
    ];

    public function bids()
    {
        return $this->hasMany(\App\Models\Bid::class);
    }

    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class);
    }
}