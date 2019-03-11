<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTransDupakDetailUpdateKolom0909 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_dupak_detail', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->change();
            $table->string('tahun', 10)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_dupak_detail', function (Blueprint $table) {
            $table->text('deskripsi')->change();
            $table->string('tahun', 10)->change();
        });
    }
}
