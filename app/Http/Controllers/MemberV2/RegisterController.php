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

use App\Models\TransactionMember;
use App\Models\TransactionNonMember;

use Carbon\Carbon;

class RegisterController extends Controller
{ 
  /**
   * 
   */
  public function registerV2(Request $request)
  {
    try {
      DB::beginTransaction();

      if(Auth::guard('nonmember')->user()) {
        $nonMember = true;
  
        $nonMemberId = Auth::guard('nonmember')->user()->id;
  
        $referralId = '';
        $referralCode = $request->input('referralCode') ?? '';
        
        //cek referal code
        if($referralCode != '') {
          $referralUser = Employeer::where('username', $referralCode);
          \Session::put('referral', $referralCode);
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
        ->setExpiredAt(date('Y-m-d'))
        ->setIncome($request->input('income'))
        ->setEbookId($request->input('ebook'));
        
        $transaction  = (new TransactionFactoryRegister())->call()->createNonMember($builder);
      } else if(Auth::guard('user')->user()) {
        $nonMember = true;
  
        $memberId = Auth::guard('user')->user()->id;
        $builder = (new TransactionMemberBuilder())
        ->setMemberId($memberId)
        ->setExpiredAt(Carbon::create(date('Y-m-d'))->addYear(1))
        ->setEbookid($request->input('ebook'));
        
        $transaction  = (new TransactionFactoryRegister())->call()->createMember($builder);
      } else {
        if($request->input('username') == '') {
          return response()->json([
            'success' => false,
            'message' => 'Failed register'
          ]);
        }
        $builder = (new NonMemberBuilder())
          ->setFirstName($request->input('firstName'))
          ->setLastName($request->input('lastName'))
          ->setEmail($request->input('email'))
          ->setUsername($request->input('username'))
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
          ->setExpiredAt(Carbon::create(date('Y-m-d'))->addYear(1))
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
    } catch(\Exception $e) {
      DB::rollback();
  
      return response()->json([
        'success' => false,
        'message' => 'Failed register'
      ]);
    }
    
  }

  /**
   * 
   */
  public function renewalEbook(Request $request)
  {
    DB::beginTransaction();

    if(Auth::guard('nonmember')->user()) {
      $nonMemberId = Auth::guard('nonmember')->user()->id;

      $builder = (new TransactionNonMemberBuilder())
      ->setNonMemberId($nonMemberId)
      ->setEbookId($request->input('ebook'))
      ->setIdentifiedBy([
        'ebook_id' => $request->input('ebook'),
        'non_member_id' => $nonMemberId,
      ]);

      $check = TransactionNonMember::where($builder->getIdentifiedBy())->first();

      if(!$check) {
        $builder->setExpiredAt(Carbon::create(date('Y-m-d'))->addYear(1));
      }

      $builder->setExpiredAt(Carbon::create($check->expired_at)->addYear(1));
      
      $transaction  = (new TransactionFactoryRegister())->call()->updateNonMember($builder);

    } else if(Auth::guard('user')->user()) {
      $memberId = Auth::guard('user')->user()->id;

      $builder = (new TransactionMemberBuilder())
      ->setMemberId($memberId)
      ->setEbookid($request->input('ebook'))
      ->setIdentifiedBy([
        'ebook_id' => $request->input('ebook'),
        'member_id' => $memberId,
      ]);
      
      $check = TransactionMember::where($builder->getIdentifiedBy())->first();

      if(!$check) {
        $builder->setExpiredAt(Carbon::create(date('Y-m-d'))->addYear(1));
      }

      $builder->setExpiredAt(Carbon::create($check->expired_at)->addYear(1));

      $transaction  = (new TransactionFactoryRegister())->call()->updateMember($builder);
    }

    if(!$transaction) {
      DB::rollback();

      return redirect()->back();
    }    

    DB::commit();

    return redirect()->back();
    
  }

}