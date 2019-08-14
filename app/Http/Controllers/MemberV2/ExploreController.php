<?php

namespace App\Http\Controllers\MemberV2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Models\Book;
use App\Models\BookChapter;

class ExploreController extends Controller
{
  public $pathView = 'member-v2';

  public function index()
  {
    $books = Book::query()->select('id', 'title')->get();

    return view($this->pathView . '.components.list-ebook')->with([
      'books' => $books
    ]);
  }

  public function subscription()
  {
    return view($this->pathView . '.components.subscription');
  }

  public function chapters($id)
  {
    $book = Book::query()
      ->select('id', 'title')
      ->where('id', $id)
      ->with([
        'chapters'
      ])
      ->firstOrFail();

    return view($this->pathView . '.components.list-chapter')->with([
      'book' => $book
    ]);;
  }

  public function chapter($id)
  {
    $chapter = BookChapter::query()
      ->select('id', 'title')
      ->where('id', $id)
      ->with([
        'lessons:id,chapter_id,title,type,content'
      ])
      ->firstOrFail();

    return view($this->pathView . '.components.detail-chapter')->with([
      'chapter' => $chapter
    ]);;
  }
}
