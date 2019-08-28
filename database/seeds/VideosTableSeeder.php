<?php

use Illuminate\Database\Seeder;
use App\Models\Video;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::insert([
            [
                'title' =>'Video Dummy',
                'path' => 'videos/sample.mp4',
            ],
            [
                'title' =>'Video Dummy 2',
                'path' => 'videos/sample.mp4',
            ],
        ]);
    }
}
