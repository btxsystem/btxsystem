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
            $data = ActivityLog::all();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('admin.activity.index');
    }
}
