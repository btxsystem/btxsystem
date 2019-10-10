<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionBiilsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_biils_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaction_bill_id');
            $table->string('bill_amount', 30)->nullable();
            $table->string('bill_number', 30)->nullable();
            $table->string('bill_sub_company', 15)->nullable();
            $table->string('bill_referrence', 15)->nullable();
            $table->timestamps();

            $table->foreign('transaction_bill_id')
                ->references('id')
                ->on('transaction_biils');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_biils_details');
    }
}
