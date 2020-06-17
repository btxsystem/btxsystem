<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToAuthOtpTable extends Migration
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
            $table->enum('type', ['otp', 'passcode'])->nullable()->default("otp");
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
            $table->dropColumn('type');
        });
    }
}
