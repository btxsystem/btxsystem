<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryBitrexPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_bitrex_point', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_member')->unsigned();
            $table->decimal('nominal', 15, 0);
            $table->decimal('points', 15, 0);
            $table->text('description');
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
        Schema::dropIfExists('history_bitrex_point');
    }
}
