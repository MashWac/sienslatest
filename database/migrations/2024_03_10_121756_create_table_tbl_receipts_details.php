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
        Schema::create('tbl_receipts_details', function (Blueprint $table) {
            $table->increments('receipt_details_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('receipt_number');
            $table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists('tbl_receipts_details');
    }
};
