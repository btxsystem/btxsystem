<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentHistoriesNonMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories_non_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ebook_id')->unsigned();
            $table->bigInteger('non_member_id')->unsigned();
            $table->string('ref_no')->nullable();
            $table->integer('payment_id')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('trans_id')->nullable();
            $table->string('remark')->nullable();
            $table->string('auth_code')->nullable();
            $table->text('err_desc')->nullable();
            $table->integer('status')->nullable()->comment('1 = Success, 0 = Fail, 6 = Waiting to Payment');
            $table->timestamps();

            $table->foreign('ebook_id')->references('id')->on('ebooks')->onDelete('cascade');   
            $table->foreign('non_member_id')->references('id')->on('non_members')->onDelete('cascade');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_histories_non_members');
    }
}
