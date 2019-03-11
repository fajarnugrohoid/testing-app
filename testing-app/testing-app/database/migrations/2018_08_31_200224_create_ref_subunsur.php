<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefSubunsur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_sub_unsur', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('unsur_id')->unsigned();
            $table->string('nama');
            
            $table->nullableTimestamps();

            $table->foreign('unsur_id')->references('id')->on('ref_unsur');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ref_sub_unsur');
    }
}
