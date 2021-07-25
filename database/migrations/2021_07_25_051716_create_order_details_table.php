<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned()->nullable()->default(null);
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade');
            $table->bigInteger('sku_id')->unsigned()->nullable()->default(null);
            $table->foreign('sku_id')->references('id')->on('product_skus')->onUpdate('cascade');
            $table->decimal('price', $precision = 10, $scale = 2);
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
