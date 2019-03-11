<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransDupakDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_dupak_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('dupak_id')->unsigned();
            $table->integer('angka_kredit_id')->unsigned();
            $table->double('nilai_angka_kredit')->default(0);
            $table->text('deskripsi');
            $table->string('tahun', 10);
            $table->tinyInteger('status')->default(0)->comment('0:proses, 1:diterima, 2:ditolak');

            $table->nullableTimestamps();

            $table->foreign('dupak_id')->references('id')->on('trans_dupak');
            $table->foreign('angka_kredit_id')->references('id')->on('ref_angka_kredit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trans_dupak_detail');
    }
}
