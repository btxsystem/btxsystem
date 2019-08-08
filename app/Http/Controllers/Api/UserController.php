<?php
/**
 * SMS Console API
 *
 * PHP version 7.1
 *
 * @category Modules
 * @package  App
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;

/**
 * Module Users
 *
 * Module to manage user
 *
 * Table : users, roles
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class UserController extends Controller
{
    private $permission = "System.Users.";

    /**
     * Return all User
     *
     * @return json
     */
    public function index(Request $request)
    {
        $user  = Auth::guard('api')->user();

        // $user->hasPermission($this->permission . 'View');

        $roles_id       = $request->get('roles_id', false);
		$username	    = $request->get('username', false);
        $name           = $request->get('name', false);
        $keyword        = $request->get('q', false);

        $model = User::with('roles');

        if (!empty($username) && $username!="null") {
            $username = urldecode($username);
            $model->where('users.username', 'like', "%$username%");
        }

        if (!empty($name) && $name!="null") {
            $model->where('users.name', 'like', "%$name%");
        }

        if (!empty($roles_id) && $roles_id!="null") {
            $roles_id = urldecode($roles_id);
            $model->where('users.roles_id', '=', "$roles_id");
        }


        if (!empty($keyword) && $keyword!="null") {
            $keyword = urldecode($keyword);
            $model->where('users.name', 'LIKE', "%{$keyword}%");
        }

        $list = $model->orderBy('users.username', 'asc')->get();
        $list = $model->orderBy('username', 'asc')->get();
	

        return response()->json(['data' => $list], 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Create a new User
     *
     * @return json
     */
    public function create(Request $request)
    {
        $request->user()->hasPermission($this->permission . 'Create');

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required|unique:users|max:150',
            'password' => 'required',
            'roles_id' => 'required',
            'cabang_id' => 'required',
            'perusahaan_id' => 'required',
            // 'divisi_penjualan_id' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $model = new User;

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $result = $model::create($input);

        return response()->json(["status" => 200], 201);
    }

    /**
     * Update User
     *
     * @return json
     */
    public function update(Request $request, User $user)
    {
        $request->user()->hasPermission($this->permission . 'Edit');

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'username' => ['required', 'max:150', Rule::unique('users')->ignore($user->id)],
            'roles_id' => 'required',
            'cabang_id' => 'required',
            'perusahaan_id' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        } else {
            unset($input['password']);
        }
		
		

        $user->update($input);

        return response()->json(["status" => 200], 200);
    }

    /**
     * Delele User
     *
     * @return json
     */
    public function delete(Request $request, User $user)
    {
        $request->user()->hasPermission($this->permission . 'Delete');

        $user->delete();

        return response()->json(["status" => 200], 204);
    }

    /**
     * Create a new User
     *
     * @return json
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email',
            'phone'         => 'required|max:20',
            'bank_name'     => 'required|max:150',
            'bank_account'  => 'required|max:150',
            'username'      => 'required|unique:users|max:150',
            'password'      => 'required'
        ]);

        $input = $request->all();

        $validator->after(function ($validator) use ($input) {

            if (!empty($input['referral'])) {

                $checkReferral = User::where('username', trim($input['referral']))->get();

                if (count($checkReferral) < 1) {
                    $validator->errors()->add('referral', 'Referral tidak ditemukan!');
                }
            }
        });

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $model = new User;

        $input['password'] = bcrypt($input['password']);

        $result = $model::create($input);

        return response()->json(["status" => 200], 201);
    }

    /**
     * Update User Password
     *
     * @return json
     */
    public function password(Request $request)
    {
        //Log::debug(print_r($request->all(), true));
		
		
		$request->user()->hasPermission($this->permission . 'Edit');

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $user = $request->user();

        $avatar = $user->avatar;

        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');

            $avatar = uniqid() . '-' . time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/avatar/', $avatar);

            $input['avatar'] = $avatar;
        }

        $input['activation'] = 1;
        $input['password']   = bcrypt($request->get('password'));
		$input['email']      = $request->get('email');
		$input['phone']      = $request->get('mobile_no');

        $user->update($input);

        // update customer

        if ($request->user()->roles_id == 18) {

            $data = Validator::make($request->all(), [
                'alamat'    => 'required',
                'kode_pos'  => 'required',
                'mobile_no' => 'required',
                'email'     => 'required',
                'password'  => 'required|confirmed'
            ]);

            if ($data->fails()) {
                return response()->json(['error'=>$data->errors()], 400);
            }

            $update = Customers::find($request->user()->reff_id);
			
			if ($update) { 
                $update->alamat    = $request->get('alamat');
                $update->kode_pos  = $request->get('kode_pos');
                $update->mobile_no = $request->get('mobile_no');
                $update->email     = $request->get('email');
                $update->password  = bcrypt($request->get('password'));
				$update->save();
            };

        } 

        return response()->json(["status" => 200, "avatar" => $avatar], 200);
    }
}
