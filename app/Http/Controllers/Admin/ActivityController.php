<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use DataTables;

class ActivityController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = ActivityLog::with('user')->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('status', function($data) {
                        if($data->status) {
                            return '<span class="label label-success">Success</span>';
                        }

                        return '<span class="label label-danger">Failed</span>';
                    })
                    ->addColumn('username', function($data) {
                        if($data->user != null) {
                            return $data->user->name;
                        }

                        return 'System';
                    })
                    ->rawColumns(['status'])
                    ->make(true);
        }

        return view('admin.activity.index');
    }
}
