<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employeer;
use App\Models\Ebook;
use App\HistoryBitrexPoints;
use App\Models\TransactionMember;
use DataTables;
use Alert;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class MemberController extends Controller
{
    public function index(){
        if (request()->ajax()) {

            $data = Employeer::where('status', 1)
                             ->with('rank')
                             ->select('id','id_member','first_name','last_name','rank_id','phone_number','status');
                                    
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function($data) {
                        return $data->first_name.' '.$data->last_name;
                    })
                    ->editColumn('status', function($data) {
                        return $data->status == 1 ? 'Active' : 'Nonactive' ;
                    })
                    ->editColumn('hp', function($data) {
                        return $data->phone_number;
                    })
                    ->editColumn('rank', function($data) {
                        return $data->rank ? $data->rank->name : '-';
                    })
                    ->addColumn('action', function($row) {
                        return $this->htmlAction($row);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.members.active.index');
    }

    public function member_nonactive(){
        if (request()->ajax()) {
            $data = Employeer::where('status', 0)
                             ->with('rank')
                             ->select('id','id_member','first_name','last_name','rank_id','phone_number','status');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function($data) {
                        return $data->first_name.' '.$data->last_name;
                    })
                    ->editColumn('status', function($data) {
                        return $data->status == 1 ? 'Active' : 'Nonactive' ;
                    })
                    ->editColumn('hp', function($data) {
                        return $data->phone_number;
                    })
                    ->editColumn('rank', function($data) {
                        return $data->rank ? $data->rank->name : '-';
                    })
                    ->addColumn('action', function($row) {
                        return $this->htmlAction($row);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.members.nonactive.index');
    }


    public function create(){
     
        return view('admin.members.create');
    }

    public function nonactive($id){
        $data['status'] = 0;
        Employeer::findOrFail($id)->update($data);
        return redirect()->back(); 
    }
    
    public function active($id){
        $data['status'] = 1;
        Employeer::findOrFail($id)->update($data);
        return redirect()->back(); 
    }

    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required|unique:employeers|max:255',
            'first_name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6',
            'birthdate' => 'required',
            'nik' => 'required',
            'gender' => 'required',
            'parent_id' => 'required',
            'sponsor_id' => 'required'
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
            throw $e;
            DB::rollback();
            
            Alert::error('Gagal Menambah Data Member', 'Gagal');
            // return \redirect()->back();
        }
    }

    public function show($id)
    {
        $data = Employeer::with('ebooks.transactionMember')->findOrFail($id);

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
            'username' => 'max:255|unique:employeers'.$id,
            'first_name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'min:6',
            'birthdate' => 'required',
            'nik' => 'required',
            'gender' => 'required',
        ]);
        DB::beginTransaction();
        try{
            $data = Employeer::with('sponsor')->findOrFail($id);

            $data->nik = $request->nik;
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->birthdate = $request->birthdate;
            $data->npwp_number = $request->npwp_number;
            $data->is_married = $request->is_married;
            $data->gender = $request->gender;
            $data->phone_number = $request->phone_number;
            $data->no_rec = $request->no_rec;


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
            return redirect()->route('members.show', $data->id);
 
        }catch(\Exception $e){
            // throw $e;
            DB::rollback();
            
            Alert::error('Gagal Menambah Data Member', 'Gagal');
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
        $data = Employeer::findOrFail($id);
     
        return Datatables::of($data->point_histories)
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
            ->make(true);
    }

    public function historyCashData($id)
    {
        $data = Employeer::findOrFail($id);
     
        return Datatables::of($data->cash_histories)
            ->addIndexColumn()
            ->addColumn('nominal', function ($data) {
                return currency($data->nominal);
            })
            ->addColumn('info', function ($data) {
                return $this->getStatusInfoTransaction($data);
            })
            ->make(true);
    }

    public function historyMyPV($id)
    {
        $data = Employeer::with(('transaction_member.ebook'))->findOrFail($id);
        // return $data->load('transaction_member.ebook');
     
        return Datatables::of($data->transaction_member)
            ->addIndexColumn()
            ->addColumn('nominal', function ($data) {
                return currency($data->nominal);
            })
            ->addColumn('info', function ($data) {
                return $this->getStatusInfoTransaction($data);
            })
            ->make(true);
    }

    public function htmlAction($row)
    {
        switch($row->status) {
            case 1; 
            return '<a href="'.route('members.show',$row->id).'" class="btn btn-primary fa fa-eye" title="Detail"></a>
                    <a href="'.route('members.edit-data',$row->id).'" class="btn btn-warning fa fa-pencil" title="Edit"></a>
                    <a href="active/'.$row->id.'/nonactive" class="btn btn-danger fa fa-power-off" title="Nonactive"></a>';
            break;

            case 0;
            return '<a href="'.route('members.show',$row->id).'" class="btn btn-primary fa fa-eye" title="Detail"></a>
                    <a href="'.route('members.edit-data',$row->id).'" class="btn btn-warning fa fa-pencil" title="Edit"></a>
                    <a href="nonactive/'.$row->id.'/active" class="btn btn-success fa fa-check-square" title="Active"></a>';
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

}
