<?php

use Illuminate\Database\Seeder;
use App\Models\BookChapter;

class BookChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookChapter::insert([
            [
                'book_id' => 1,
                'title' => 'Mulai',
            ],
            [
                'book_id' => 2,
                'title' => 'Mulai',
            ],
        ]);
    }
}
