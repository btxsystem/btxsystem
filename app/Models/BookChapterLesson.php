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

  protected $guarded = [];

  protected $appends = ['solved'];

  public function lesson()
  {
    return $this->hasOne(BookChapterLessonSolved::class, 'lesson_id', 'id');
  }

  public function getSolvedAttribute()
  {
    if(\Auth::guard('nonmember')->user()) {
      $nonMemberId  = \Auth::guard('nonmember')->user()->id;
      return $this->lesson()->where('member_id', $nonMemberId)->first() ? true : false;
    } else if (\Auth::guard('member')->user()) {
      $memberid  = \Auth::guard('member')->user()->id;
      return $this->lesson()->where('member_id', $memberid)->first() ? true : false;
    }
  }
}
