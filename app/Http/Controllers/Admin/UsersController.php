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
    public function index()
    {
        if (request()->ajax()) {
            $data = DB::table('users')->join('role_user','users.id','=','role_user.user_id')
                                      ->join('roles','role_user.role_id','=','roles.id')
                                      ->select('users.id','users.name','users.email','roles.title')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a href="/admin/admin-management/users/'. $row->id .'/edit" class="btn btn-warning fa fa-edit"></a>
                                <a onclick="deleteUser('. $row->id .')" class="btn btn-danger fa fa-trash"></a>';
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        Alert::success('Success add new user', 'Success');
        return redirect()->route('admin.admin-management.users.index');
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
}
