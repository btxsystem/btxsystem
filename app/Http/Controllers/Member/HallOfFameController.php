<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employeer;
use App\Models\Ebook;

use Carbon\Carbon;

use DB;

class HallOfFameController extends Controller
{
  public function index(Request $request){
    $data['platinum1'] = Employeer::where('rank_id',1)->with('rank')->paginate(3, ['*'], 'page_1s');
    $data['platinum2'] = Employeer::where('rank_id',2)->with('rank')->paginate(3, ['*'], 'page_2s');
    $data['platinum3'] = Employeer::where('rank_id',3)->with('rank')->paginate(3, ['*'], 'page_3s');
    $data['director1'] = Employeer::where('rank_id',4)->with('rank')->paginate(3, ['*'], 'page_4s');
    $data['director2'] = Employeer::where('rank_id',5)->with('rank')->paginate(3, ['*'], 'page_5s');
    $data['director3'] = Employeer::where('rank_id',6)->with('rank')->paginate(3, ['*'], 'page_6s');
    $data['chairman1'] = Employeer::where('rank_id',7)->with('rank')->paginate(3, ['*'], 'page_7s');
    $data['chairman2'] = Employeer::where('rank_id',8)->with('rank')->paginate(3, ['*'], 'page_8s');
    if ($request->ajax()) {
    return view('data', compact('data'))->render();
    }
    return view('frontend.auth.hall-of-fame',compact('data'));
  }
}
