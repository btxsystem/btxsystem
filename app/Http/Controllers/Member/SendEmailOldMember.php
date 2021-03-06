<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employeer;
use App\Models\Ebook;
use App\Models\TransactionMember;
use App\Models\TemporaryRegisterMember;
use App\Models\TemporaryTransactionMember;

use Carbon\Carbon;

use DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\OldMemberMail;

class SendEmailOldMember extends Controller
{

  public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!\Auth::user()) {
                return redirect('/');
            }
            return $next($request);
        });
    }
    
  public function sendMail()
  {

    DB::table('employeers')->orderBy('id')->chunk(10, function($employeers) {
        foreach ($employeers as $key => $employeer) {
            $pass = strtolower(str_random(8));
            DB::table('employeers')->where('id', $employeer->id)->update(['password' => bcrypt($pass)]);
            $dataEmail = (object) [
                'username' => $employeer->username,
                'password' => $pass
            ];
            if (filter_var($employeer->email, FILTER_VALIDATE_EMAIL)) {
              //Mail::to('dhadhang.efendi@gmail.com')->send(new OldMemberMail($dataEmail));
              Mail::to($employeer->email)->send(new OldMemberMail($dataEmail));
            }
        }
    });
            
  }
}
