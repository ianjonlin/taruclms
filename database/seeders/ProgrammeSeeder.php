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
            'code' => 'RSD',
            'title' => 'Bachelor of Information Technology (Honours) in Software Systems Development',
        ]);
    }
}
