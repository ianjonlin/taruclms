<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgrammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programme')->insert([
            [
                'type' => 'Bachelor Degree',
                'code' => 'RSD',
                'title' => 'Bachelor of Information Technology (Honours) in Software Systems Development',
            ], [
                'type' => 'Bachelor Degree',
                'code' => 'RIT',
                'title' => 'Bachelor of Information Technology (Honours) in Internet Technology',
            ], [
                'type' => 'Bachelor Degree',
                'code' => 'RIS',
                'title' => 'Bachelor of Information Technology (Honours) in Information Security',
            ], [
                'type' => 'Bachelor Degree',
                'code' => 'REI',
                'title' => 'Bachelor of Information Systems (Honours) in Enterprise Information Systems',
            ], [
                'type' => 'Bachelor Degree',
                'code' => 'RST',
                'title' => 'Bachelor of Computer Science (Honours) in Interactive Software Technology',
            ], [
                'type' => 'Bachelor Degree',
                'code' => 'RSF',
                'title' => 'Bachelor of Computer Science (Honours) in Software Engineering',
            ], [
                'type' => 'Bachelor Degree',
                'code' => 'RDS',
                'title' => 'Bachelor of Computer Science (Honours) in Data Science',
            ]
        ]);
    }
}
