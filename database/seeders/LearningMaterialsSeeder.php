<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lm_category')->insert([
            [
                'course_id' => 1,
                'name' => 'Lecture Notes'
            ], [
                'course_id' => 1,
                'name' => 'Tutorial Questions'
            ], [
                'course_id' => 1,
                'name' => 'Practicals'
            ],
        ]);
    }
}
