<?php

namespace App\Http\Controllers\Ebook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Models\Ebook;

use App\Employeer;
use App\Models\NonMember;
use App\Models\TransactionNonMember;
use App\Models\TransactionMember;

class HomeController extends Controller
{
  public function index(Request $request, $username = null)
  {
    $excludesEbooks = [3, 4];
    
    if($user = Auth::guard('nonmember')->user()) {
      $transaction = TransactionNonMember::select('ebook_id')->where([
        'non_member_id' => $user->id,
        'status' => 1
      ])->get();

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
      $transaction = TransactionMember::select('ebook_id')->where([
        'member_id' => $user->id,
        'status' => 1
      ])->get();

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
    ->select('id', 'price', 'pv', 'bv', 'price_markup', 'description', 'title')
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

    return view('ebook.components.home')
      ->with([
        'username' => $referral,
        'ebooks' => $ebooks,
        'isLogged' => Auth::guard('nonmember')->user() ?? Auth::guard('user')->user() ?? 'null'
      ]);
  }
}
