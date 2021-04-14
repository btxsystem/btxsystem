<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXenditPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xendit_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('external_id');
            $table->string('xendit_id');
            $table->integer('user_id');
            $table->decimal('nominal', 12, 2);
            $table->decimal('tax', 12, 2)->default(0);
            $table->string('bank');
            $table->integer('status');
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
        Schema::dropIfExists('xendit_payment');
    }
}
