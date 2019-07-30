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
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birthdate');
            $table->string('npwp_number');
            $table->boolean('is_married')->comment('0 -> single, 1 -> married');
            $table->boolean('gender')->comment('0 -> male, 1 -> female');
            $table->boolean('status')->comment('0 -> nonactive, 1 -> active');
            $table->string('phone_number');
            $table->string('no_rec');
            $table->integer('position')->comment('1 : left ,2 : midle, 3 : right')->nullable();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->bigInteger('sponsor_id')->unsigned()->nullable();
            $table->bigInteger('rank_id')->unsigned();
            $table->timestamps();
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('employeers')->onDelete('cascade');
            $table->foreign('sponsor_id')->references('id')->on('employeers')->onDelete('cascade');
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
