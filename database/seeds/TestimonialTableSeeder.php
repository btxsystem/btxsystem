<?php

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Testimonial::insert([
            [
                'name' => 'Den Nie Sularso',
                'desc' => 'I am very satisfied with the Web, make it easier to me to know about Trading and made me want to learn more, I am very satisfied with the Web, make it easier to me to know about Trading and made me want to learn more, I am very satisfied with the Web, make it easier to me to know about Trading and made me want to learn more. Thank you.',
            ],
            [
                'name' => 'Felio Wijoyo',
                'desc' => 'Great Web and interesting, making me instantly memorized and remember it. I so want to know more about trading on this web, Great Web and interesting, making me instantly memorized and remember it. I so want to know more about trading on this web, Great Web and interesting, making me instantly memorized and remember it. I so want to know more about trading on this web.',
            ],
            [
                'name' => 'Anastasia Mirna',
                'desc' => 'Web content in an attractive and transparent, making people ask questions and want to learn about the trading. could try I am interested, Web content in an attractive and transparent, making people ask questions and want to learn about the trading. could try I am interested, Web content in an attractive and transparent.'
            ],
        ]);
    }
}
