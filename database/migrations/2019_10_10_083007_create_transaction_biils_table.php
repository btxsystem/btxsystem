<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionBiilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_biils', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('product_type', 50)->nullable();
            $table->string('user_type', 100)->nullable();
            $table->string('customer_number', 30)->nullable();
            $table->string('request_id', 30)->nullable();
            $table->string('inqury_status', 2)->nullable();
            $table->text('inqury_reason')->nullable();
            $table->string('customer_name', 30)->nullable();
            $table->string('currency_code', 3)->nullable()->default('IDR');
            $table->string('total_amount', 15)->nullable();
            $table->string('paid_amount', 15)->nullable();
            $table->text('free_texts')->nullable();
            $table->string('referrence', 15)->nullable();
            $table->string('flag_advide', 1)->nullable();
            $table->string('transaction_date', 19)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_biils');
    }
}
