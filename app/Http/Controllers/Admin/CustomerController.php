<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employeer;
use App\Customer\Customer;
use DataTables;
use Illuminate\Support\Facades\DB;

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

                    ->editColumn('password', function($data) {
                        return "*****";
                    })
                  
                    ->addColumn('action', function($row) {
                        return '<a href="customer/'.$row->id.'"  class="btn btn-primary fa fa-pencil" title="Edit"></a>
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

        $input['password'] = bcrypt($input['password']);

        Customer::create($input);

        return view('admin.customers.index');
    }

    public function delete($id) {

        $data = Customer::find($id);

        if ($data) { $data->delete(); }

        return redirect()->back()->with('alert', 'hapus data sukses');

    }

    public function show($id) {

        $data['data'] = array();

        $cust = Customer::find($id);

        if ($cust) { $data['data'] = $cust; }

        return view('admin.customers.create', $data);

    }





}
