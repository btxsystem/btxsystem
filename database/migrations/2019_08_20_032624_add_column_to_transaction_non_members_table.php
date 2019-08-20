<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToTransactionNonMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_non_members', function (Blueprint $table) {
            $table->boolean('status')->nullable()->comment('0: Pending, 1: Paid');
            $table->bigInteger('expired_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_non_members', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('expired_at');
        });
    }
}
