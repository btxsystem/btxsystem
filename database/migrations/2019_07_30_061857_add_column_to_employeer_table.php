<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToEmployeerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employeers', function (Blueprint $table) {
            $table->decimal('bitrex_cash', 15, 0);
            $table->decimal('bitrex_points', 15, 0);
            $table->integer('pv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employeers', function (Blueprint $table) {
            $table->dropColumn('bitrex_cash');
            $table->dropColumn('bitrex_points');
            $table->dropColumn('pv');
        });
    }
}
