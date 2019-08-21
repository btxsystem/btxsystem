<?php

use Illuminate\Database\Seeder;
use App\Models\BookEbook;

class BookEbookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookEbook::insert([
            [
                'book_id' => 1,
                'ebook_id' => 1,
            ],
            [
                'book_id' => 2,
                'ebook_id' => 2,
            ],
        ]);
    }
}
