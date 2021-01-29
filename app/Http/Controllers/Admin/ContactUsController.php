<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use DataTables;

class ContactUsController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $data = ContactUs::all();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function($data) {
                        return $data->name;
                    })
                    ->editColumn('email', function($data) {
                        return $data->email;
                    })
                    ->editColumn('message', function($data) {
                        return $data->message;
                    })
                    ->editColumn('created_at', function($data) {
                        return $data->created_at;
                    })
                    ->addColumn('action', function($data) {
                        return '<a onclick="deleteCont('. $data->id .')" class="btn btn-danger fa fa-trash"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.contact-us.index');
    }

    public function destroy($id)
    {
        $data = ContactUs::find($id)->delete();
        return $data ? 'success' : 'failed';
    }
}
