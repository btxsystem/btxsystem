<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership', function (Blueprint $table) {
            $table->bigInteger('member_id')->unsigned();
            $table->integer('position')->comment('1 : left ,2 : midle, 3 : right')->nullable();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->bigInteger('sponsor_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('employeers')->onDelete('cascade');
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
        Schema::dropIfExists('membership');
    }
}
