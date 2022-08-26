<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->increments('orderdetails_id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('product_price');
            $table->integer('order_quantity');
            $table->string('order_subtotal');
            $table->timestamp('created_at');
            $table->dateTime('updated_at');
            $table->integer('is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderdetails');
    }
};
