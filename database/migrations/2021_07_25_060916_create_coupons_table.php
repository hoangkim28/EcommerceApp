<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 20)->unique();
            $table->boolean('type_discount')->default(0);
            $table->decimal('max_discount', $precision = 10, $scale = 2);
            $table->decimal('min_discount', $precision = 10, $scale = 2);
            $table->integer('min_quantity')->nullable();
            $table->boolean('taget')->default(0);
            $table->string('list', 100)->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
