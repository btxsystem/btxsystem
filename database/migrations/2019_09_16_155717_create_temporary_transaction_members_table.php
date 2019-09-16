<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporaryTransactionMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_transaction_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ebook_id')->nullable()->default(null);
            $table->bigInteger('member_id')->unsigned();
            $table->string('transaction_ref')->nullable();
            $table->foreign('member_id')->references('id')->on('temporary_register_members')->onDelete('cascade');
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
        Schema::dropIfExists('temporary_transaction_members');
    }
}
