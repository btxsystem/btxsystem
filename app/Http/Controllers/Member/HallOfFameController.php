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

class HallOfFameController extends Controller
{
  public function index(){
      $data['director1'] = Employeer::where('rank_id',4)->with('rank')->paginate(3);
      $data['director2'] = Employeer::where('rank_id',5)->with('rank')->paginate(3);
      $data['director3'] = Employeer::where('rank_id',6)->with('rank')->paginate(3);
      $data['chairman1'] = Employeer::where('rank_id',7)->with('rank')->paginate(3);
      $data['director2'] = Employeer::where('rank_id',8)->with('rank')->paginate(3);
      return $data;
  }
}
