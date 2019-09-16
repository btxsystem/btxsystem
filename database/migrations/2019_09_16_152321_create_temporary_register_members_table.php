<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporaryRegisterMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_register_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('referral')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('nik')->nullable();
            $table->date('birth_date')->nullable();

            $table->text('description')->nullable();
            $table->text('city_id')->nullable();
            $table->string('city_name')->nullable();
            $table->text('province_id')->nullable();
            $table->string('province')->nullable();
            $table->text('subdistrict_id')->nullable();
            $table->string('subdistrict_name')->nullable();
            $table->text('type')->nullable();
            $table->bigInteger('user_id')->nullable();
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
        Schema::dropIfExists('temporary_register_members');
    }
}
