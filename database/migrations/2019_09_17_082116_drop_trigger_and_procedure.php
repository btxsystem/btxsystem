<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTriggerAndProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // DB::unprepared('DROP TRIGGER IF EXISTS `tr_bonus_sponsor_from_member`');
       // DB::unprepared('DROP TRIGGER `tr_bonus_pairing`');
       // DB::unprepared('DROP TRIGGER `tr_add_pv_reward`');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
