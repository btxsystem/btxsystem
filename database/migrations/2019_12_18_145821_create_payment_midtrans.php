<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMidtrans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_midtrans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('donor_username');
            $table->string('donor_email');
            $table->string('donation_type')->comment('topup, register, ebook');
            $table->decimal('amount', 20, 2);
            $table->string('note')->nullable();
            $table->string('status')->default('pending');
            $table->string('snap_token');
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
        Schema::dropIfExists('payment_midtrans');
    }
}
