<?php

use Illuminate\Database\Seeder;
use App\Models\OurHeadquarter;

class OurHeadquarterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OurHeadquarter::insert([
            [
                'title' => 'Bitrexgo',
                'desc' => 'Bitrexgo is one of the best education platform for Foreign Exchange Trading in Indonesia.',
                'created_at' => now()
            ]
        ]);
    }
}
