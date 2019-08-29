<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryPvPairing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_pv_pairing', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_member')->unsigned();
            $table->integer('total_pairing');
            $table->integer('fail_pairing')->nullable();
            $table->integer('left')->nullable();
            $table->integer('midle')->nullable();
            $table->integer('right')->nullable();
            $table->timestamps();
            $table->foreign('id_member')->references('id')->on('employeers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_pv_pairing');
    }
}
