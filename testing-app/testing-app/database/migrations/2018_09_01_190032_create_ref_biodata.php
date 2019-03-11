<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefBiodata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_biodata', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nip', 30);
            $table->string('nik', 30);
            $table->string('nama', 100);
            $table->string('tmp_lahir', 100)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('tahun_pendidikan', 10)->nullable();
            $table->integer('golongan_id')->unsigned()->nullable();
            $table->date('tmt_golongan')->nullable();
            $table->integer('unit_kerja_id')->unsigned()->nullable();

            $table->nullableTimestamps();

            $table->foreign('golongan_id')->references('id')->on('ref_golongan');
            $table->foreign('unit_kerja_id')->references('id')->on('ref_unit_kerja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ref_biodata');
    }
}
