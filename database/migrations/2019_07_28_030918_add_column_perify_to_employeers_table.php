<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPerifyToEmployeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employeers', function (Blueprint $table) {
            $table->boolean('verification')->default(0)->comment('0: not verification 1: verification');
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
            $table->dropColumn('verification');
        });
    }
}
