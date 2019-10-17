<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPaymentFlagStatusToTransactionBillsTable extends Migration
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
            $table->text('payment_flag_status')->nullable()->after('inquiry_reason');
            $table->text('payment_flag_reason')->nullable()->after('payment_flag_status')->comment('Sample: {"Indonesian" : "Sukses", "English" : "Failed"}');

            $table->text('inquiry_reason')->nullable()->comment('Sample: {"Indonesian" : "Sukses", "English" : "Failed"}')->change();
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
            $table->dropColumn('payment_flag_status');
            $table->dropColumn('payment_flag_reason');
        });
    }
}
