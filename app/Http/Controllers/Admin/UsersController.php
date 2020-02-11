<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use DataTables;
use DB;
use Alert;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('backoffice');
    }
    public function index()
    {
        if (request()->ajax()) {
            $data = DB::table('users')->join('role_user','users.id','=','role_user.user_id')
                                      ->join('roles','role_user.role_id','=','roles.id')
                                      ->select('users.id','users.name','users.email','roles.title')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $edit = \Auth::guard('admin')->user()->hasPermission('Admin_management.user_company.roles.edit') ? '<a href="/backoffice/admin-management/users/'. $row->id .'/edit" class="btn btn-warning fa fa-edit"></a>' : '';
                        $delete = \Auth::guard('admin')->user()->hasPermission('Admin_management.user_company.roles.delete') ? '<a onclick="deleteUser('. $row->id .')" class="btn btn-danger fa fa-trash"></a>' : '';
                        return $edit.' '.$delete;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.users.index');
    }

    public function create()
    {
        $roles = Role::all()->pluck('title', 'id');
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'username' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $request['roles_id'] = $request->input('roles');
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        Alert::success('Success add new user', 'Success');
        return redirect()->route('admin-management.users.index');
    }

    public function edit($id)
    {
        $roles = Role::all()->pluck('title', 'id');
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.admin-management.users.index');
    }

    public function show(User $user)
    {
        abort_unless(\Gate::allows('user_show'), 403);

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy($id)
    {
        $roles = DB::table('role_user')->where('user_id',$id)->delete();
        $user = User::findOrFail($id)->delete();
        Alert::success('Success delete user', 'Success');
        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }

    public function memberDaily(){
        $datas = DB::table('employeers')->select(DB::raw('DAY(created_at) as tanggal'), DB::raw('count(id) as views'))
                                                ->where(DB::raw('MONTH(created_at)'),now()->month)->where('status',1)
                                                ->groupBy('tanggal')->get();
        $tmp_data = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($datas as $key => $data) {
            if ($data->tanggal != null) {
                switch ($data->tanggal) {
                    case '1':
                        $tmp_data[0] = $data->views;
                        break;
                    case '2':
                        $tmp_data[1] = $data->views;
                        break;
                    case '3':
                        $tmp_data[2] = $data->views;
                        break;
                    case '4':
                        $tmp_data[3] = $data->views;
                        break;
                    case '5':
                        $tmp_data[4] = $data->views;
                        break;
                    case '6':
                        $tmp_data[5] = $data->views;
                        break;
                    case '7':
                        $tmp_data[6] = $data->views;
                        break;
                    case '8':
                        $tmp_data[7] = $data->views;
                        break;
                    case '9':
                        $tmp_data[8] = $data->views;
                        break;
                    case '10':
                        $tmp_data[9] = $data->views;
                        break;
                    case '11':
                        $tmp_data[10] = $data->views;
                        break;
                    case '12':
                        $tmp_data[11] = $data->views;
                        break;
                    case '13':
                        $tmp_data[12] = $data->views;
                        break;
                    case '14':
                        $tmp_data[13] = $data->views;
                        break;
                    case '15':
                        $tmp_data[14] = $data->views;
                        break;
                    case '16':
                        $tmp_data[15] = $data->views;
                        break;
                    case '17':
                        $tmp_data[16] = $data->views;
                        break;
                    case '18':
                        $tmp_data[17] = $data->views;
                        break;
                    case '19':
                        $tmp_data[18] = $data->views;
                        break;
                    case '20':
                        $tmp_data[19] = $data->views;
                        break;
                    case '21':
                        $tmp_data[20] = $data->views;
                        break;
                    case '22':
                        $tmp_data[21] = $data->views;
                        break;
                    case '23':
                        $tmp_data[22] = $data->views;
                        break;
                    case '24':
                        $tmp_data[23] = $data->views;
                        break;
                    case '25':
                        $tmp_data[24] = $data->views;
                        break;
                    case '26':
                        $tmp_data[25] = $data->views;
                        break;
                    case '27':
                        $tmp_data[26] = $data->views;
                        break;
                    case '28':
                        $tmp_data[27] = $data->views;
                        break;
                    case '29':
                        $tmp_data[28] = $data->views;
                        break;
                    case '30':
                        $tmp_data[29] = $data->views;
                        break;
                    case '31':
                        $tmp_data[30] = $data->views;
                        break;
                }
            }
        }
        return response()->json($tmp_data, 200);
    }
}
