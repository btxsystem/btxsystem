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
use App\Models\TransactionNonMember;
use App\Models\TransactionMember;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class ExploreController extends Controller
{
  public $pathView = 'member-v2';

  // public function __construct()
  // {
  //   if(!\Auth::guard('nonmember')->user()) {
  //     redirect()->route('member.login');
  //   }
  // }
  protected function buildFailedValidationResponse(Request $request, array $errors) {
    return ["success" => false, "code"=> 406 , "message" => "forbidden" , "errors" =>$errors];
  }

  public function testMail()
  {
    return view('payment.success');
  }

  public function home()
  {
    return view($this->pathView . '.components.home');
  }

  /**
   * Index
   */
  public function index()
  {
    $books = Ebook::whereIn('id', [1, 2])->select('id', 'title', 'price', 'pv', 'price_markup', 'bv')->with([
      'bookEbooks' => function($q) {
        $q->select('id', 'book_id', 'ebook_id')->with([
          'book' => function($q) {
            $q->select('id', 'title', 'article', 'slug')->with([
              'imageBooks' => function($q) {
                $q->select('id', 'image_id', 'book_id')->with([
                  'image'
                ]);
              }
            ]);
          }
        ]);
      },
      'videoEbooks' => function($q) {
        $q->with([
          'videos'
        ]);
      }
      ])->get();

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
  public function detail(Request $request, $type = 'basic', $username = null)
  {
    $books = Ebook::whereIn('id', [1, 2])->select('id', 'title', 'price', 'pv', 'price_markup', 'bv', 'description', 'src')->with([
      'bookEbooks' => function($q) {
        $q->select('id', 'book_id', 'ebook_id')->with([
          'book' => function($q) {
            $q->select('id', 'title', 'article', 'slug')->with([
              'imageBooks' => function($q) {
                $q->select('id', 'image_id', 'book_id')->with([
                  'image'
                ]);
              }
            ]);
          }
        ]);
      },
    'videoEbooks' => function($q) {
      $q->with([
        'videos'
      ]);
    }
    ])->where('title', $type)->get();

    if($user = Auth::guard('nonmember')->user()) {
      $check  = TransactionNonMember::where([
        'non_member_id' => $user->id,
      ])->with([
        'member'
      ])->first();

      if($check) {
        $referral = $check->member->username;
      } else {
        $referral = '';
      }

    } else {
      $referral = $request->input('username') ?? \Session::get('referral');


      if(Employeer::where('username', $username)->count() > 0 || \Session::has('referral')) {
        if(\Session::has('referral')) {
          $referral = \Session::get('referral');
          if($referral != $username) {
            // \Session::forget('referral');
          }
        } else {
          $referral = $username;
          \Session::put('referral', $username);
        }
      }
    }
    $expiredBasic = null;
    $expiredAdvanced = null;
    $access = null;

    if($user = Auth::guard('nonmember')->user()) {
      $expiredBasic = TransactionNonMember::where('non_member_id', $user->id)
        ->where('status', 1)
        ->whereIn('ebook_id', [1, 3])
        ->select('expired_at')
        ->latest('id')
        ->first();

      $expiredAdvanced = TransactionNonMember::where('non_member_id', $user->id)
        ->where('status', 1)
        ->whereIn('ebook_id', [2, 4])
        ->select('expired_at')
        ->latest('id')
        ->first();

      if($books[0]->id == 1) {
        $access = $expiredBasic;
      } else if($books[0]->id == 2) {
        $access = $expiredAdvanced;
      }
    } else if($user = Auth::guard('user')->user()) {
      $expiredBasic = TransactionMember::with('transaction_ebook_expired')->where('member_id', $user->id)
        ->where('status', 1)
        ->where('ebook_id', 1)
        ->orWhere('ebook_id', 3)
        ->select('expired_at')
        ->latest('id')
        ->first();

      $expiredAdvanced = TransactionMember::with('transaction_ebook_expired')->where('member_id', $user->id)
        ->where('status', 1)
        ->where('ebook_id', 2)
        ->orWhere('ebook_id', 4)
        ->select('expired_at')
        ->latest('id')
        ->first();

        if($books[0]->id == 1) {
          $access = $expiredBasic;
        } else if($books[0]->id == 2) {
          $access = $expiredAdvanced;
        }
    }

    // return response()->json([
    //   'data' => $books
    // ], 200);

    return view($this->pathView . '.components.list-ebook')->with([
      'books' => $books,
      'username' => $referral,
      'expiredBasic' => $expiredBasic,
      'expiredAdvanced' => $expiredAdvanced,
      'access' => $access
    ]);
  }

  /**
   * Subscription
   * 1 = Basic
   * 2 = Advanced
   * 3 = Renewal Basic
   * 4 = Renewal Advanced
   */
  public function subscription(Request $request, $username = null)
  {
    $data = DB::table('close_member')->select('is_close_member')->first();
    if ($data->is_close_member == 1) {
      return view('frontend.auth.maintenance');
    }
    $excludesEbooks = [3, 4];
    $userId = 0;

    $expiredBasic = null;
    $expiredAdvanced = null;

    if($user = Auth::guard('nonmember')->user()) {
      $userId = $user->id;
      $transaction = TransactionNonMember::select('ebook_id')->where([
        'non_member_id' => $user->id,
        'status' => 1
      ])->get();

      $expiredBasic = TransactionNonMember::where('non_member_id', $user->id)
        ->where('status', 1)
        ->whereIn('ebook_id', [1, 3])
        ->select('expired_at')
        ->latest('id')
        ->first();

      $expiredAdvanced = TransactionNonMember::where('non_member_id', $user->id)
        ->where('status', 1)
        ->whereIn('ebook_id', [2, 4])
        ->select('expired_at')
        ->latest('id')
        ->first();

      foreach($transaction as $trx) {
        if(count($transaction) == 1) {
          if($trx->ebook_id == 1) {
            $excludesEbooks = [$trx->ebook_id, 4];
          } else {
            $excludesEbooks = [$trx->ebook_id, 3];
          }
        } else {
          $excludesEbooks = [1, 2];
        }
      }
    } else if($user = Auth::guard('user')->user()) {
      $userId = $user->id;
      $transaction = TransactionMember::select('ebook_id')->where([
        'member_id' => $user->id,
        'status' => 1
      ])->get();

      $expiredBasic = TransactionMember::with('transaction_ebook_expired')->where('member_id', $user->id)
        ->where('status', 1)
        ->where('ebook_id', 1)
        ->orWhere('ebook_id', 3)
        ->select([
          'id',
          'expired_at'
        ])
        ->latest('id')
        ->first();

      $expiredAdvanced = TransactionMember::with('transaction_ebook_expired')->where('member_id', $user->id)
        ->where('status', 1)
        ->where('ebook_id', 2)
        ->orWhere('ebook_id', 4)
        ->select([
          'id',
          'expired_at'
        ])
        ->latest('id')
        ->first();

      foreach($transaction as $trx) {
        if(count($transaction) == 1) {
          if($trx->ebook_id == 1) {
            $excludesEbooks = [$trx->ebook_id, 4];
          } else {
            $excludesEbooks = [$trx->ebook_id, 3];
          }
        } else if(count($transaction) == 2){
          $excludesEbooks = [1, 2];
        } else {
          $excludesEbooks = [3, 4];
        }
      }
    } else {
      $excludesEbooks = [3, 4];
    }

    $ebooks = Ebook::whereNotIn('id', [3, 4])
    ->select('id', 'price', 'pv', 'bv', 'price_markup', 'description', 'title', 'src', 'display_title')
    ->orderBy('position', 'ASC')
    ->get();


    if($user = Auth::guard('nonmember')->user()) {
      $check  = TransactionNonMember::where([
        'non_member_id' => $user->id,
      ])->with([
        'member'
      ])->first();

      if($check) {
        $referral = $check->member->username;
      } else {
        $referral = '';
      }
    } else {
      if(Employeer::where('username', $username)->count() > 0 || \Session::has('referral')) {
        if(\Session::has('referral')) {
          $referral = \Session::get('referral');
          \Session::forget('referral');
        } else {
          $referral = $username;
          \Session::put('referral', $username);
        }
      } else {
        redirect()->route('member.home');
      }
    }

    $referral = '';

    // return response()->json([
    //   'data' => $ebooks,
    //   'expired_basic' => $expiredBasic,
    //   'expired_advanced' => $expiredAdvanced
    // ], 200);
    // $transactions = DB::table('non_members')
    //   ->join('transaction_non_members', 'non_members.id', '=', 'transaction_non_members.non_member_id')
    //   ->select('transaction_non_members.ebook_id')
    //   ->where('transaction_non_members.non_member_id', Auth::guard('nonmember')->user()->id)
    //   ->get();

    $renewalBasic = Ebook::select('id', 'price', 'pv', 'bv', 'price_markup', 'description', 'title', 'src', 'display_title')
    ->where('id', 3)
    ->orderBy('position', 'ASC')
    ->first();

    $renewalAdvanced = Ebook::select('id', 'price', 'pv', 'bv', 'price_markup', 'description', 'title', 'src', 'display_title')
    ->where('id', 4)
    ->orderBy('position', 'ASC')
    ->first();

    if($expiredBasic) {
      if($expiredBasic->transaction_ebook_expired) {
        
        if($expiredBasic->expired_at < $expiredBasic->transaction_ebook_expired->expired_at) {
          $expiredBasic = $expiredBasic->transaction_ebook_expired;
        }
      }
    }

    if($expiredAdvanced) {
      if($expiredAdvanced->transaction_ebook_expired) {
        if($expiredAdvanced->expired_at < $expiredAdvanced->transaction_ebook_expired->expired_at) {
          $expiredAdvanced = $expiredAdvanced->transaction_ebook_expired;
        }
      }
    }


    return view($this->pathView . '.components.subscription')->with([
      'username' => $referral,
      'ebooks' => $ebooks,
      'expired_basic' => $expiredBasic,
      'expired_advanced' => $expiredAdvanced,
      'renewal_basic' => $renewalBasic,
      'renewal_advanced' => $renewalAdvanced
    ]);
  }

  /**
   * Chapter Lists
   */
  public function chapters($slug)
  {
    $book = Book::query()
      ->select('id', 'title', 'slug')
      ->where('slug', $slug)
      ->with([
        'lessons'
      ])
      ->first();

    if(!$book) {
      return redirect()->route('member.home');
    }

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
      ->first();

    if(!$chapter) {
      return redirect()->route('member.home');
    }

    // return response()->json([
    //   'data' => $chapter
    // ], 200);
    return view($this->pathView . '.components.detail-chapter')->with([
      'chapter' => $chapter
    ]);;
  }

  /**
   * Chapter Detail
   */
  public function bookDetail($slug)
  {
    $book = Book::query()
      ->select('id', 'title', 'slug')
      ->where('slug', $slug)
      ->with([
        'lessons:id,book_id,title,type,content',
        'bookEbook' => function($q) {
          $q->with([
            'ebook'
          ]);
        }
      ])
      ->first();
    if(!$book) {
      return redirect()->route('member.home');
    }

    // return response()->json([
    //   'data' => $chapter
    // ], 200);
    return view($this->pathView . '.components.book-detail')->with([
      'book' => $book,
    ]);;
  }

  /**
   *
   */
  public function checkUsername(Request $request)
  {
    $username = strtolower($request->input('username'));

    $this->validate($request, [
      'username' => 'required|min:8'
    ]);

    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username)){
      return response()->json([
        'success' => false,
        'message' => 'Username already exist',
      ]);
    }

    $check = NonMember::where('username', $username)->count();

    if($check > 0) {
      return response()->json([
        'success' => false,
        'message' => 'Username already exist',
      ]);
    }

    $employeer = Employeer::where('username', $username)->count();

    if($employeer > 0) {
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
    $username = strtolower($request->input('username'));

    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username)){
      return response()->json([
        'success' => false,
        'message' => 'Referral not already exist',
      ]);
    }

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

  public function checkEmail(Request $request)
  {
    $email = strtolower($request->input('email'));

    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $email)){
      return response()->json([
        'success' => false,
        'message' => 'Email invalid',
      ]);
    }

    $check = NonMember::where('email', $email)->count();

    if($check <= 0) {
      return response()->json([
        'success' => false,
        'message' => 'Email invalid',
      ]);
    }

    return response()->json([
      'success' => true,
      'message' => 'Email ready to use',
    ]);
  }

  public function solvedLesson(Request $request)
  {
    $lesson = $request->input('lesson');

    $memberId = 0;

    if(Auth::guard('nonmember')->user()) {
      $memberId  = Auth::guard('nonmember')->user()->id;
    } else if (Auth::guard('user')->user()) {
      $memberId  = Auth::guard('user')->user()->id;
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

  public function videoBasic()
  {
    return view('member-v2.components.video-basic');
  }

  public function videoAdvanced()
  {
    return view('member-v2.components.video-advanced');
  }
}
