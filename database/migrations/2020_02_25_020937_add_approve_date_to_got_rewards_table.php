<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApproveDateToGotRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('got_rewards', function (Blueprint $table) {
            //
            $table->dateTime('approve_date')->nullable()->after('reward_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('got_rewards', function (Blueprint $table) {
            //
            $table->dropColumn('approve_date')->nullable();
        });
    }
}
