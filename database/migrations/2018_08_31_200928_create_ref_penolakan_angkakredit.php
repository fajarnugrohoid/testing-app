<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefPenolakanAngkakredit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_penolakan_angkakredit', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('angka_kredit_id')->unsigned();
            $table->integer('penolakan_id')->unsigned();
            
            $table->nullableTimestamps();

            $table->foreign('angka_kredit_id')->references('id')->on('ref_angka_kredit');
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
        Schema::drop('ref_penolakan_angkakredit');
    }
}
