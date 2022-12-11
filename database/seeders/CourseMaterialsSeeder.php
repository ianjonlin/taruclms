<?php

namespace Database\Seeders;

use Illuminate\Http\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cm_category')->insert([
            [
                'course_id' => 1,
                'name' => 'Tutorial Discussion'
            ], [
                'course_id' => 1,
                'name' => 'Course Files'
            ],
        ]);
    }
}
