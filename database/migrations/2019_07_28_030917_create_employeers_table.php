<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_member')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('password');
            $table->date('birthdate');
            $table->string('npwp_number');
            $table->boolean('is_married')->comment('0 -> single, 1 -> married');
            $table->boolean('gender')->comment('0 -> male, 1 -> female');
            $table->boolean('status')->comment('0 -> nonactive, 1 -> active');
            $table->string('phone_number');
            $table->string('no_rec');
            $table->bigInteger('rank_id')->unsigned();
            $table->timestamps();
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employeers');
    }
}
