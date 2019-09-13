<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('attachable_id');
            $table->string('attachable_type');
            $table->string('name')->nullable();
            $table->string('path');
            $table->boolean('isPublished')->default(0)->comment('0: False 1: True');
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
        Schema::dropIfExists('attachment_images');
    }
}
