<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBvToTransactionMemberPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_member_promotions', function (Blueprint $table) {
            //
            $table->decimal('bv', 15, 0)->change();
            $table->bigInteger('price_discount')->after('discount')->default("0");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_member_promotions', function (Blueprint $table) {
            //
            $table->dropColumn('price_discount');
        });
    }
}
