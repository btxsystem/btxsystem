<?php

use Illuminate\Database\Seeder;
use App\PvHistory;

class HistoryPvTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pv = [
            [
                'pv'             => 300,
                'pv_today'       => 300,
                'id_member'      => 1,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
            ],
            [
                'pv'             => 300,
                'pv_today'       => 300,
                'id_member'      => 2,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
            ],
            [
                'pv'             => 300,
                'pv_today'       => 300,
                'id_member'      => 3,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
            ],
            [
                'pv'             => 300,
                'pv_today'       => 300,
                'id_member'      => 4,
                'created_at'     => '2019-04-15 19:13:32',
                'updated_at'     => '2019-04-15 19:13:32',
            ],
        ];

        PvHistory::insert($pv);
    }
}
