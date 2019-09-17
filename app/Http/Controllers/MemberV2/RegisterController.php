<?php

namespace App\Http\Controllers\MemberV2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

use App\Employeer;
use App\Builder\NonMemberBuilder;
use App\Builder\PaymentHistoryBuilder;
use App\Builder\TransactionMemberBuilder;
use App\Builder\TransactionNonMemberBuilder;

use App\Factory\RegisterFactoryMake;
use App\Factory\PaymentHistoryFactoryBuild;
use App\Factory\TransactionFactoryRegister;

use App\Models\TransactionMember;
use App\Models\TransactionNonMember;

use Carbon\Carbon;

class RegisterController extends Controller
{ 
  protected function buildFailedValidationResponse(Request $request, array $errors){
    return ["success" => false, "code"=> 406 , "message" => "forbidden" , "errors" =>$errors];
  }

  public function registerV3(Request $request)
  {
    try {
      DB::beginTransaction();

      $ebook = $request->input('ebook');
      $income = $request->input('income');

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
          ->setExpiredAt(Carbon::create(date('Y-m-d H:i:s')))
          ->setIncome($income)
          ->setEbookId($ebook)
          ->setStatus(6); // pending
        
        $transaction = (new TransactionFactoryRegister())
          ->call()
          ->createNonMember($builder);

        $builderPayment = (new PaymentHistoryBuilder())
          ->setEbookId($ebook)
          ->setNonMemberId($nonMemberId);

        $payment = (new PaymentHistoryFactoryBuild())
          ->call()
          ->nonMember($builderPayment);
      } else if(Auth::guard('user')->user()) {
        $nonMember = true;
  
        $memberId = Auth::guard('user')->user()->id;
    
        $builder = (new TransactionMemberBuilder())
          ->setMemberId($memberId)
          ->setExpiredAt(Carbon::create(date('Y-m-d')))
          ->setEbookid($ebook)
          ->setStatus(6); // pending
        
        $transaction  = (new TransactionFactoryRegister())
          ->call()
          ->createMember($builder);

        $builderPayment = (new PaymentHistoryBuilder())
          ->setEbookId($ebook)
          ->setMemberId($memberId);

        $payment  = (new PaymentHistoryFactoryBuild())
          ->call()
          ->member($builderPayment);
      } else {
        $this->validate($request, [
          'username' => 'required|unique:non_members,username'
        ]);

        $builder = (new NonMemberBuilder())
          ->setFirstName($request->input('firstName'))
          ->setLastName($request->input('lastName'))
          ->setEmail($request->input('email'))
          ->setUsername($request->input('username'))
          ->setPassword('secret');
          
        $nonMember = (new RegisterFactoryMake())
          ->call()
          ->createNonMember($builder);

        $builderPayment = (new PaymentHistoryBuilder())
          ->setEbookId($ebook)
          ->setNonMemberId($nonMember->id);

        $payment = (new PaymentHistoryFactoryBuild())
          ->call()
          ->nonMember($builderPayment);

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
          ->setExpiredAt(date('Y-m-d'))
          ->setIncome($income)
          ->setEbookId($ebook)
          ->setTransactionRef($payment->ref_no)
          ->setStatus(6); // pending
          
          $transaction  = (new TransactionFactoryRegister())
            ->call()
            ->createNonMember($builderTrx);
        } else {
          $transaction = false;
        }        
      }

      if(!$nonMember || !$payment || !$transaction) {
        DB::rollback();
        
        return response()->json([
          'success' => false,
          'message' => 'Failed register',
          'data' => ''
        ]);
      }

      DB::commit();

      return response()->json([
        'success' => true,
        'message' => 'Success register',
        'data' => $payment
      ]);
    } catch (\Exception $e) {
      DB::rollback();
  
      return response()->json([
        'success' => false,
        'message' => 'Failed register',
        'data' => $e
      ]);
    }
  }
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
          'message' => 'Failed register',
          'data' => ''
        ]);
      }    
  
      DB::commit();
  
      return response()->json([
        'success' => true,
        'message' => 'Success register',
        'data' => $transaction
      ]);
    } catch(\Exception $e) {
      DB::rollback();
  
      return response()->json([
        'success' => false,
        'message' => 'Failed register',
        'data' => $e
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