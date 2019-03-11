<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefPenolakan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_penolakan', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nomor')->default(0);
            $table->string('sub_nomor', 5);
            $table->string('judul');
            $table->text('alasan');
            $table->text('saran');
            
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ref_penolakan');
    }
}
