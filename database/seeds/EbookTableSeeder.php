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
                'price' => 5720000,
                'pv' => 100,
                'bv' => 5200000,
                'price_markup' => 1480000,
                'description' => 'Materi basic untuk mempermudah anda dalam tahap belajar forex.',
                'position' => 1
            ],
            [
                'title' => 'advanced',
                'price' => 5720000,
                'pv' => 100,
                'bv' => 5200000,
                'price_markup' => 1480000,
                'description' => 'Materi basic untuk mempermudah anda dalam tahap belajar forex.',
                'position' => 2
            ],
            [
                'title' => 'renewal_basic',
                'price' => 1430000,
                'pv' => 25,
                'bv' => 1300000,
                'price_markup' => 370000,
                'description' => 'Materi basic untuk mempermudah anda dalam tahap belajar forex.',
                'position' => 1
            ],
            [
                'title' => 'renewal_advanced',
                'price' => 1430000,
                'pv' => 25,
                'bv' => 1300000,
                'price_markup' => 370000,
                'description' => 'Materi basic untuk mempermudah anda dalam tahap belajar forex.',
                'position' => 2
            ]
        ]);
    }
}
