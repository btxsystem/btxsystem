<?php

use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::insert([
            [
                'title' => 'Trading',
                'article' => 'Lorem imspus doler ismte',
                'slug' => str_slug('trading')
            ],
            [
                'title' => 'Trading Advanced',
                'article' => 'Lorem imspus doler ismte',
                'slug' => str_slug('trading-advanced')
            ],
        ]);
    }
}
