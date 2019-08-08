<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;
use App\Models\RolesUser;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        // $admin_permissions = Permission::all();
        // Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        // $user_permissions = $admin_permissions->filter(function ($permission) {
        //     return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        // });
        // Role::findOrFail(2)->permissions()->sync($user_permissions);



        $data = Permission::all(); 


        foreach ($data as $key => $value) {
                RolesUser::insert([
                    'permission_id' => $value['id'],
                    'role_id'       => 1
                ]);
           
        }


    }
}
 