<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            RanksTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            EmployeersTableSeeder::class,
            PermissionsTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RewardsTableSeeder::class,
            HistoryPvTableSeeder::class,
        ]);
    }
}
