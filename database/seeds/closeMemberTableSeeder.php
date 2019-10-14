<?php

use Illuminate\Database\Seeder;

class closeMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('close_member')->insert(['is_close_member' => 0, 'created_at' => now(), 'updated_at' => now()]);
    }
}
