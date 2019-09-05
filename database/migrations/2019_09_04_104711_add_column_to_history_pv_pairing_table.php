<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToHistoryPvPairingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history_pv_pairing', function (Blueprint $table) {
            $table->integer('current_left')->nullable();
            $table->integer('current_midle')->nullable();
            $table->integer('current_right')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_pv_pairing', function (Blueprint $table) {
            $table->dropColumn('current_left');
            $table->dropColumn('current_midle');
            $table->dropColumn('current_right');
        });
    }
}
