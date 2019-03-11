<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRefDupak0209 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_dapodik', function (Blueprint $table) {
            $table->string('jk', 1)->after('nama')->default('L')->nullable();
            $table->string('tempat', 50)->after('jk')->nullable();
            $table->date('tanggal')->after('tempat')->nullable();
            $table->string('npsn', 20)->after('tanggal')->nullable();
            $table->string('sekolah', 150)->after('npsn')->nullable();
            $table->text('alamat')->after('sekolah')->nullable();
            $table->string('kec', 100)->after('alamat')->nullable();
            $table->string('daerah', 100)->after('kec')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_dapodik', function (Blueprint $table) {
            $table->dropColumn('jk');
            $table->dropColumn('tempat');
            $table->dropColumn('tanggal');
            $table->dropColumn('npsn');
            $table->dropColumn('sekolah');
            $table->dropColumn('alamat');
            $table->dropColumn('kec');
            $table->dropColumn('daerah');
        });
    }
}
