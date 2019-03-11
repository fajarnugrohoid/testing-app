<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefDapodik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_dapodik', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nip', 30)->nullable();
            $table->string('nik', 30)->nullable();
            $table->string('nama')->nullable();
            
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
        Schema::drop('ref_dapodik');
    }
}
