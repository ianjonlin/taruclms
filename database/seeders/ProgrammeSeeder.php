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
                'code' => 'RSD',
                'title' => 'Bachelor of Information Technology (Honours) in Software Systems Development',
            ], [
                'code' => 'RIT',
                'title' => 'Bachelor of Information Technology (Honours) in Internet Technology',
            ], [
                'code' => 'RIS',
                'title' => 'Bachelor of Information Technology (Honours) in Information Security',
            ], [
                'code' => 'REI',
                'title' => 'Bachelor of Information Systems (Honours) in Enterprise Information Systems',
            ], [
                'code' => 'RST',
                'title' => 'Bachelor of Computer Science (Honours) in Interactive Software Technology',
            ], [
                'code' => 'RSF',
                'title' => 'Bachelor of Computer Science (Honours) in Software Engineering',
            ], [
                'code' => 'RDS',
                'title' => 'Bachelor of Computer Science (Honours) in Data Science',
            ]
        ]);
    }
}
