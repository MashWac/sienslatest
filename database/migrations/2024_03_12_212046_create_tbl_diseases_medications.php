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
        Schema::create('tbl_diseases_medications', function (Blueprint $table) {
            $table->increments('diseasemedication_id');
            $table->integer('disease_id');
            $table->integer('medication_id');
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
        Schema::dropIfExists('tbl_diseases_medications');
    }
};
