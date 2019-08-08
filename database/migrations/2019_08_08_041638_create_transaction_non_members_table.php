<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionNonMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_non_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('income', 15, 0);
            $table->bigInteger('member_id')->unsigned();
            $table->bigInteger('non_member_id')->unsigned();
            $table->bigInteger('ebook_id')->unsigned();
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('employeers')->onDelete('cascade');
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
        Schema::dropIfExists('transaction_non_members');
    }
}
