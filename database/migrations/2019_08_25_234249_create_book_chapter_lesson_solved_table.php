<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookChapterLessonSolvedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_chapter_lesson_solved', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lesson_id')->unsigned();
            $table->bigInteger('member_id')->unsigned();
            $table->foreign('lesson_id')->references('id')->on('book_chapter_lessons')->onDelete('cascade');
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
        Schema::dropIfExists('book_chapter_lesson_solved');
    }
}
