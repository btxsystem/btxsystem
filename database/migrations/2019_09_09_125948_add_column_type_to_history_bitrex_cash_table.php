<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTypeToHistoryBitrexCashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history_bitrex_cash', function (Blueprint $table) {
            $table->integer('type')->nullable()->comment('0: Sponsor 1: Pairing 2: Profit 3: Reward');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_bitrex_cash', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
