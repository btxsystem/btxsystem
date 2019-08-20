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
        $referralUser = Employeer::where('id_member', $referralCode);
        if($referralUser->count() > 0) {
          $referralId = $referralUser->first()->id;
        } else {
          return response()->json([
            'success' => false,
            'message' => 'Failed register'
          ]);
        }
      }
      
      $data = (new NonMemberBuilder())
        ->setFirstName($request->input('firstName') ?? 'a')
        ->setUsername($request->input('userName') ?? 'asep12')
        ->setLastName($request->input('lastName') ?? 'a')
        ->setEmail($request->input('email') ?? 'asep@gmail.com')
        ->setPassword('asep')
        ->setReferredBy($referralId)
        ->build();

      $nonMember = new NonMember();
      $nonMember->first_name = $data->firstName;
      $nonMember->last_name = $data->lastName;
      $nonMember->username = $data->username;
      $nonMember->email = $data->email;
      $nonMember->password = Hash::make($data->password);
      $nonMember->save();

      $transaction = (new TransactionNonMemberBuilder())
        ->setMemberId($referralId)
        ->setNonMemberId($nonMember->id)
        ->setEbookId(1)
        ->saved();

      if(!$nonMember || !$transaction) {
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