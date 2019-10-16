<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnInquryToTransactionBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_bills', function (Blueprint $table) {
            //
            $table->renameColumn('inqury_status', 'inquiry_status');
            $table->renameColumn('inqury_reason', 'inquiry_reason');
            $table->renameColumn('flag_advide', 'flag_advice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_bills', function (Blueprint $table) {
            //
            
        });
    }
}
