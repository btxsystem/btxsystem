<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPriceDiscountToEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ebooks', function (Blueprint $table) {
            //
            $table->double('price_discount')->default("0")->after("price");
            $table->integer('minimum_product')->default("0")->after("price_discount");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ebooks', function (Blueprint $table) {
            //
            $table->dropColumn('price_discount');
            $table->dropColumn('minimum_product');
        });
    }
}
