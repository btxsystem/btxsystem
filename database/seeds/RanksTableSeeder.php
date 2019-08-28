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
            ],
            [
                'name'      => 'Director 1',
                'pv_needed_left' => 12000,
                'pv_needed_midle' => 12000,
                'pv_needed_right' => 12000,
                'needed_sponsor' => 9,
            ],
            [
                'name'      => 'Director 2',
                'pv_needed_left' => 35000,
                'pv_needed_midle' => 35000,
                'pv_needed_right' => 35000,
                'needed_sponsor' => 12,
            ],
            [
                'name'      => 'Director 3',
                'pv_needed_left' => 110000,
                'pv_needed_midle' => 110000,
                'pv_needed_right' => 110000,
                'needed_sponsor' => 15,
            ],
            [
                'name'      => 'Chairman 1',
                'pv_needed_left' => 330000,
                'pv_needed_midle' => 330000,
                'pv_needed_right' => 330000,
                'needed_sponsor' => 18,
            ],
            [
                'name'      => 'Chairman 2',
                'pv_needed_left' => 1000000,
                'pv_needed_midle' => 1000000,
                'pv_needed_right' => 1000000,
                'needed_sponsor' => 21,
            ]
        ];

        Rank::insert($ranks);
    }
}
