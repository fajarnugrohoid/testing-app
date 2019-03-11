<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRefBiodataAddJk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_biodata', function (Blueprint $table) {
            $table->string('jk', 1)->after('tgl_lahir')->default('L');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_biodata', function (Blueprint $table) {
            $table->dropColumn('jk');
        });
    }
}
