<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use DataTables;
use DB;

class UsersController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = DB::table('users')->join('role_user','users.id','=','role_user.user_id')
                                      ->join('roles','role_user.role_id','=','roles.id')
                                      ->select('users.name','users.email','roles.title')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a class="btn btn-warning fa fa-edit"></a>
                                <a class="btn btn-danger fa fa-trash"></a>';
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

    public function store(StoreUserRequest $request)
    {
        abort_unless(\Gate::allows('user_create'), 403);

        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_unless(\Gate::allows('user_show'), 403);

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_unless(\Gate::allows('user_delete'), 403);

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
