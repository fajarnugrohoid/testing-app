<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSysUserAddCabangDinas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_users', function (Blueprint $table) {
            $table->integer('cabang_dinas_id')->after('nama')->unsigned()->nullable();

            $table->foreign('cabang_dinas_id')->references('id')->on('ref_cadisdik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_users', function (Blueprint $table) {
            $table->dropForeign(['cabang_dinas_id']);
            $table->dropColumn('cabang_dinas_id');
        });
    }
}
