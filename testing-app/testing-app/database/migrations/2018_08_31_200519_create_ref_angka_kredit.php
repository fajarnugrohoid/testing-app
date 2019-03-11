<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefAngkaKredit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_angka_kredit', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('kategori_id')->unsigned();
            $table->string('kode', 10);
            $table->string('nama');
            $table->string('nilai', 10);
            
            $table->nullableTimestamps();

            $table->foreign('kategori_id')->references('id')->on('ref_kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ref_angka_kredit');
    }
}
