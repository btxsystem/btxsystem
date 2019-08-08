<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'username'       => 'admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$cSILvNLIlNVWB2dUxN66cOvDqFT4/qKhvdqwgrhKfSjdGjaTPq266',
                'remember_token' => null,
                'fcm_token'      => null,
                'roles_id'       => 1,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
                'deleted_at'     => null,
            ],
            [
                'id'             => 2,
                'username'       => 'Erik',
                'name'           => 'Erik',
                'email'          => 'eriksutiawan97@gmail.com',
                'password'       => '$2y$10$imU.Hdz7VauIT3LIMCMbsOXvaaTQg6luVqkhfkBcsUd.SJW2XSRKO',
                'remember_token' => null,
                'fcm_token'      => null,
                'roles_id'       => null,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
                'deleted_at'     => null,
            ],
        ];

        $cek = User::find(1);

        if (!$cek) {
            User::insert($users);
        }
    }
}
