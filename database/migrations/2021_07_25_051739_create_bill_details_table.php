<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bill_id')->unsigned()->nullable()->default(null);
            $table->foreign('bill_id')->references('id')->on('bills')->onUpdate('cascade');
            $table->string('product_name', 120)->nullable();
            $table->string('product_sku', 120)->nullable();
            $table->string('size', 20)->nullable();
            $table->string('color', 20)->nullable();
            $table->decimal('price', $precision = 10, $scale = 2);
            $table->integer('quantity');
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
        Schema::dropIfExists('bill_details');
    }
}
