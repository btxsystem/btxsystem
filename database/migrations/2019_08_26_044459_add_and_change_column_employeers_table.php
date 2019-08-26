<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndChangeColumnEmployeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employeers', function (Blueprint $table) {
            $table->dropUnique('employeers_email_unique');
            $table->string('npwp_number')->nullable()->change();
            $table->boolean('is_married')->comment('0 -> single, 1 -> married')->nullable()->change();
            $table->boolean('status')->comment('0 -> nonactive, 1 -> active')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('no_rec')->nullable()->change();
            $table->bigInteger('rank_id')->nullable()->unsigned()->change();
            $table->string('src')->nullable();
            $table->boolean('is_update')->comment('0 -> have not update, 1 -> have update ')->default(1);
            $table->string('nik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employeers', function (Blueprint $table) {
            $table->unique('email');
            $table->dropColumn('src');
            $table->dropColumn('is_update');
            $table->dropColumn('nik');
        });
    }
}
