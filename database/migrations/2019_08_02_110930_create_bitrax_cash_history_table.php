<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitraxCashHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitrax_cash_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_member')->unsigned();
            $table->decimal('nominal', 15, 0);
            $table->text('description');
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
        Schema::dropIfExists('bitrax_cash_history');
    }
}
