<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Training;
use DataTables;

class TrainingController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Training::all('id','location','start_training','price','capacity','note','open');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a class="btn btn-warning fa fa-edit"></a>
                                <a class="btn btn-danger fa fa-trash"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.trainings.index');
    }
}
