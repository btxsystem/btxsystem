<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUsernameUserTypeToTransferConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transfer_confirmations', function (Blueprint $table) {
            //
            $table->string('username')->nullable();
            $table->string('user_type', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transfer_confirmations', function (Blueprint $table) {
            //
            $table->dropColumn('username');
            $table->dropColumn('user_type');
        });
    }
}
