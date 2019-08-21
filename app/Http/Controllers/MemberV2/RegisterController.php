<?php

namespace App\Http\Controllers\MemberV2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

use App\Models\NonMember;
use App\Models\TransactionNonMember;
use App\Builder\NonMemberBuilder;
use App\Builder\TransactionNonMemberBuilder;
use App\Employeer;


use App\Factory\TransactionFactory;
use App\Factory\RegisterFactory;

class RegisterController extends Controller
{  
  public function register(Request $request)
  {
    // $this->validate($request, [
    //   'firstName' => 'required',
    //   'email' => 'required',
    //   'phone' => 'required'
    // ]);
    try {
      DB::beginTransaction();

      $referralId = '';
      $referralCode = $request->input('referralCode') ?? '';
      
      //cek referal code
      if($referralCode != '') {
        $referralUser = Employeer::where('username', $referralCode);
        if($referralUser->count() > 0) {
          $referralId = $referralUser->first()->id;
        } else {
          return response()->json([
            'success' => false,
            'message' => 'Failed register'
          ]);
        }
      }

      //$nonMember = RegisterFactory::run('nonmember')->create();

      $memberId = Auth::guard('nonmember')->user()->id;
      $transaction = TransactionFactory::run('nonmember')->create($referralId, $memberId, $request->input('ebook'));

      if(!$transaction) {
        DB::rollback();

        return response()->json([
          'success' => false,
          'message' => 'Failed register'
        ]);
      }

      DB::commit();

      return response()->json([
        'success' => true,
        'message' => 'Success register'
      ]);

    } catch (\Exception $e) {
      DB::rollback();
      return response()->json([
        'success' => false,
        'message' => 'Failed register',
        'error' => $e
      ]);
    }
  }

}