<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProductDetailToTransactionBillsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_biils_details', function (Blueprint $table) {
            //
            $table->text('product_detail')->nullable()->after('bill_referrence');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_biils_details', function (Blueprint $table) {
            //
            $table->dropColumn('product_detail');
        });
    }
}
