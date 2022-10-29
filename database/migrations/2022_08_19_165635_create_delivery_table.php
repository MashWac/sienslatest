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
        Schema::create('delivery', function (Blueprint $table) {
            $table->increments('delivery_id');
            $table->string('town');
            $table->string('address');
            $table->integer('order_id');
            $table->string('delivery_status');
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
    }
};
