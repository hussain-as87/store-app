<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorSizeToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('color', [
                'red',
                'yellow',
                'blue',
                'white',
                'grey',
                'green',
                'black'
            ])->nullable()->after('price');

            $table->text('size', [
                'S',
                'M',
                'L',
                'XL',
                'XXL',
                'XXXL'
            ])->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['color', 'size']);
        });
    }
}
