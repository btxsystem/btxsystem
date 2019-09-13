<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnToEmployeerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employeers', function (Blueprint $table) {
            $table->boolean('status')->comment('0: nonactive, 1: active')->default(1)->change();
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
            $table->boolean('status')->comment('0 -> nonactive, 1 -> active')->change();
        });
    }
}
