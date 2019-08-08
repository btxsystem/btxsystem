<?php

use Illuminate\Database\Seeder;
use App\Employeer;

class EmployeersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = [
            [
                'id_member'      => '001',
                'username'      => 'aang',
                'first_name'     => 'AANG',
                'last_name'       => 'Jojo',
                'email'       => 'Jojo@g.com',
                'password'=> bcrypt('password'),
                'birthdate' => '2019-04-15 19:13:32',
                'npwp_number' =>'00012822883',
                'is_married' => 1,
                'gender' => 0,
                'status' =>1,
                'phone_number' => '009338494948',
                'no_rec' => '12345678',
                'position' => null,
                'parent_id' => null,
                'sponsor_id' => null,
                'rank_id' => 1,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
                'bitrex_cash'  => 1000,
                'bitrex_points' => 5000,
                'pv' => 4000,
            ],
            [
                'id_member'      => '002',
                'username'      => 'abcaaa',
                'first_name'     => 'ABC',
                'last_name'       => 'DAD',
                'email'       => 'jiji@g.com',
                'password'=> bcrypt('password'),
                'birthdate' => '2019-04-15 19:13:32',
                'npwp_number' =>'00012822883',
                'is_married' => 1,
                'gender' => 0,
                'status' =>1,
                'phone_number' => '009338494948',
                'no_rec' => '12345678',
                'position' => 0,
                'parent_id' => 1,
                'sponsor_id' => 1,
                'rank_id' => 1,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
                'bitrex_cash'  => 1000,
                'bitrex_points' => 5000,
                'pv' => 4000,
            ],
            [
                'id_member'      => '003',
                'username'      => 'caca',
                'first_name'     => 'CCC',
                'last_name'       => 'lala',
                'email'       => 'nana@g.com',
                'password'=> bcrypt('password'),
                'birthdate' => '2019-04-15 19:13:32',
                'npwp_number' =>'00012822883',
                'is_married' => 1,
                'gender' => 1,
                'status' =>1,
                'phone_number' => '009338494948',
                'no_rec' => '12345678',
                'position' => 2,
                'parent_id' => 1,
                'sponsor_id' => 1,
                'rank_id' => 1,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
                'bitrex_cash'  => 1000,
                'bitrex_points' => 5000,
                'pv' => 4000,
            ],
            [
                'id_member'      => '004',
                'username'      => 'kkk',
                'first_name'     => 'lala',
                'last_name'       => 'Jo',
                'email'       => 'mimi@g.com',
                'password'=> bcrypt('password'),
                'birthdate' => '2019-04-15 19:13:32',
                'npwp_number' =>'00012822883',
                'is_married' => 1,
                'gender' => 0,
                'status' =>1,
                'phone_number' => '009338494948',
                'no_rec' => '12345678',
                'position' => 1,
                'parent_id' => 2,
                'sponsor_id' => 1,
                'rank_id' => 1,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
                'bitrex_cash'  => 1000,
                'bitrex_points' => 5000,
                'pv' => 4000,
            ],
        ];

        Employeer::insert($employee);
    }
}
