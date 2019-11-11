<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransferConfirmation;
use App\Employeer;
use App\HistoryBitrexPoints;
use App\Models\Testimonial;
use Carbon\Carbon;
use DataTables;
use Auth;
use Alert;
use DB;

use App\Models\TransactionNonMember;
use App\Models\TransactionMember;
use App\Models\Ebook;
use App\Builder\PaymentHistoryBuilder;
use App\Factory\RegisterFactoryMake;
use App\Factory\PaymentHistoryFactoryBuild;
use App\Models\NonMember;
use App\Models\PaymentHistoryMember;
use App\Models\PaymentHistoryNonMember;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseEbookMemberMail;
use App\Mail\PurchaseEbookNonMemberMail;

class TransferConfirmationController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $data = TransferConfirmation::with(['user' => function ($query){
                        $query->select('id','username','first_name','last_name');
                     }])->orderBy('id','desc');


            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        return $row->status == 0 ? 'Submitted' : 'Approved';
                    })
                    // ->addColumn('name', function($row){
                    //     return $row->name ? $row->name : '-';
                    // })
                    ->addColumn('usernameMember', function($row){
                        return $row->user->first_name.' '.$row->user->last_name;
                    })
                    // ->addColumn('usernameNonMember', function($row){
                    //     return $row->user_type == 'nonmember' ? $row->user->username : '-';
                    // })
                    ->addColumn('date', function($row){
                        return $row->created_at ? $row->created_at : 'No Data';
                    })
                    ->addColumn('nominal', function($row){
                        return $row->amount ? currency($row->amount) : 'No Data';
                    })
                    ->addColumn('action', function($row) {
                        return $this->htmlAction($row);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.transfer-confirmations.index');
    }

    public function show($id)
    {
        $data = TransferConfirmation::findOrFail($id);

        return \response()->json($data);
    }

    public function approve($invoice_number)
    {
        // If Type *Register Member* update table transaction member
        
        TransferConfirmation::where('invoice_number', $invoice_number)->update([
          'status' => 1,
          'approved_at' => now()
        ]);

        DB::beginTransaction();
        try {
            $data = TransferConfirmation::where('invoice_number', $invoice_number)->first();

            if($data->type == 'topup_bitrex_point') {
                $checkRef = HistoryBitrexPoints::where('transaction_ref', $data->invoice_number);

                $member = DB::table('employeers')->where('id',$checkRef->first()->id_member)->select('bitrex_points')->first();


                DB::table('employeers')->where('id', $checkRef->first()->id_member)->update(['bitrex_points' => $member->bitrex_points + $checkRef->first()->points, 'updated_at' => Carbon::now()]);

                $checkRef->update([
                    'status' => 1
                ]);
            }


            if($data->type == 'ebook') {
                $orderType = substr($data->invoice_number, 0, 8);
                $isRenewal = false;

                if($orderType == 'BITREX01') {
                  //
                  // $paymentHistory = PaymentHistoryNonMember::where('ref_no', $data->invoice_number)->update([
                  //   'payment_id' => $payment_id,
                  //   'amount' => $amount,
                  //   'currency' => $currency,
                  //   'trans_id' => $transid,
                  //   'remark' => $remark,
                  //   'auth_code' => $authcode,
                  //   'err_desc' => $errdesc,
                  // ]);

                  $userData = PaymentHistoryNonMember::where('ref_no', $data->invoice_number)
                  ->with([
                    'nonMember'
                  ])
                  ->first();

                  $isRegister = false;

                  $checkIsRegister = TransactionNonMember::where('transaction_ref', $data->invoice_number)
                    ->with([
                      'ebook',
                      'nonMember'
                    ])
                    ->first();

                  if($checkIsRegister) {
                    //if new register
                    if($checkIsRegister->expired_at < now() && $checkIsRegister->status != 1) {
                      $isRegister = true;
                    } else {
                      $isRegister = false;
                    }
                  }

                  $isExpired = $checkIsRegister->expired_at < now() ? true : false;

                  $transaction = TransactionNonMember::where('transaction_ref', $data->invoice_number)
                  ->update([
                    'status' => 1,
                  ]);

                  //if is new register
                  if($isRegister) {
                    $newPassword = strtolower(str_random(8));
                    //generate random password
                    $additionalParameter = (object) [
                      'password' => $newPassword
                    ];
          
                    DB::table('non_members')->where('id', $checkIsRegister->nonMember->id)->update([
                      'password' => password_hash($newPassword, PASSWORD_BCRYPT)
                    ]);

                    $isRenewal = false;

                    //send email
                    Mail::to($checkIsRegister->nonMember->email)->send(new PurchaseEbookNonMemberMail($checkIsRegister, $additionalParameter));
                  } else {
                    //send email
                    $isRenewal = true;
                    Mail::to($checkIsRegister->nonMember->email)->send(new PurchaseEbookNonMemberMail($checkIsRegister, null));
                  }

                } else if($orderType == 'BITREX02') {
                  // $paymentHistory = PaymentHistoryMember::where('ref_no', $data->invoice_number)->update([
                  //   'status' => $status,
                  //   'payment_id' => $payment_id,
                  //   'amount' => $amount,
                  //   'currency' => $currency,
                  //   'trans_id' => $transid,
                  //   'remark' => $remark,
                  //   'auth_code' => $authcode,
                  //   'err_desc' => $errdesc,
                  // ]);

                  // $transaction = TransactionMember::where('transaction_ref', $data->invoice_number)
                  //   ->update([
                  //     'status' => $status == "0" ? 6 : $status
                  // ]);

                  $checkIsRegister = TransactionMember::where('transaction_ref', $data->invoice_number)
                    ->first();

                  $isRegister = false;

                  if($checkIsRegister) {
                    //if new register
                    if($checkIsRegister->expired_at < now() && $checkIsRegister->status != 1) {
                      $isRegister = true;
                    } else {
                      $isRegister = false;
                    }
                  }

                  if($checkIsRegister) {
                    //if new register
                    if($checkIsRegister->expired_at < now() && $checkIsRegister->status != 1) {
                      $isRegister = true;
                    } else {
                      $isRegister = false;
                    }
                  }

                  $isExpired = $checkIsRegister->expired_at < now() ? true : false;

                  $transaction = TransactionMember::where('transaction_ref', $data->invoice_number)
                  ->update([
                    'status' => 1,
                  ]);

                  $checkIsRegister = TransactionMember::where('transaction_ref', $data->invoice_number)
                    ->with([
                      'ebook',
                      'member'
                    ])
                    ->first();

                  if($isRegister) {
                    $isRenewal = false;
                  } else {
                    $isRenewal = true;
                  }

                  // Mail::to($checkIsRegister->member->email)->send(new PurchaseEbookMemberMail($checkIsRegister, null));
                } else {
                  $isRenewal = true;
                  $paymentHistory = false;
                  $transaction = false;
                }

                // if(!$paymentHistory || !$transaction) {
                //   DB::rollback();
                //   return view('payment.failed');
                // }

                  if($orderType == 'BITREX01') {
                    $trxNonMember = TransactionNonMember::where('transaction_ref', $data->invoice_number);
                    if(!$isRenewal) {
                      $trxNonMember->update([
                        'expired_at' => Carbon::create($trxNonMember->latest('id')->first()->expired_at)->addYear(1)
                      ]);
                    } else {
                      $getEbookIdByHistory = PaymentHistoryNonMember::where('ref_no', $data->invoice_number)->first();

                      $newIncome = Ebook::where('id', $getEbookIdByHistory->ebook_id)->first();

                      TransactionNonMember::insert([
                        'income' => $newIncome->price_markup,
                        'member_id' => $trxNonMember->latest('id')->first()->member_id,
                        'non_member_id' => $trxNonMember->latest('id')->first()->non_member_id,
                        'ebook_id' => $getEbookIdByHistory->ebook_id,
                        'status' => $trxNonMember->latest('id')->first()->status,
                        'transaction_ref' => $trxNonMember->latest('id')->first()->transaction_ref,
                        'expired_at' => Carbon::create($trxNonMember->latest('id')->first()->expired_at)->addYear(1)
                      ]);
                    }

                  } else if($orderType == 'BITREX02') {
                    $trxMember = TransactionMember::where('transaction_ref', $data->invoice_number);
                    if(!$isRenewal) {
                      $trxMember->update([
                        'expired_at' => Carbon::create($trxMember->latest('id')->first()->expired_at)->addYear(1)
                      ]);
                    } else {
                      $getEbookIdByHistory = PaymentHistoryMember::where('ref_no', $data->invoice_number)->first();

                      TransactionMember::insert([
                        'member_id' => $trxMember->latest('id')->first()->member_id,
                        'ebook_id' => $getEbookIdByHistory->ebook_id,
                        'status' => $trxMember->latest('id')->first()->status,
                        'transaction_ref' => $trxMember->latest('id')->first()->transaction_ref,
                        'expired_at' => Carbon::create($trxMember->latest('id')->first()->expired_at)->addYear(1)
                      ]);
                    }
                  }
                }


            DB::commit();
            Alert::success('Success Update Data', 'Success');
        } catch (Exception $e) {
            DB::rollback();
            Alert::error('Gagal Update Data', 'Gagal');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $data = TransferConfirmation::findOrFail($id);
        if ($data) { 
            \File::delete(public_path($data->image));
            $data->delete(); 
            Alert::success('Success Delete Data', 'Success');
        } else {
            Alert::error('Gagal Delete Data', 'Gagal');
        }
    }


    public function htmlAction($row)
    {  
      $show = \Auth::guard('admin')->user()->hasPermission('Transfer_confirmation.detail') ? '<a data-id="'.$row->id.'"  class="btn btn-success fa fa-eye show-testimonial" title="Show Payment"></a>' : '';
      $approve = \Auth::guard('admin')->user()->hasPermission('Transfer_confirmation.approve') ? '<a data-invoice_number="'.$row->invoice_number.' "class="btn btn-default fa fa-check approve-payment" style="background-color: #b85ebd; color: #ffffff;" title="Approve Payment"></a>' : '';
      $delete = \Auth::guard('admin')->user()->hasPermission('Transfer_confirmation.delete') ? '<a data-id="'.$row->id.'"  class="btn btn-danger fa fa-trash delete-payment" title="Delete Payment"></a>' : '';
      switch($row->status) {
          case 0:
            return $show.' '.$approve.' '.$delete;
            break;

          case 1;
            return $show.' '.$delete;
            break;

      }

    }
}
