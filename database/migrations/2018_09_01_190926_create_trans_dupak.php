<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransDupak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_dupak', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->date('tanggal');
            $table->string('pendidikan')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('tahun_lulus', 4)->nullable();
            $table->integer('golongan_sekarang_id')->unsigned()->nullable();
            $table->integer('golongan_target_id')->unsigned()->nullable();
            $table->date('tmt_golongan');
            $table->integer('unit_kerja_id')->unsigned();
            $table->double('total_akhir')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0:proses, 1:verivikasi, 2:diterima, 3:ditolak');

            $table->nullableTimestamps();

            $table->foreign('user_id')->references('id')->on('sys_users');
            $table->foreign('golongan_sekarang_id')->references('id')->on('ref_golongan');
            $table->foreign('golongan_target_id')->references('id')->on('ref_golongan');
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
        Schema::drop('trans_dupak');
    }
}
