<?php

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutUs::insert([
            [
                'title' => 'VISION',
                'desc' => 'Educate and empower people to become Smart Traders.',
            ],
            [
                'title' => 'MISSION',
                'desc' => 'Revolutionize the Financial Educational Industry, with Bitrexgo as the vehicle which will bring people to change their lives, and the lives of others.',
            ],
        ]);
    }
}
