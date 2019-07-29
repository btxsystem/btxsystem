<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoinTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_training', function (Blueprint $table) {
            $table->bigInteger('training_id')->unsigned();
            $table->bigInteger('member_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('employeers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('join_training');
    }
}
