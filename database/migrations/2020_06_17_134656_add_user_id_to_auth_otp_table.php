<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToAuthOtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auth_otp', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->default("1")->after("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auth_otp', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
        });
    }
}
