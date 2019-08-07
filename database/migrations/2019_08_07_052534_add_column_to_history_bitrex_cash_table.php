<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToHistoryBitrexCashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history_bitrex_cash', function (Blueprint $table) {
            $table->boolean('info')->comment('0 : spending , 1 : income ');
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
            $table->dropColumn('info');
        });
    }
}
