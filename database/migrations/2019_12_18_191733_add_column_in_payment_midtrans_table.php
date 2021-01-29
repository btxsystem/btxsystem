<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInPaymentMidtransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_midtrans', function (Blueprint $table) {
            $table->string('type_transfer')->nullable();
            $table->string('va_account')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_midtrans', function (Blueprint $table) {
            $table->dropColumn('type_transfer');
            $table->dropColumn('va_account');
        });
    }
}
