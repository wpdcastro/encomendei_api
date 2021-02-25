<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_itens', function (Blueprint $table) {
            $table->id();
            $table->integer('sell_id');
            $table->foreign('sell_id')->references('id')->on('sells');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('quantity');
            $table->float('unit_price');
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
        Schema::dropIfExists('sell_itens');
    }
}
