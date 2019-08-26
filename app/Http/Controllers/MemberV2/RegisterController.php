<?php

namespace App\Http\Controllers\MemberV2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

use App\Employeer;
use App\Builder\NonMemberBuilder;
use App\Builder\TransactionMemberBuilder;
use App\Builder\TransactionNonMemberBuilder;

use App\Factory\RegisterFactoryMake;
use App\Factory\TransactionFactoryRegister;

class RegisterController extends Controller
{  
  public function registerV2(Request $request)
  {
    DB::beginTransaction();

    if(Auth::guard('nonmember')->user()) {
      $nonMember = true;

      $nonMemberId = Auth::guard('nonmember')->user()->id;

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

      $builder = (new TransactionNonMemberBuilder())
      ->setMemberId($referralId)
      ->setNonMemberId($nonMemberId)
      ->setIncome($request->input('income'))
      ->setEbookId($request->input('ebook'));
      
      $transaction  = (new TransactionFactoryRegister())->call()->createNonMember($builder);
    } else if(Auth::guard('user')->user()) {
      $nonMember = true;

      $memberId = Auth::guard('user')->user()->id;
      $builder = (new TransactionMemberBuilder())
      ->setMemberId($memberId)
      ->setEbookid($request->input('ebook'));
      
      $transaction  = (new TransactionFactoryRegister())->call()->createMember($builder);
    } else {
      $builder = (new NonMemberBuilder())
        ->setFirstName('Asep')
        ->setLastName('yayat')
        ->setEmail('asep@gmail.com')
        ->setUsername(time())
        ->setPassword('secret');
        
      $nonMember = (new RegisterFactoryMake())->call()->createNonMember($builder);

      if($nonMember) {
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
  
        $builderTrx = (new TransactionNonMemberBuilder())
        ->setMemberId($referralId)
        ->setNonMemberId($nonMember->id)
        ->setIncome($request->input('income'))
        ->setEbookId($request->input('ebook'));
        
        $transaction  = (new TransactionFactoryRegister())->call()->createNonMember($builderTrx);
      } else {
        $transaction = false;
      }
    }

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
    
  }

  // public function register(Request $request)
  // {
  //   // $this->validate($request, [
  //   //   'firstName' => 'required',
  //   //   'email' => 'required',
  //   //   'phone' => 'required'
  //   // ]);
  //   try {
  //     DB::beginTransaction();

  //     $referralId = '';
  //     $referralCode = $request->input('referralCode') ?? '';
      
  //     //cek referal code
  //     if($referralCode != '') {
  //       $referralUser = Employeer::where('username', $referralCode);
  //       if($referralUser->count() > 0) {
  //         $referralId = $referralUser->first()->id;
  //       } else {
  //         return response()->json([
  //           'success' => false,
  //           'message' => 'Failed register'
  //         ]);
  //       }
  //     }
      
  //     if(Auth::guard('nonmember')->user()) {
  //       $nonMember = true;
  //       $memberId = Auth::guard('nonmember')->user()->id;
  //     } else {
  //       $nonMember = RegisterFactory::run('nonmember')->create(
  //         Hash::make('secret')
  //       );
  //       $memberId = $nonMember->id;
  //     }

  //     $transaction = TransactionFactory::run('nonmember')->create(
  //       $referralId, 
  //       $memberId, 
  //       $request->input('ebook'),
  //       $request->input('income')
  //     );

  //     if(!$nonMember || !$transaction) {
  //       DB::rollback();

  //       return response()->json([
  //         'success' => false,
  //         'message' => 'Failed register'
  //       ]);
  //     }

  //     DB::commit();

  //     return response()->json([
  //       'success' => true,
  //       'message' => 'Success register'
  //     ]);

  //   } catch (\Exception $e) {
  //     DB::rollback();
  //     return response()->json([
  //       'success' => false,
  //       'message' => 'Failed register',
  //       'error' => []
  //     ]);
  //   }
  // }

}