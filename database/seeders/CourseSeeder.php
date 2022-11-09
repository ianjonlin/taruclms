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
            [
                'code' => 'BAIT1173',
                'title' => 'IT Fundamentals',
                'cc_id' => 8
            ], [
                'code' => 'BACS1014',
                'title' => 'Problem Solving and Programming',
                'cc_id' => 10
            ], [
                'code' => 'BAMS1613',
                'title' => 'Probability and Statistics',
                'cc_id' => 14
            ], [
                'code' => 'BAIT1043',
                'title' => 'Systems Analysis and Design',
                'cc_id' => 16
            ], [
                'code' => 'BJEL1013',
                'title' => 'English for Tertiary Studies',
                'cc_id' => null
            ],

            [
                'code' => 'BAIT1023',
                'title' => 'Web Design and Development',
                'cc_id' => null
            ], [
                'code' => 'BACS2023',
                'title' => 'Object-Oriented Programming',
                'cc_id' => null
            ], [
                'code' => 'BJEL1023',
                'title' => 'Academic English',
                'cc_id' => null
            ],

            [
                'code' => 'BACS1053',
                'title' => 'Database Management',
                'cc_id' => null
            ], [
                'code' => 'BACS2093',
                'title' => 'Operating Systems',
                'cc_id' => null
            ], [
                'code' => 'BAMS1623',
                'title' => 'Discrete Mathematics',
                'cc_id' => null
            ], [
                'code' => 'BACS1113',
                'title' => 'Computer Organisation and Architecture',
                'cc_id' => null
            ],

            [
                'code' => 'BAIT2203',
                'title' => 'Human Computer Interaction',
                'cc_id' => null
            ], [
                'code' => 'BACS2063',
                'title' => 'Data Structures and Algorithms',
                'cc_id' => null
            ], [
                'code' => 'BACS2042',
                'title' => 'Research Methods',
                'cc_id' => null
            ], [
                'code' => 'BACS2053',
                'title' => 'Object-Oriented Analysis',
                'cc_id' => null
            ], [
                'code' => 'BACS2163',
                'title' => 'Software Engineering',
                'cc_id' => null
            ], [
                'code' => 'BAIT2113',
                'title' => 'Web Application Development',
                'cc_id' => null
            ],

            [
                'code' => 'BAIT2004',
                'title' => 'Fundamentals of Computer Networks',
                'cc_id' => null
            ], [
                'code' => 'BAIT3153',
                'title' => 'Software Project Management',
                'cc_id' => null
            ], [
                'code' => 'BAIT1093',
                'title' => 'Introduction to Computer Security',
                'cc_id' => null
            ],

            [
                'code' => 'BJEL2013',
                'title' => 'English for Career Preparation',
                'cc_id' => null
            ], [
                'code' => 'BAIT3173',
                'title' => 'Integrative Programming',
                'cc_id' => null
            ], [
                'code' => 'MPU-3113',
                'title' => 'Hubungan Etnik',
                'cc_id' => null
            ], [
                'code' => 'BMIT2164',
                'title' => 'Computer Networks',
                'cc_id' => null
            ], [
                'code' => 'BACS3183',
                'title' => 'Advanced Database Management',
                'cc_id' => null
            ], [
                'code' => 'BAIT2073 ',
                'title' => 'Mobile Application Development',
                'cc_id' => null
            ],

            [
                'code' => 'BMIT3094',
                'title' => 'Advanced Computer Networks',
                'cc_id' => null
            ], [
                'code' => 'BACS3033',
                'title' => 'Social and Professional Issues',
                'cc_id' => null
            ], [
                'code' => 'BAIT3113',
                'title' => 'System Administration',
                'cc_id' => null
            ], [
                'code' => 'BBFA1043',
                'title' => 'Principles of Accounting',
                'cc_id' => null
            ], [
                'code' => 'MPU-3232',
                'title' => 'Entrepreneurship',
                'cc_id' => null
            ], [
                'code' => 'BACS3403',
                'title' => 'Project I',
                'cc_id' => null
            ],

            [
                'code' => 'BACS3413',
                'title' => 'Project II',
                'cc_id' => null
            ], [
                'code' => 'MPU-3322',
                'title' => 'Contemporary Malaysian Issues',
                'cc_id' => null
            ], [
                'code' => 'MPU-3123',
                'title' => 'Tamadun Islam dan Asia',
                'cc_id' => null
            ],

            [
                'code' => 'BAIT305C',
                'title' => 'Industrial Training',
                'cc_id' => null
            ]
        ]);
    }
}
