<?php

namespace App\Http\Controllers\EbookV2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Employeer;
use App\Models\NonMember;
use App\Models\TransactionNonMember;
use App\Models\TransactionMember;
use App\Models\VideoCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use DB;
class EbookController extends Controller
{
    //

    public function index(Request $request, $username = null)
    {
        try {
            $referral = '';

            $ebooks = Ebook::with(['children'])
                ->where('parent_id', 0)
                ->orderBy('position', 'ASC')
                ->get();

            // return response()->json($ebooks);

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
                if(Employeer::where('username', $username)->count() > 0 || Session::has('referral')) {
                    if(Session::has('referral')) {
                        $referral = \Session::get('referral');
                        Session::forget('referral');
                    } else {
                        $referral = $username;
                        Session::put('referral', $username);
                    }
                } else {
                    redirect()->route('member.home');
                }
            }

            return view('member-v2.components.v2.subscription')->with([
                'username' => $referral,
                'ebooks' => $ebooks,
            ]);
        } catch (\Exception $e) {
            redirect()->route('member.home');
        }
    }

    public function detail(Request $request, $slug = '', $username = null)
    {
        try {
            $ebooks = Ebook::with(['children'])
                ->where('parent_id', 0)
                ->where('slug', $slug)
                ->with([
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

            $videoCategories = VideoCategory::with('videos')->where('ebook_id', $ebooks[0]->id)->get();

            return view('member-v2.components.v2.list-ebook')->with([
                'books' => $ebooks,
                'username' => $referral,
                'videoCategories' => $videoCategories
            ]);
        } catch(\Exception $e) {
            return redirect()->route('member.home');
        }
    }
}
