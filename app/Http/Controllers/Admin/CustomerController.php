<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employeer;
use App\Customer\Customer;
use DataTables;
use Illuminate\Support\Facades\DB;
use Alert;
use Validator;

class CustomerController extends Controller
{
    public function index(){    
        if (request()->ajax()) {
            $data = Customer::all();

            return Datatables::of($data)
                    ->addIndexColumn()

                    ->editColumn('name', function($data) {
                        return $data->first_name.' '.$data->last_name;
                    })

                    ->editColumn('username', function($data) {
                        return $data->username;
                    })

                    ->editColumn('email', function($data) {
                        return $data->email;
                    })
                  
                    ->addColumn('action', function($row) {
                        return '<a href="'.route('customer.show',$row->id).'"  class="btn btn-primary fa fa-eye" title="Show"></a>
                                <a href="'.route('customer.edit',$row->id).'"  class="btn btn-warning fa fa-pencil" title="Edit"></a>
                                <a href="customer/data/'.$row->id.'" class="btn btn-danger fa fa-trash" title="Delete"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.customers.index');
    }

    public function create(){

        $data['data'] = array();

        return view('admin.customers.create', $data);
    }

    public function store(Request $request) {

        $input = $request->all();


        $cek = Customer::where('username', $input['username'])->first();

        if ($cek) {

            Alert::error('username Sudah Ada', 'Gagal');

            return redirect()->back();
        }
             


        $input['password'] = bcrypt($input['password']);

        $data = Customer::create($input);

        Alert::error('Gagal Add Data Customer', 'Gagal');

        return view('admin.customers.index');
    }

    public function show($id) {

        $data['data'] = array();

        $cust = Customer::findOrFail($id);

        if ($cust) { $data['data'] = $cust; }

        return view('admin.customers.detail', $data);

    }

    public function edit($id) {

        $data['data'] = array();

        $cust = Customer::findOrFail($id);

        if ($cust) { $data['data'] = $cust; }

        return view('admin.customers.create', $data);

    }

    public function update(Request $request, $id) {

        $cust = Customer::findOrFail($id);

        $request->validate([
            'username' => 'unique:non_members,username,'.$id,
        ]);

        $cust->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

        Alert::success('Sukses Update Data Customer', 'Sukses');

        return view('admin.customers.index');
    }

    public function delete($id) {

        $data = Customer::findOrFail($id);

        if ($data) { 
            $data->delete(); 
            Alert::success('Success Delete Data Customer', 'Success');
        } else {
            Alert::error('Gagal Delete Data Customer', 'Gagal');
        }

        return view('admin.customers.index');

    }







}
