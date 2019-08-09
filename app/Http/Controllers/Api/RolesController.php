<?php
/**
 * SMS Console API
 *
 * PHP version 7.1
 *
 * @category Modules
 * @package  App
 * @author   Asma <rijalmohamad.rijal@gmail.com
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebonsoftware
 */

/**
 * Module Roles
 *
 * Module to manage user roles
 *
 * Table : totp_logs, totp_modems
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   Asma <rijalmohamad.rijal@gmail.com
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebonsoftware
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Permissions;
use Validator;

class RolesController extends Controller
{
    private $permission = "System.Roles.";

    /**
     * Return all roles
     *
     * @return json
     */
    public function index(Request $request) 
    {
       
        // $user  = Auth::guard('api')->user();

        // $user->hasPermission($this->permission . 'View');


        $model = new Roles;

        $roles = $model::orderBy('title', 'asc')->get();

        foreach ($roles as $idx => $role) {

            kjenfkjcn3kofmlo,

            // $roles[$idx]->title = $role->permissions()->pluck('permission.id')->toArray();
        }

        return response()->json(['data' => $roles], 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Return specific roles
     *
     * @return json
     */
    public function show(Request $request, Roles $model)
    {
        $request->user()->hasPermission($this->permission . 'View');

        return $model;
    }

    /**
     * Create a new roles
     *
     * @return json
     */
    public function create(Request $request)
    {
        $request->user()->hasPermission($this->permission . 'Create');

        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles|max:150',
            'role_description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $model = new Roles;
        $result = $model::create($request->all());

        $roles = $model::find($result['id']);
        $roles->permissions()->attach($request->input('permissions'));

        return response()->json(["status" => 200], 201);
    }

    /**
     * Update roles
     *
     * @return json
     */
    public function update(Request $request, Roles $roles)
    {
        $request->user()->hasPermission($this->permission . 'Edit');

        $validator = Validator::make($request->all(), [
            'role_name' => ['required','max:150',Rule::unique('roles')->ignore($roles->id)],
            'role_description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $roles->update($request->all());

        $roles->permissions()->detach();
        $roles->permissions()->attach($request->input('permissions'));

        return response()->json(["status" => 200], 200);
    }

    /**
     * Delele roles
     *
     * @return json
     */
    public function delete(Request $request, Roles $roles)
    {
        $request->user()->hasPermission($this->permission . 'Delete');

        $roles->delete();

        return response()->json(["status" => 200], 204);
    }
}
