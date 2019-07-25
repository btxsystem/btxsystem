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
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$imU.Hdz7VauIT3LIMCMbsOXvaaTQg6luVqkhfkBcsUd.SJW2XSRKO',
                'remember_token' => null,
                'rank_id'        => null,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
                'deleted_at'     => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Erik',
                'email'          => 'eriksutiawan97@gmail.com',
                'password'       => '$2y$10$imU.Hdz7VauIT3LIMCMbsOXvaaTQg6luVqkhfkBcsUd.SJW2XSRKO',
                'remember_token' => null,
                'rank_id'        => 3,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
                'deleted_at'     => null,
            ],
        ];

        User::insert($users);
    }
}
