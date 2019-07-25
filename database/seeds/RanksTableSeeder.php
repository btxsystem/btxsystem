<?php

use App\Rank;
use Illuminate\Database\Seeder;

class RanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ranks = [
            [
                'name'      => 'Platinum 1',
                'pv_needed_left' => 400,
                'pv_needed_midle' => 400,
                'pv_needed_right' => 400,
                'needed_sponsor' => 1,
            ],
            [
                'name'      => 'Platinum 2',
                'pv_needed_left' => 1200,
                'pv_needed_midle' => 1200,
                'pv_needed_right' => 1200,
                'needed_sponsor' => 3,
            ],
            [
                'name'      => 'Platinum 3',
                'pv_needed_left' => 4000,
                'pv_needed_midle' => 4000,
                'pv_needed_right' => 4000,
                'needed_sponsor' => 6,
            ]
        ];

        Rank::insert($ranks);
    }
}
