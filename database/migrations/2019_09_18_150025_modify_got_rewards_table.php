<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyGotRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('got_rewards', function (Blueprint $table) {
            $table->integer('status')->default(0)->comment('0: can claim, 1: waiting approve, 2: given')->change();
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
            $table->integer('status')->default(0)->comment('0: can claim 1: claimed')->change();
        });
    }
}
