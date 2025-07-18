<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
   public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
public function product()
{
    return $this->belongsTo(\App\Models\Product::class);
}
}
