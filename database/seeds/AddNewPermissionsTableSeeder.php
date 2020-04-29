<?php

use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AddNewPermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name'      => 'List_va',
            ],
            [
                'name'      => 'Birthdate',
            ],
            [
                'name'      => 'Birthdate.add',
            ],
            [
                'name'      => 'Birthdate.edit',
            ],
            [
                'name'      => 'Birthdate.delete',
            ],
            [
                'name'      => 'Members.export',
            ],
            [
                'name'      => 'Members.refund',
            ],
            [
                'name'      => 'Members.edit_password',
            ],

        ];

        foreach ($roles as $role) {
            $id_role = DB::table('permissions')->insertGetId([
                'name' => $role['name']
            ]);

            DB::table('permission_role')->insert([
                'role_id' => 1,
                'permission_id' => $id_role
            ]);       
        }

    }
}
