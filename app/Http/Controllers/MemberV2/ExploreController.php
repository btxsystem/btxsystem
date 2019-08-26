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
use App\Models\BookChapterLessonSolved;

use App\Employeer;
use App\Models\NonMember;

class ExploreController extends Controller
{
  public $pathView = 'member-v2';

  // public function __construct()
  // {
  //   if(!\Auth::guard('nonmember')->user()) {
  //     redirect()->route('member.login');
  //   }
  // }
  
  /**
   * Index
   */
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
      }])->get();

    // return response()->json([
    //   'data' => $books
    // ], 200);

    return view($this->pathView . '.components.list-ebook')->with([
      'books' => $books,
      'username' => ''
    ]);
  }

  /**
   * Index
   */
  public function detail(Request $request, $type = 'basic')
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
    ])->where('title', $type)->get();

    $username = $request->input('username') ?? '';

    // return response()->json([
    //   'data' => $books
    // ], 200);

    return view($this->pathView . '.components.list-ebook')->with([
      'books' => $books,
      'username' => $username
    ]);
  }

  /**
   * Subscription
   */
  public function subscription(Request $request, $username = null)
  {
    $ebooks = Ebook::select('id', 'price', 'pv', 'bv', 'price_markup', 'description', 'title')->get();

    $referral = '';
    
    if(Employeer::where('username', $username)->count() > 0) {
      $referral = $username;
    } else {
      redirect()->route('member.subscription');
    }

    // $transactions = DB::table('non_members')
    //   ->join('transaction_non_members', 'non_members.id', '=', 'transaction_non_members.non_member_id')
    //   ->select('transaction_non_members.ebook_id')
    //   ->where('transaction_non_members.non_member_id', Auth::guard('nonmember')->user()->id)
    //   ->get();

    return view($this->pathView . '.components.subscription')->with([
      'username' => $referral,
      'ebooks' => $ebooks
    ]);
  }

  /**
   * Chapter Lists
   */
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

  /**
   * Chapter Detail
   */
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
    // return response()->json([
    //   'data' => $chapter
    // ], 200);
    return view($this->pathView . '.components.detail-chapter')->with([
      'chapter' => $chapter
    ]);;
  }

  /**
   * 
   */
  public function checkUsername(Request $request)
  {
    $username = $request->input('username');

    $check = NonMember::where('username', $username)->count();

    if($check > 0) {
      return response()->json([
        'success' => false,
        'message' => 'Username already exist',
      ]);
    }

    return response()->json([
      'success' => true,
      'message' => 'Username ready to use',
    ]);
  }

  /**
   * 
   */
  public function checkReferral(Request $request)
  {
    $username = $request->input('username');
    $check = Employeer::where('username', $username)->count();

    if($check <= 0) {
      return response()->json([
        'success' => false,
        'message' => 'Referral not already exist',
      ]);
    }

    return response()->json([
      'success' => true,
      'message' => 'Referral ready to use',
    ]);
  }

  public function solvedLesson(Request $request)
  {
    $lesson = $request->input('lesson');

    $memberId = 0;

    if(Auth::guard('nonmember')->user()) {
      $memberId  = Auth::guard('nonmember')->user()->id;
    } else if (Auth::guard('member')->user()) {
      $memberId  = Auth::guard('member')->user()->id;
    }

    $save = BookChapterLessonSolved::insert([
      'lesson_id' => $lesson,
      'member_id' => $memberId
    ]);

    if(!$save) {
      return response()->json([
        'success' => false,
        'message' => 'Failed Solved Lesson',
      ]);
    }

    return response()->json([
      'success' => true,
      'message' => 'Success Solved Lesson',
    ]);
  }
}
