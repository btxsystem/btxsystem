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
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = DB::table('roles')->select('id','title')->where('deleted_at','=',null)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a class="btn btn-warning fa fa-edit" href="'.route('admin-management.roles.edit',$row->id).'"></a>
                                <a class="btn btn-danger fa fa-trash" href="'.route('admin-management.roles.delete',$row->id).'"></a>';
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

    public function store(StoreRoleRequest $request)
    {
        abort_unless(\Gate::allows('role_create'), 403);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.admin-management.roles.index');
    }

    public function edit(Role $role)
    {
        abort_unless(\Gate::allows('role_edit'), 403);

        $permissions = Permission::all()->pluck('title', 'id');

        $role->load('permissions');

        return view('admin.roles.edit', compact('permissions', 'role'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        abort_unless(\Gate::allows('role_edit'), 403);

        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role)
    {
        abort_unless(\Gate::allows('role_show'), 403);

        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }

    public function destroy($id)
    {
        $hi = Role::findOrFail($id)->delete();
        return redirect()->route('admin.admin-management.roles.index');
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
            $datas = DB::table('permissions')->select('id','title')->limit(5)->get();
            foreach ($datas as $tag) {
                $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->title];
            }
        }else{
            $tags = DB::table('permissions')->select('id','title')->where('title', 'LIKE', '%'.$term.'%')->limit(5)->get();
            foreach ($tags as $tag) {
                $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->title];
            }
        }
        return \Response::json($formatted_tags);
    }
}
