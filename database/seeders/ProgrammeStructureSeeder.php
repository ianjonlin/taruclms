<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgrammeStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // RSD Programme Structure
        DB::table('programme_structure')->insert([
            [
                'programme_id' => 1,
                'course_id' => 1,
                'year' => 1,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 2,
                'year' => 1,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 3,
                'year' => 1,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 4,
                'year' => 1,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 5,
                'year' => 1,
                'sem' => 1
            ],

            [
                'programme_id' => 1,
                'course_id' => 6,
                'year' => 1,
                'sem' => 2
            ], [
                'programme_id' => 1,
                'course_id' => 7,
                'year' => 1,
                'sem' => 2
            ], [
                'programme_id' => 1,
                'course_id' => 8,
                'year' => 1,
                'sem' => 2
            ],

            [
                'programme_id' => 1,
                'course_id' => 9,
                'year' => 1,
                'sem' => 3
            ], [
                'programme_id' => 1,
                'course_id' => 10,
                'year' => 1,
                'sem' => 3
            ], [
                'programme_id' => 1,
                'course_id' => 11,
                'year' => 1,
                'sem' => 3
            ], [
                'programme_id' => 1,
                'course_id' => 12,
                'year' => 1,
                'sem' => 3
            ],

            [
                'programme_id' => 1,
                'course_id' => 13,
                'year' => 2,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 14,
                'year' => 2,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 15,
                'year' => 2,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 16,
                'year' => 2,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 17,
                'year' => 2,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 18,
                'year' => 2,
                'sem' => 1
            ],

            [
                'programme_id' => 1,
                'course_id' => 19,
                'year' => 2,
                'sem' => 2
            ], [
                'programme_id' => 1,
                'course_id' => 21,
                'year' => 2,
                'sem' => 2
            ],

            [
                'programme_id' => 1,
                'course_id' => 22,
                'year' => 2,
                'sem' => 3
            ], [
                'programme_id' => 1,
                'course_id' => 23,
                'year' => 2,
                'sem' => 3
            ], [
                'programme_id' => 1,
                'course_id' => 24,
                'year' => 2,
                'sem' => 3
            ], [
                'programme_id' => 1,
                'course_id' => 25,
                'year' => 2,
                'sem' => 3
            ], [
                'programme_id' => 1,
                'course_id' => 26,
                'year' => 2,
                'sem' => 3
            ], [
                'programme_id' => 1,
                'course_id' => 27,
                'year' => 2,
                'sem' => 3
            ],

            [
                'programme_id' => 1,
                'course_id' => 28,
                'year' => 3,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 29,
                'year' => 3,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 30,
                'year' => 3,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 31,
                'year' => 3,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 32,
                'year' => 3,
                'sem' => 1
            ], [
                'programme_id' => 1,
                'course_id' => 33,
                'year' => 3,
                'sem' => 1
            ],

            [
                'programme_id' => 1,
                'course_id' => 34,
                'year' => 3,
                'sem' => 2
            ], [
                'programme_id' => 1,
                'course_id' => 35,
                'year' => 3,
                'sem' => 2
            ], [
                'programme_id' => 1,
                'course_id' => 36,
                'year' => 3,
                'sem' => 2
            ],

            [
                'programme_id' => 1,
                'course_id' => 37,
                'year' => 3,
                'sem' => 3
            ],
        ]);
    }
}
