<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransDupakDetailTolak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_dupak_detail_tolak', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('dupak_detail_id')->unsigned()->nullable();
            $table->integer('penolakan_id')->unsigned()->nullable();
            
            $table->nullableTimestamps();

            $table->foreign('dupak_detail_id')->references('id')->on('trans_dupak_detail');
            $table->foreign('penolakan_id')->references('id')->on('ref_penolakan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trans_dupak_detail_tolak');
    }
}
