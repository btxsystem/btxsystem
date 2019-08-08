<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            //PermissionsTableSeeder::class,
            //RolesTableSeeder::class,
            RanksTableSeeder::class,
            //PermissionRoleTableSeeder::class,
            //UsersTableSeeder::class,
            //RoleUserTableSeeder::class,
            EmployeersTableSeeder::class,
        ]);
    }
}
