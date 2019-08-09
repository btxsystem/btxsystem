<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('bitrex_cash', 15, 0)->nullable()->comment('just type 2 user');
            $table->decimal('bitrex_points', 15, 0)->nullable('just type 2 user');
            $table->integer('pv')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('bitrex_cash');
            $table->dropColumn('bitrex_points');
            $table->dropColumn('pv');
        });
    }
}
