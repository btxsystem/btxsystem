<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;
use DataTables;

class PermissionsController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Permission::all('title');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('admin.permissions.index');
    }
}
