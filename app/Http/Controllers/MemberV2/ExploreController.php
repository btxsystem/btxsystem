<?php

namespace App\Http\Controllers\MemberV2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Models\Book;
use App\Models\Ebook;
use App\Models\BookEbook;
use App\Models\BookChapter;

use App\Employeer;

class ExploreController extends Controller
{
  public $pathView = 'member-v2';

  public function index()
  {
    $books = Ebook::select('id', 'title', 'price', 'pv', 'price_markup', 'bv')->with([
      'bookEbooks' => function($q) {
        $q->select('id', 'book_id', 'ebook_id')->with([
          'book' => function($q) {
            $q->select('id', 'title', 'article')->with([
              'imageBooks' => function($q) {
                $q->select('id', 'image_id', 'book_id')->with([
                  'image'
                ]);
              }
            ]);
          }
        ]);
      }
    ])->get();

    // return response()->json([
    //   'data' => $books
    // ], 200);

    return view($this->pathView . '.components.list-ebook')->with([
      'books' => $books
    ]);
  }

  public function subscription(Request $request, $username = null)
  {
    $ebooks = Ebook::all();

    $referral = '';
    
    if(Employeer::where('id_member', $username)->count() > 0) {
      $referral = $username;
    }

    return view($this->pathView . '.components.subscription')->with([
      'username' => $referral,
      'ebooks' => $ebooks
    ]);
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
      ->select('id', 'title', 'book_id')
      ->where('id', $id)
      ->with([
        'lessons:id,chapter_id,title,type,content',
        'book:id,title'
      ])
      ->firstOrFail();

    return view($this->pathView . '.components.detail-chapter')->with([
      'chapter' => $chapter
    ]);;
  }
}
