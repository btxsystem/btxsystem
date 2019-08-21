<?php

use Illuminate\Database\Seeder;
use App\Reward;

class RewardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rewards = [
            [
                'Description'      => 'Uang tunai Rp 3 juta',
                'nominal'       => 3000000,
            ],
            [
                'Description'      => 'Liburan senilai Rp 5 juta',
                'nominal'       => 5000000,
            ],
            [
                'Description'      => 'Liburan senilai Rp 10 juta',
                'nominal'       => 10000000,
            ],
            [
                'Description'      => 'Liburan senilai Rp 35 juta',
                'nominal'       => 350000000,
            ],
            [
                'Description'      => 'Jam/City Car senilai Rp 150 juta',
                'nominal'       => 1500000000,
            ],
            [
                'Description'      => 'Luxury Car senilai Rp 500 juta',
                'nominal'       => 5000000000,
            ],
            [
                'Description'      => 'Sport Car/Apartment senilai 1M',
                'nominal'       => 10000000000,
            ],
            [
                'Description'      => 'Super Car/House senilai 4M',
                'nominal'       => 40000000000,
            ],

        ];

        Reward::insert($rewards);
    }
}
