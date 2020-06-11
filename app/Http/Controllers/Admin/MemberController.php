<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employeer;
use App\HistoryPv;
use App\Models\Ebook;
use App\HistoryBitrexPoints;
use App\HistoryBitrexCash;
use App\Models\TransactionMember;
use App\Models\HistoryPVPairing;
use DataTables;
use Alert;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\MembersExport;
use App\Models\Address;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\TransactionEbookExpired;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            
            if($request->from_date)
            {
                $to_date = date('Y-m-d',strtotime($request->to_date . "+1 days"));
                // $from_date = date('Y-m-d',strtotime($request->from_date . "+1 days"));
                $data = Employeer::where('employeers.status', 1)
                ->whereBetween('created_at', [$request->from_date, $to_date])
                ->with(
                        'rank',
                        'sponsor',
                        'archive',
                        'lastArchive'
                        )
                ->select('employeers.id','id_member','username','first_name','last_name','rank_id','sponsor_id','employeers.created_at','employeers.status');
            }
            else {
                $data = Employeer::where('employeers.status', 1)
                ->with(
                        'rank',
                        'sponsor',
                        'archive', 
                        'lastArchive'
                        ) 
                ->select('employeers.id','id_member','username','first_name','last_name','rank_id','sponsor_id','employeers.created_at','employeers.status');
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('status', function($data) {
                        return $data->status == 1 ? 'Active' : 'Nonactive' ;
                    })
                    ->editColumn('full_name', function($data) {
                        return $data->first_name .' '. $data->last_name;
                    })
                    ->editColumn('join_at', function($data){
                        return isset($data->created_at) ?  date_format($data->created_at,"d M Y") : date_format($data['created_at'],"d M Y");
                    })
                    // ->editColumn('archive',function($data){
                    //     if (!isset($data->archive[0]) || $data->archive[0] == null) {
                    //         return '-';
                    //     }else{
                    //         return isset($data->archive[0]->created_at) ? date_format($data->archive[0]->created_at,"d M Y") : date_format($data->archive[0]['created_at'],"d M Y");
                    //     }
                    // })
                    ->editColumn('lastArchive', function($data) {
                        return $data->lastArchive ? date_format($data->lastArchive->created_at, "d M Y"): '-';
                    })
                    ->editColumn('ranking', function($data) {
                        return $data->rank ? $data->rank->name : '-';
                    })
                    ->editColumn('sponsor', function($data) {
                        return $data->sponsor ? $data->sponsor->username : '-';
                    })
                    ->addColumn('action', function($row) {
                        return $this->htmlAction($row);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.members.active.index');
    }

    public function update_member_hall_of_fame(Request $request)
    {
        if (request()->ajax()) {
            $update = Employeer::where('id', $request->id)
                ->update([
                    'show_hall_of_fame' => $request->type == 'hide' ? 0 : 1
                ]);

            if($update) {
                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false]);
        }
    }

    public function member_hall_of_fame(Request $request)
    {
        if (request()->ajax()) {
            
            if($request->from_date)
            {
                $to_date = date('Y-m-d',strtotime($request->to_date . "+1 days"));
                // $from_date = date('Y-m-d',strtotime($request->from_date . "+1 days"));
                $data = Employeer::where('employeers.status', 1)
                ->whereBetween('created_at', [$request->from_date, $to_date])
                ->with('rank','sponsor','archive','lastArchive')
                ->select('employeers.id','id_member','username','first_name','last_name','rank_id','sponsor_id','employeers.created_at','employeers.status');
            }
            else {
                $data = Employeer::where('employeers.status', 1)
                ->where('rank_id', '!=', null)
                ->where('rank_id', '!=', '')
                ->with('rank','sponsor','archive', 'lastArchive') 
                ->select('employeers.id','id_member','username','first_name','last_name','rank_id','sponsor_id','employeers.created_at','employeers.status', 'employeers.show_hall_of_fame');
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('status', function($data) {
                        return $data->status == 1 ? 'Active' : 'Nonactive' ;
                    })
                    ->editColumn('full_name', function($data) {
                        return $data->first_name .' '. $data->last_name;
                    })
                    ->editColumn('join_at', function($data){
                        return isset($data->created_at) ?  date_format($data->created_at,"d M Y") : date_format($data['created_at'],"d M Y");
                    })
                    // ->editColumn('archive',function($data){
                    //     if (!isset($data->archive[0]) || $data->archive[0] == null) {
                    //         return '-';
                    //     }else{
                    //         return isset($data->archive[0]->created_at) ? date_format($data->archive[0]->created_at,"d M Y") : date_format($data->archive[0]['created_at'],"d M Y");
                    //     }
                    // })
                    ->editColumn('lastArchive', function($data) {
                        return $data->lastArchive ? date_format($data->lastArchive->created_at, "d M Y"): '-';
                    })
                    ->editColumn('ranking', function($data) {
                        return $data->rank ? $data->rank->name : '-';
                    })
                    ->editColumn('show_hall_of_fame', function($data) {
                        return $data->show_hall_of_fame ? true : false;
                    })
                    ->editColumn('sponsor', function($data) {
                        return $data->sponsor ? $data->sponsor->username : '-';
                    })
                    ->addColumn('action', function($row) {
                        return $this->htmlAction($row);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.members.active.index');
    }

    public function member_nonactive(Request $request)
    {
        if (request()->ajax()) {
            if($request->from_date)
            {
                $to_date = date('Y-m-d',strtotime($request->to_date . "+1 days"));
                $data = Employeer::where('status', 0)
                ->whereBetween('created_at', [$request->from_date, $to_date])
                ->with('rank','sponsor')
                ->select('id','id_member','username','first_name','last_name','rank_id','sponsor_id','created_at','status');
            }
            else {
                $data = Employeer::where('status', 0)
                ->with('rank')
                ->select('id','id_member','username','first_name','last_name','rank_id','sponsor_id','created_at','status');
            }

            return Datatables::of($data)
                     ->addIndexColumn()
                     ->editColumn('status', function($data) {
                         return $data->status == 1 ? 'Active' : 'Nonactive' ;
                     })
                     ->editColumn('full_name', function($data) {
                         return $data->first_name .' '. $data->last_name;
                     })
                     ->editColumn('ranking', function($data) {
                         return $data->rank ? $data->rank->name : '-';
                     })
                     ->editColumn('sponsor', function($data) {
                         return $data->sponsor ? $data->sponsor->username : '-';
                     })
                     ->addColumn('action', function($row) {
                         return $this->htmlAction($row);
                     })
                     ->rawColumns(['action'])
                     ->make(true);
        }
        return view('admin.members.nonactive.index');
    }

    public function redirect(){
        DB::table('close_member')->where('is_close_member', 0)->update(['is_close_member' => 1, 'updated_at' => now()]);
        $data['successs'] = 200;
        return $data;
    }

    public function nonredirect(){
        DB::table('close_member')->where('is_close_member', 1)->update(['is_close_member' => 0, 'updated_at' => now()]);
        $data['successs'] = 200;
        return $data;
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function nonactive($id)
    {

        // return 'aaa';
        // $data['status'] = 0;
        // Employeer::findOrFail($id)->update($data);
        // return redirect()->back();

        $data = Employeer::findOrFail($id);
        if ($data) {

            $data->update([
                'status' => 0
            ]);

            return 'Update Sukses';
        } else {
            return 'Update Gagal, data tidak ditemukan';
        }

    }

    public function active($id)
    {
        // $data['status'] = 1;
        // Employeer::findOrFail($id)->update($data);
        // return redirect()->back();

        $data = Employeer::findOrFail($id);
        if ($data) {

            $data->update([
                'status' => 1
            ]);

            return 'Update Sukses';
        } else {
            return 'Update Gagal, data tidak ditemukan';
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:employeers|max:255|alpha_dash',
            'first_name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6',
            'birthdate' => 'required',
            'nik' => 'required',
            'gender' => 'required',
            'parent_id' => 'required',
            'sponsor_id' => 'required',
            'src' => 'mimes:jpeg,bmp,png|max:4096'
        ]);
        DB::beginTransaction();
        try{

            $data = new Employeer;
            $data->id_member = memberIdGenerate();
            $data->nik = $request->nik;
            $data->username = $request->username;
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->birthdate = $request->birthdate;
            $data->npwp_number = $request->npwp_number;
            $data->is_married = $request->is_married;
            $data->gender = $request->gender;
            $data->phone_number = $request->phone_number;
            $data->no_rec = $request->no_rec;
            $data->bank_account_name = $request->bank_account_name;
            $data->bank_name = $request->bank_name;
            $data->position = $request->position;
            $data->parent_id = $request->parent_id;
            $data->sponsor_id = $request->sponsor_id;
            $data->rank_id = $request->rank_id;
            $data->src = $request->src;
            $data->status = 1;
            $data->is_update = 1;
            $data->bitrex_cash = 0;
            $data->bitrex_points = 0;
            $data->pv = 0;

            if ($request->hasFile('src')) {
                $image = $request->src;
                $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
                $uploadPath = 'upload/member/image/' . $imageName; //make sure folder path already exist
                $image->move('upload/member/image/', $imageName);
                $data->src = $uploadPath;
            }

            $data->save();



            DB::commit();

            Alert::success('Sukses Menambah Data Member', 'Sukses');
            // return redirect()->route('members.index');
            return view('admin.members.active.index');

        }catch(\Exception $e){
            // throw $e;
            DB::rollback();

            Alert::error('Gagal Menambah Data Member', 'Gagal');
            return \redirect()->back();
        }
    }

    public function refound(Request $request){
        $request->points = (int)$request->points;
        $member = Employeer::where('id', $request->name)->first();
        if ($member->bitrex_points < $request->points) {
            Alert::success('Gagal melakukan refund, refund points harus lebih bersar atau sama dengan total points', 'Failed');
            return redirect()->route('members.show', $member->id);
        }else{
            DB::beginTransaction();
            try{
                $member->update([
                    'bitrex_points' => $member->bitrex_points - $request->points
                ]);

                $topup = new HistoryBitrexPoints;
                $topup->id_member = $request->name;
                $topup->nominal = $request->points * 1000;
                $topup->points = $request->points;
                $topup->description = $request->description;
                $topup->info = 0;
                $topup->status = 1;
                $topup->save();

                DB::commit();

                Alert::success('Sukses Melakukan Refund', 'Sukses');
                return redirect()->route('members.show', $member->id);

            }catch(\Exception $e){
                // throw $e;
                DB::rollback();

                Alert::error('Gagal Melakukan Topup', 'Gagal');
                return \redirect()->back();
            }
        }
    }

    public function show($id)
    {
        $data = Employeer::with('ebooks.transactionMember','transaction','sponsor', 'address')->findOrFail($id);

        $ebooks = Ebook::orderBy('id', 'desc')->get();

        return view('admin.members.detail', compact('data','ebooks'));

    }

    public function edit($id)
    {
        $data = Employeer::with('sponsor')->findOrFail($id);

        return view('admin.members.edit', compact('data'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'max:255|unique:employeers,username,'.$id,
            'first_name' => 'required|max:255',
            'password' => 'min:6',
            'birthdate' => 'required',
            'gender' => 'required',
            'src' => 'mimes:jpeg,bmp,png|max:4096'
        ]);
        DB::beginTransaction();
        try{
            $data = Employeer::with('sponsor', 'address')->findOrFail($id);

            if($request->city && $request->city_name && $request->province && $request->province_name && $request->district && $request->district_name) {
                if($data->address == null) {
                    Address::insert([
                        'decription' => $request->address,
                        'city_id' => $request->city,
                        'city_name' => $request->city_name,
                        'province_id' => $request->province,
                        'province' => $request->province_name,
                        'subdistrict_id' => $request->district,
                        'subdistrict_name' => $request->district_name,
                        'type' => 'district',
                        'user_id' => $id
                    ]);
                } else {
                    Address::where('user_id', $id)->update([
                        'decription' => $request->address,
                        'city_id' => $request->city,
                        'city_name' => $request->city_name,
                        'province_id' => $request->province,
                        'province' => $request->province_name,
                        'subdistrict_id' => $request->district,
                        'subdistrict_name' => $request->district_name,
                    ]);
                }
            }
            
            $data->nik = $data->nik;
            $data->first_name = $request->first_name;
            $data->username = $request->username;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->birthdate = $request->birthdate;
            $data->npwp_number = $request->npwp_number;
            $data->is_married = $request->is_married;
            $data->gender = $request->gender;
            $data->phone_number = $request->phone_number;
            $data->no_rec = $request->no_rec;
            $data->bank_account_name = $request->bank_account_name;
            $data->bank_name = $request->bank_name;


            if ($request->hasFile('src')) {
                $image = $request->src;
                $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
                $uploadPath = 'upload/member/image/' . $imageName; //make sure folder path already exist
                $image->move('upload/member/image/', $imageName);
                $data->src = $uploadPath;
            }
            $data->save();
            DB::commit();

            Alert::success('Sukses Update Data Member', 'Sukses');
            return redirect()->route('members.show', $data->id);

        }catch(\Exception $e){
            throw $e;
            DB::rollback();

            Alert::error('Gagal Update Data Member', 'Gagal');
            return \redirect()->back();
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = \Validator::make($request->all(), ['password' => 'min:6']);

        if ($validator->fails()) {
            Alert::error('Password minimal 6 karakter', 'Gagal')->persistent("Close");
            return \redirect()->back();
         }

        DB::beginTransaction();
        try{

            $data = Employeer::findOrFail($request->id);
            if($request->password != $request->comfirm_password ) {
                Alert::error('Password & Confirmasi Password tidak sama !!', 'Gagal')->persistent("Close");
                return \redirect()->back();
            }
            $data->password = bcrypt($request->password);
            $data->save();
            DB::commit();

            Alert::success('Sukses Update Password', 'Sukses');
            return redirect()->route('members.show', $data->id);

        }catch(\Exception $e){
            // throw $e;
            DB::rollback();

            Alert::error('Gagal Update Password', 'Gagal');
            return \redirect()->back();
        }

    }

    public function topup(Request $request)
    {
        DB::beginTransaction();
        try{
            $point = $request->nominal / 1000;
            $member = Employeer::where('id', $request->name)->first();
            $member->update([
                'bitrex_points' => $member->bitrex_points + $point
            ]);

            $topup = new HistoryBitrexPoints;
            $topup->id_member = $request->name;
            $topup->nominal = $request->nominal;
            $topup->points = $point;
            $topup->description = $request->description;
            $topup->info = 1;
            $topup->status = 1;
            $topup->save();


            DB::commit();

            Alert::success('Sukses Melakukan Topup', 'Sukses');
            return redirect()->route('members.show', $member->id);

        }catch(\Exception $e){
            // throw $e;
            DB::rollback();

            Alert::error('Gagal Melakukan Topup', 'Gagal');
            return \redirect()->back();
        }
    }

    public function buyProduct(Request $request)
    {
        DB::beginTransaction();
        try{
            $buy = new TransactionMember;
            $buy->member_id = $request->member_id;
            $buy->ebook_id = $request->ebook_id;
            $buy->status = 1;
            $buy->expired_at = Carbon::now()->addYears(1)->toDateString();
            $buy->save();

            if (isset($request->isBp)) {
                $user = Employeer::where('id',$request->member_id)->first();
                $history = new HistoryBitrexPoints;
                $ebooks = Ebook::where('id',$request->ebook_id)->first();
                if ($user->bitrex_points < ($ebooks->price/1000)) {
                    DB::rollback();
                    Alert::error('Bitrex points tidak cukup', 'Gagal');
                    return redirect()->route('members.show', $request->member_id);
                }
                $user->bitrex_points = $user->bitrex_points - ($ebooks->price/1000);
                $history->id_member = $request->member_id;
                $history->nominal = $ebooks->price;
                $history->points = $ebooks->price/1000;
                $history->description = "Buy ebook ".$ebooks->title." from backoffice";
                $history->info = 0;
                $history->status = 1;
                $user->save();
                $history->save();
            }

            DB::commit();

            Alert::success('Sukses Melakukan Pembelian Product', 'Sukses');
            return redirect()->route('members.show', $request->member_id);
        }catch(\Exception $e){
            // throw $e;
            DB::rollback();

            Alert::error('Gagal Melakukan Pembelian Product', 'Gagal');
            return \redirect()->back();
        }
    }

    public function historyPointData($id)
    {
        // $data = Employeer::findOrFail($id);
        $data = HistoryBitrexPoints::where('id_member', $id)
                                    ->where('status', 1)
                                    ->orderBy('created_at', 'desc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nominal', function ($data) {
                return currency($data->nominal);
            })
            ->addColumn('points', function ($data) {
                return $data->points ? $data->points : 0;
            })
            ->addColumn('info', function ($data) {
                return $this->getStatusInfoTransaction($data);
            })
            ->addColumn('status', function ($data) {
                return $data->status ? $this->getStatusPayment($data) : 'No Action';
            })
            ->rawColumns(['description'])
            ->make(true);
    }

    public function historyCashData($id)
    {
        // $data = Employeer::findOrFail($id);

        $data = HistoryBitrexCash::where('id_member', $id)->orderBy('created_at', 'desc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nominal', function ($data) {
                return currency($data->nominal);
            })
            ->addColumn('info', function ($data) {
                return $this->getStatusInfoTransaction($data);
            })
            ->make(true);
    }

    public function historyPVPairing($id)
    {
        // $data = Employeer::findOrFail($id);
        $data = HistoryPVPairing::where('id_member', $id)->orderBy('created_at', 'desc');

        return Datatables::of($data)
                        ->addIndexColumn()
                        ->make(true);
    }

    public function historyPV($id)
    {
        // $data = Employeer::findOrFail($id);
        $data = HistoryPv::where('id_member', $id)->orderBy('created_at', 'desc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function transactionMember($id)
    {
        $data = TransactionMember::with('ebook', 'transaction_ebook_expired')->where('member_id', $id)->orderBy('created_at', 'desc');
        // $data = Employeer::with('transaction_member.ebook')->findOrFail($id);

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nominal', function ($data) {
                return currency($data->nominal);
            })
            ->addColumn('info', function ($data) {
                return $this->getStatusInfoTransaction($data);
            })
            ->editColumn('expired_at', function($data) {
                if($data->transaction_ebook_expired) {
                    if($data->expired_at < $data->transaction_ebook_expired->expired_at) {
                        return $data->transaction_ebook_expired->expired_at;
                    }
                }

                return $data->expired_at;
            })
            ->addColumn('action', function ($data) {
                $expired = date('Y-m-d H:i:s', strtotime($data->expired_at));

                $action = "";

                $addExpired = "<a class='btn btn-primary add-expired-ebook' data-id='$data->id' data-action='".route('members.add.expired.ebook', [$data->id])."'><i class='fa fa-plus'></i></a>";

                if($expired > date('Y-m-d') && $data->status == 1) {
                    $action .= "<a href='".route('members.transaction.inactive.ebook', ['id' => $data->id, 'employeer' => $data->member_id])."' class='btn btn-danger nonactive-ebook'><i class='fa fa-power-off'></i></a> $addExpired";

                    return $action;
                }

                $action .="$addExpired Expired";

                return $action;
            })
            ->make(true);
    }

    public function editExpiredEbook(Request $request, $transactionId = 0)
    {
        try {
            $date = date('Y-m-d H:i:s', strtotime(str_replace(" ", "-", $request->input('added_expired'))));

            $transactionMember = TransactionMember::findOrFail($transactionId);

            $totalTransaction = TransactionEbookExpired::where('transaction_id', $transactionId)
                ->first();

            $employeer = Employeer::find($transactionMember->member_id);

            DB::beginTransaction();

            if($totalTransaction) {
                
                $previousDate = Carbon::parse($totalTransaction->expired_at);

                $now = Carbon::parse($date);

                $diff = $previousDate->diffInDays($now);

                $addedExpiredMember = Carbon::parse($employeer->expired_at)->addDays($diff)->toDateString();

                $employeer->update([
                    'expired_at' => $addedExpiredMember
                ]);

                $transaction = TransactionEbookExpired::where('transaction_id', $transactionId)->update([
                    'expired_at' => $date
                ]);

                if(!$transaction || !$employeer) {
                    DB::rollBack();
                    Alert::error('Gagal Menambahkan Masa Aktif Ebook', 'Gagal1');
                    return redirect()->back();
                }

                DB::commit();

                Alert::error('Berhasil Menambahkan Masa Aktif Ebook', 'Sukses');

                return redirect()->back();
            }


            $previousDate = Carbon::parse($transactionMember->expired_at);

            $now = Carbon::parse($date);

            $diff = $previousDate->diffInDays($now);

            $addedExpiredMember = Carbon::parse($employeer->expired_at)->addDays($diff)->toDateString();

            $employeer->update([
                'expired_at' => $addedExpiredMember
            ]);

            $transaction = TransactionEbookExpired::insert([
                'transaction_id' => $transactionId,
                'type' => 'member',
                'expired_at' => $date
            ]);

            if(!$transaction || !$employeer) {
                DB::rollBack();
                Alert::error('Gagal Menambahkan Masa Aktif Ebook', 'Gagal');
                return redirect()->back();
            }

            DB::commit();

            Alert::error('Berhasil Menambahkan Masa Aktif Ebook', 'Sukses');

            return redirect()->back();


        } catch (\Exception $e) {
            Alert::error('Gagal Menambahkan Masa Aktif Ebook', 'Gagal3');
            return redirect()->back();
        }
    }

    public function inactiveEbook(Request $request, $transaction = 0, $employeer = 0)
    {
        try {
            DB::beginTransaction();

            $transactionMember = TransactionMember::where('id', $transaction)->first();

            $totalDecrementPv = Ebook::where('id', $transactionMember->ebook_id)->first()->pv ?? 0;

            $employeer = Employeer::where('id', $employeer)->decrement('pv', $totalDecrementPv);

            $updateTransationMember = TransactionMember::where('id', $transaction)->delete();

            if(!$updateTransationMember || !$employeer) {
                DB::rollBack();
                redirect()->back();
                return;
            }

            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function htmlAction($row)
    {
        switch($row->status) {
            case 1:
                $show = \Auth::guard('admin')->user()->hasPermission('Members.view') ? '<a href="'.route('members.show',$row->id).'" class="btn btn-primary fa fa-eye" title="Detail"></a>' : '';
                $edit = \Auth::guard('admin')->user()->hasPermission('Members.edit') ? '<a href="'.route('members.edit-data',$row->id).'" class="btn btn-warning fa fa-pencil" title="Edit"></a>' : '';
                $delete = \Auth::guard('admin')->user()->hasPermission('Members.nonactive') ? '<a data-id="'.$row->id.'" class="btn btn-danger fa fa-power-off nonactive-member" title="Nonactive"></a>' : '';
                return $show.' '.$edit.' '.$delete;
            break;

            case 0:
                $show = \Auth::guard('admin')->user()->hasPermission('Members.view') ? '<a href="'.route('members.show',$row->id).'" class="btn btn-primary fa fa-eye" title="Detail"></a>' : '';
                $edit = \Auth::guard('admin')->user()->hasPermission('Members.edit') ? '<a href="'.route('members.edit-data',$row->id).'" class="btn btn-warning fa fa-pencil" title="Edit"></a>' : '';
                $delete = \Auth::guard('admin')->user()->hasPermission('Members.nonactive') ? '<a data-id="'.$row->id.'" class="btn btn-success fa fa-check-square active-member" title="Active"></a>' : '';
                return $show.' '.$edit.' '.$delete;
            break;

        }

    }

    public function getStatusInfoTransaction($data)
    {
        switch($data->info) {
            case 1;
            return 'Credit';
            break;

            case 0;
            return 'Debit';
            break;

        }
    }

    public function getStatusPayment($data)
    {
        switch($data->status) {
            case 0;
            return 'Failed';
            break;

            case 1;
            return 'Success';
            break;

            case 6;
            return 'Pending';
            break;
        }
    }

    public function export(Request $request)
    {
        // echo 'Total memory usage : ' . (memory_get_usage() - $begin);
        $to_date = date('Y-m-d',strtotime($request->to . "+1 days"));

        return Excel::download(new MembersExport($request->from, $to_date), now() .' ' .'members.xlsx');
    }

}
