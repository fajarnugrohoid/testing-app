<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTransDupakAddPenilaiId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_dupak', function (Blueprint $table) {
            $table->integer('penilai_id')->nullable()->unsigned()->after('user_id');
            
            $table->foreign('penilai_id')->references('id')->on('sys_users');
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
            $table->dropForeign(['penilai_id']);
            $table->dropColumn('penilai_id');
        });
    }
}
