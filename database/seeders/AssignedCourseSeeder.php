<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignedCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assigned_course')->insert([
            [
                'lecturer_id' => 7,
                'course_id' => 1
            ], [
                'lecturer_id' => 7,
                'course_id' => 23
            ], [
                'lecturer_id' => 7,
                'course_id' => 30
            ], [
                'lecturer_id' => 7,
                'course_id' => 1
            ], [
                'lecturer_id' => 13,
                'course_id' => 1
            ], [
                'lecturer_id' => 18,
                'course_id' => 1
            ]
        ]);
    }
}
