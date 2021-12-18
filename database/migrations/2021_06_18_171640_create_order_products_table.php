<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products', 'id');
            $table->unsignedSmallInteger('quantity');
            $table->double('price');
            $table->string('color')->nullable();
            $table->enum('size', ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
