<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToEmployeeRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employeers', function (Blueprint $table) {
            //
            $table->text('bank_account_name')->nullable()->after('no_rec');
            $table->text('bank_account_number')->nullable()->after('no_rec');
            $table->text('bank_name')->nullable()->after('bank_account_number');
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
            //
            $table->dropColumn('bank_account_name');
            $table->dropColumn('bank_account_number');
            $table->dropColumn('bank_name');
        });
    }
}
