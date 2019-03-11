<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefKota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_kota', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cadisdik_id')->unsigned();
            $table->string('nama')->nullable();
            
            $table->nullableTimestamps();

            $table->foreign('cadisdik_id')->references('id')->on('ref_cadisdik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ref_kota');
    }
}
