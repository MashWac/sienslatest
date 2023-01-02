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
        Schema::create('tbl_categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('category_name');
            $table->integer('popularity');
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
    }
};
