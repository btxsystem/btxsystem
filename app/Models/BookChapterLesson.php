<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookChapterLesson extends Model
{
  protected $table = 'book_chapter_lessons';
  
  protected $fillable = [
    'title',
    'content',
    'type',
    'chapter_id'
  ];
}
