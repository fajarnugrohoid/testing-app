<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTransDupakAddKolom0909 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_dupak', function (Blueprint $table) {
            $table->dateTime('cabdin_at')->nullable();
            $table->dateTime('sekretariat_at')->nullable();
            $table->dateTime('penilai_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_dupak', function (Blueprint $table) {
            $table->dropColumn('cabdin_at');
            $table->dropColumn('sekretariat_at');
            $table->dropColumn('penilai_at');
        });
    }
}
