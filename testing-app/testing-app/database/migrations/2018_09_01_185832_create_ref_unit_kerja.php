<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefUnitKerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_unit_kerja', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('kota_id')->unsigned()->nullable();
            $table->string('npsn', 20)->nullable();
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->string('kecamatan', 150)->nullable();
            
            $table->nullableTimestamps();

            $table->foreign('kota_id')->references('id')->on('ref_kota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ref_unit_kerja');
    }
}
