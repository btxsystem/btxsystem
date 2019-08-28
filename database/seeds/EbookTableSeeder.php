<?php

use Illuminate\Database\Seeder;
use App\Models\Ebook;

class EbookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Ebook::insert([
            [
                'title' => 'basic',
                'price' => 100000,
                'pv' => 100,
                'bv' => 100,
                'price_markup' => 2000,
                'description' => 'Materi basic untuk mempermudah anda dalam tahap belajar forex.'
            ],
            [
                'title' => 'advanced',
                'price' => 100000,
                'pv' => 100,
                'bv' => 100,
                'price_markup' => 2000,
                'description' => 'Materi basic untuk mempermudah anda dalam tahap belajar forex.'
            ],
            [
                'title' => 'renewal_basic',
                'price' => 100000,
                'pv' => 100,
                'bv' => 100,
                'price_markup' => 2000,
                'description' => 'Materi basic untuk mempermudah anda dalam tahap belajar forex.'
            ],
            [
                'title' => 'renewal_advanced',
                'price' => 100000,
                'pv' => 100,
                'bv' => 100,
                'price_markup' => 2000,
                'description' => 'Materi basic untuk mempermudah anda dalam tahap belajar forex.'
            ]
        ]);
    }
}
