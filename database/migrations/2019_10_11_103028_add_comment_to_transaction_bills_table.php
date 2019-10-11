<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentToTransactionBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_biils', function (Blueprint $table) {
            $table->string('product_type', 50)->nullable()->comment(
                'ebook = Ebook Member, ebook_nonmember = Ebook Non Member, topup_bitrex_point = Topup Bitrex Point'
            )->change();
            $table->string('user_type', 100)->nullable()->comment('member, nonmember')->change();
            $table->string('inqury_status', 2)->nullable()->comment('00 = Success, 01 = Failed, 02 = Timeout')->change();
            $table->string('transaction_date', 19)->nullable()->comment('Format : d/m/Y H:i:s')->change();
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
