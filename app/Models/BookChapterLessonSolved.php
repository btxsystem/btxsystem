<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookChapterLessonSolved extends Model
{
  protected $table = 'book_chapter_lesson_solved';
  
  protected $fillable = [
    'lesson_id',
    'member_id',
  ];

  protected $guarded = [];
}
