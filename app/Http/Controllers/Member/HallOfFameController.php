<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employeer;
use App\Models\Ebook;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class HallOfFameController extends Controller
{
  public function index(Request $request){
    $data['platinum1'] = Employeer::where('rank_id',1)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->paginate(25, ['*'], 'page_1s');
    $data['platinum2'] = Employeer::where('rank_id',2)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->paginate(5, ['*'], 'page_2s');
    $data['platinum3'] = Employeer::where('rank_id',3)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->paginate(5, ['*'], 'page_3s');
    // $data['director1'] = Employeer::where('rank_id',4)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->paginate(3, ['*'], 'page_4s');
    // $data['director2'] = Employeer::where('rank_id',5)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->paginate(3, ['*'], 'page_5s');
    $data['director1'] = Employeer::where('rank_id',4)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->get();
    $data['director2'] = Employeer::where('rank_id',5)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->get();
    $data['director3'] = Employeer::where('rank_id',6)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->get();
    // $data['director3'] = Employeer::where('rank_id',6)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->paginate(3, ['*'], 'page_6s');
    $data['chairman1'] = Employeer::where('rank_id',7)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->paginate(3, ['*'], 'page_7s');
    $data['chairman2'] = Employeer::where('rank_id',8)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->paginate(3, ['*'], 'page_8s');
    $data['page'] = isset(array_keys($request->all())[0]) ? array_keys($request->all())[0] : null;
    return view('frontend.auth.hall-of-fame',compact('data'));
  }

  public function index2(Request $request){
    $data = Auth::user();
    $rank = DB::table('ranks')->select('name')->where('id','=',$data->rank_id)->first();
    $pv_group = DB::table('pv_rank')->select('pv_left','pv_midle','pv_right')->where('id_member','=',$data->id)->first();
    $data['platinum1'] = Employeer::where('rank_id',1)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->paginate(25, ['*'], 'page_1s');
    $data['platinum2'] = Employeer::where('rank_id',2)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->paginate(5, ['*'], 'page_2s');
    $data['platinum3'] = Employeer::where('rank_id',3)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->paginate(5, ['*'], 'page_3s');
    // $data['director1'] = Employeer::where('rank_id',4)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->paginate(3, ['*'], 'page_4s');
    // $data['director2'] = Employeer::where('rank_id',5)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->paginate(3, ['*'], 'page_5s');
    $data['director1'] = Employeer::where('rank_id',4)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->get();
    $data['director2'] = Employeer::where('rank_id',5)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->get();
    $data['director3'] = Employeer::where('rank_id',6)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->get();
    // $data['director3'] = Employeer::where('rank_id',6)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->paginate(3, ['*'], 'page_6s');
    $data['chairman1'] = Employeer::where('rank_id',7)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->paginate(3, ['*'], 'page_7s');
    $data['chairman2'] = Employeer::where('rank_id',8)->where('expired_at', '>', Carbon::now())->where('status','!=',0)->with('rank')->orderBy('first_name', 'asc')->paginate(3, ['*'], 'page_8s');
    $profile = array(
        "id_member" => $data->id_member,
        "username" =>  $data->username,
        "name" => $data->first_name.' '.$data->last_name,
        "email" => $data->email,
        "birthdate" => date('F j, Y',strtotime($data->birthdate)),
        "npwp_number" => $data->npwp_number,
        "is_married" => $data->is_married ? 'Married' : 'Single',
        "gender" => $data->gender ? 'Male' : 'Female',
        "status" => $data->status ? 'Active' : 'Nonactive',
        "phone_number" => $data->phone_number,
        "no_rec" => $data->no_rec ? $data->no_rec : '-',
        "bank_name" => $data->bank_name ? $data->bank_name : '-',
        "bank_account_name" => $data->bank_account_name ? $data->bank_account_name : '-',
        "rank" => $rank ? $rank->name : '-' ,
        "bitrex_cash" => $data->bitrex_cash,
        "bitrex_points" => $data->bitrex_points,
        "src" => $data->src,
        "pv" => $pv_group ? $pv_group->pv_left + $pv_group->pv_midle + $pv_group->pv_right : 0
    );
    $data['page'] = isset(array_keys($request->all())[0]) ? array_keys($request->all())[0] : null;
    return view('frontend.hall-of-fame',compact('profile', 'data'));
  }

}
