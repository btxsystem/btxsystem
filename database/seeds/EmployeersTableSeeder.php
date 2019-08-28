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
                'id_member'      => 'M1908000001',
                'username'      => 'Joshua',
                'first_name'     => 'Joshua',
                'last_name'       => 'D',
                'email'       => 'Joshua@jws.com',
                'password' => bcrypt('password'),
                'birthdate' => '1990-04-15 19:13:32',
                'npwp_number' =>'00012822883',
                'is_married' => 1,
                'gender' => 1,
                'status' =>1,
                'phone_number' => '009338494948',
                'no_rec' => '12345678',
                'position' => null,
                'parent_id' => null,
                'sponsor_id' => null,
                'rank_id' => 0,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
                'bitrex_cash'  => 0,
                'bitrex_points' => 0,
                'pv' => 300,
                'is_update' => 1,
                'nik' => '12319203'
            ],
            [
                'id_member'      => 'M1908000002',
                'username'      => 'ErikSut',
                'first_name'     => 'Erik',
                'last_name'       => 'Sutiawan',
                'email'       => 'eriksut@jws.com',
                'password'=> bcrypt('password'),
                'birthdate' => '1998-05-07 19:13:32',
                'npwp_number' =>'00012822883',
                'is_married' => 1,
                'gender' => 1,
                'status' =>1,
                'phone_number' => '009338494948',
                'no_rec' => '12345678',
                'position' => 0,
                'parent_id' => 1,
                'sponsor_id' => 1,
                'rank_id' => 0,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
                'bitrex_cash'  => 0,
                'bitrex_points' => 0,
                'pv' => 300,
                'is_update' => 1,
                'nik' => '12319204'
            ],
            [
                'id_member'      => 'M1908000003',
                'username'      => 'Dadank',
                'first_name'     => 'Dadank',
                'last_name'       => 'Thea',
                'email'       => 'dadank@jws.com',
                'password'=> bcrypt('password'),
                'birthdate' => '1995-04-15 19:13:32',
                'npwp_number' =>'00012822883',
                'is_married' => 1,
                'gender' => 1,
                'status' =>1,
                'phone_number' => '009338494948',
                'no_rec' => '12345678',
                'position' => 2,
                'parent_id' => 1,
                'sponsor_id' => 1,
                'rank_id' => 0,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
                'bitrex_cash'  => 0,
                'bitrex_points' => 0,
                'pv' => 300,
                'is_update' => 1,
                'nik' => '12319205'
            ],
            [
                'id_member'      => 'M1908000004',
                'username'      => 'Rizal',
                'first_name'     => 'Rizal',
                'last_name'       => 'Thea',
                'email'       => 'rizal@jws.com',
                'password'=> bcrypt('password'),
                'birthdate' => '1994-04-15 19:13:32',
                'npwp_number' =>'00012822883',
                'is_married' => 1,
                'gender' => 0,
                'status' =>1,
                'phone_number' => '009338494948',
                'no_rec' => '12345678',
                'position' => 1,
                'parent_id' => 1,
                'sponsor_id' => 1,
                'rank_id' => 0,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
                'bitrex_cash'  => 0,
                'bitrex_points' => 0,
                'pv' => 300,
                'is_update' => 1,
                'nik' => '12319206'
            ],
        ];

        Employeer::insert($employee);
    }
}
