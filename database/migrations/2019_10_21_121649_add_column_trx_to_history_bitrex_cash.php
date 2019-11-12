<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTrxToHistoryBitrexCash extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history_bitrex_cash', function (Blueprint $table) {
            $table->string('transaction_id')->nullable();
            $table->string('reference_id')->nullable();
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
            $table->dropColumn('transaction_id');
            $table->dropColumn('reference_id');
        });
    }
}
