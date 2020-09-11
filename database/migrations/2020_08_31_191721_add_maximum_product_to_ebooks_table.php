<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaximumProductToEbooksTable extends Migration
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
            $table->integer('maximum_product')->default("0")->after("minimum_product");
            $table->boolean('register_promotion')->default("0")->after("maximum_product");
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
            $table->dropColumn('maximum_product');
            $table->dropColumn('register_promotion');
        });
    }
}
