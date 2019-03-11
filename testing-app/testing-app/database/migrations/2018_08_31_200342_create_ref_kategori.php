<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_kategori', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sub_unsur_id')->unsigned();
            $table->string('nama');
            
            $table->nullableTimestamps();

            $table->foreign('sub_unsur_id')->references('id')->on('ref_sub_unsur');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ref_kategori');
    }
}
