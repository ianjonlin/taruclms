<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course')->insert([
            'code' => 'BMIT3094',
            'title' => 'Advanced Computer Networks',
            'cc_id' => 5,
        ]);
    }
}
