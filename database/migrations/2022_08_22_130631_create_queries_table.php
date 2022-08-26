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
        Schema::create('tbl_queries', function (Blueprint $table) {
            $table->increments('query_id');
            $table->integer('user_id');
            $table->text('question');
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
        Schema::dropIfExists('tbl_queries');
    }
};
