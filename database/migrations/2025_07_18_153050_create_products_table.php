<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->decimal('starting_price', 10, 2);
        $table->timestamp('start_time');
        $table->timestamp('end_time');
        $table->string('image')->nullable();
        $table->string('stream_url')->nullable();
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('products');
    }
}