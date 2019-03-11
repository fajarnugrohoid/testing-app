<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTestCasesTableAddExecutionStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('test_cases', function (Blueprint $table) {
            $table->integer('execution_status')->after('pre_condition')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('test_cases', function (Blueprint $table) {
            $table->dropColumn('execution_status');
        });
    }
}
