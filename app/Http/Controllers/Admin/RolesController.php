<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Permission;
use App\Role;
use DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Alert;
use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\User;
use Exception;

class RolesController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = DB::table('roles')->select('id','title')->where('deleted_at','=',null)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $edit = \Auth::guard('admin')->user()->hasPermission('Admin_management.roles.edit') ? '<a class="btn btn-warning fa fa-edit" href="'.route('admin-management.roles.edit',$row->id).'"></a>' : '';
                        $delete = \Auth::guard('admin')->user()->hasPermission('Admin_management.roles.delete') ? '<a class="btn btn-danger fa fa-trash" onclick="deleteRole('.$row->id.')"></a>' : '';
                        return $row->id!=1 ? $edit.' '.$delete : '-';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.roles.index');
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'max:255|unique:roles|required',
                'permissions'=> 'required',
            ]);

            $data = [
                'title' => $request->title
            ];

            DB::beginTransaction();

            $role = Role::create($data);

            $rolePermissions = [];

            foreach ($request->permissions as $key => $permission) {
                //DB::table('permission_role')->insert(['role_id' => $role->id, 'permission_id' => $permission]);
                $convertPermission = (int) $permission;

                if($convertPermission != 'on' || $convertPermission > 0) {
                    $rolePermissions[] = [
                        'role_id' => $role->id,
                        'permission_id' => $convertPermission
                    ];
                }
            }

            $insertPermission = DB::table('permission_role')->insert($rolePermissions);

            if(!$insertPermission) {
                DB::rollback();
                Alert::error('Failed Create Data', 'Failed')->persistent("Close");
                return redirect()->route('admin-management.roles.index');
            }

            DB::commit();

            Alert::success('Sukses Create Data', 'Sukses')->persistent("Close");
            return redirect()->route('admin-management.roles.index');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Failed Create Data', 'Failed')->persistent("Close");
            return redirect()->route('admin-management.roles.index');
        }
    }

    public function edit($role)
    {
        $role = DB::table('roles')->where('id', $role)->first();
        return view('admin.roles.edit', compact('role'));
    }

    public function data($id){
        $role = DB::table('roles')->where('id', $id)->first();
        $permissions = DB::table('permission_role')->select('permission_id')->where('role_id', $role->id)->orderBy('role_id')->get();
        return $permissions;
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'max:255|unique:roles,title,'.$request->role_id,
        ]);
        $data = [
            'title' => $request->title
        ];
        $role = Role::where('id',$request->role_id)->update($data);
        DB::table('permission_role')->where('role_id', $request->role_id)->delete();
        foreach ($request->permissions as $key => $permission) {
            DB::table('permission_role')->insert(['role_id' => $request->role_id, 'permission_id' => $permission]);
        }
        Alert::success('Sukses Update Data', 'Sukses')->persistent("Close");
        return redirect()->route('admin-management.roles.index');
    }

    public function show(Role $role)
    {
        abort_unless(\Gate::allows('role_show'), 403);

        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }

    public function destroy($id)
    {
        try{
            Role::findOrFail($id)->delete();
            Alert::success('Sukses Deleted Data', 'Sukses')->persistent("Close");
            return redirect()->route('admin-management.roles.index');
        }catch(Exception $e){
            Alert::success('Cannot delete roles because it is being used by a user', 'Failed')->persistent("Close");
            return redirect()->route('admin-management.roles.index');
        }
    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }

    public function select(Request $request){
        $term = trim($request->q);
        $formatted_tags = [];
        if (empty($term)) {
            $datas = DB::table('permissions')->select('id','name')->get();
            foreach ($datas as $tag) {
                $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->name];
            }
        }else{
            $tags = DB::table('permissions')->select('id','name')->where('name', 'LIKE', '%'.$term.'%')->get();
            foreach ($tags as $tag) {
                $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->name];
            }
        }
        return \Response::json($formatted_tags);
    }
}
