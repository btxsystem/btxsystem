<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGotRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('got_rewards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id')->unsigned();
            $table->bigInteger('reward_id')->unsigned();
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('employeers')->onDelete('cascade');
            $table->foreign('reward_id')->references('id')->on('gift_rewards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('got_rewards');
    }
}
