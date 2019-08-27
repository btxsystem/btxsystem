<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToTransactionMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_member', function (Blueprint $table) {
            $table->boolean('status')->command('0: panding, 1: paid');
            $table->date('expired_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_member', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('expired_at');
        });
    }
}
