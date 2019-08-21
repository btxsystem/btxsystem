<?php

use Illuminate\Database\Seeder;
use App\Models\BookChapterLesson;

class BookChapterLessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookChapterLesson::insert([
            [
                'chapter_id' => 1,
                'title' => 'Mulai Basic',
                'content' => 'Lorems ipsum doler ismet',
                'type' => 'paragraph'
            ],
            [
                'chapter_id' => 2,
                'title' => 'Mulai Advanced',
                'content' => 'Lorems ipsum doler ismet',
                'type' => 'paragraph'
            ],
        ]);
    }
}
