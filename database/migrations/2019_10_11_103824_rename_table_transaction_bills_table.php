<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTableTransactionBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_biils_details', function (Blueprint $table) {
            $table->dropForeign(['transaction_bill_id']);
         });
        
         Schema::rename('transaction_biils', 'transaction_bills');
         Schema::rename('transaction_biils_details', 'transaction_bills_details');
         
         Schema::table('transaction_bills_details', function (Blueprint $table) {
            $table->foreign('transaction_bill_id')->references('id')->on('transaction_bills');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
