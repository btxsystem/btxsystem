<?php

use Illuminate\Database\Seeder;
use App\Models\VideoEbook;

class VideoEbookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VideoEbook::insert([
            [
                'video_id' => 1,
                'ebook_id' => 1,
            ],
            [
                'video_id' => 2,
                'ebook_id' => 2,
            ],
        ]);
    }
}
