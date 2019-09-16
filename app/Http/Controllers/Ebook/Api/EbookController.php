<?php

namespace App\Http\Controllers\Ebook\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Models\Ebook;
use App\Employeer;
use App\Models\NonMember;
use App\Models\TransactionNonMember;
use App\Models\TransactionMember;

class EbookController extends Controller
{
  public function all(Request $request)
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
  
    return response()->json([
      'success' => true,
      'message' => '',
      'data' => $ebooks
    ]);
  }
}
