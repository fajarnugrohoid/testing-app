<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStepConditionsTableAddExplanationStepcondition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('step_conditions', function (Blueprint $table) {
            $table->text('explanation')->after('expected_result');
            $table->integer('step_condition')->after('explanation');
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
        Schema::table('step_conditions', function (Blueprint $table) {
            $table->dropColumn('explanation');
            $table->dropColumn('step_condition');
        });
    }
}
