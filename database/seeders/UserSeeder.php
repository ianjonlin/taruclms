<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'user_id' => '18SMD04749',
                'name' => 'Bruce Wayne',
                'email' => 'wayneb@tarc.edu.my',
                'role' => 'Student',
                'password' => Hash::make('Im^Batman76'),
                'programme' => 2,
            ], [
                'user_id' => '21SMR10291',
                'name' => 'Lin Yik Enn,Ian Jonathan',
                'email' => 'linyej-sm19@tarc.edu.my',
                'role' => 'Student',
                'password' => Hash::make('ianjonLin@26'),
                'programme' => 1,
            ], [
                'user_id' => '14SMB16489',
                'name' => 'Tom Matthew Hanker',
                'email' => 'hanktm@tarc.edu.my',
                'role' => 'Student',
                'password' => Hash::make('$TMHswag7'),
                'programme' => 5,
            ], [
                'user_id' => 'p0028',
                'name' => 'David Chong',
                'email' => 'davidc@tarc.edu.my',
                'role' => 'Lecturer',
                'password' => Hash::make('DCrocks#99'),
                'programme' => null,
            ], [
                'user_id' => 'p2541',
                'name' => 'Peter Griffin Alexander',
                'email' => 'alexandpg@tarc.edu.my',
                'role' => 'Lecturer',
                'password' => Hash::make('Lois@2403'),
                'programme' => null,
            ], [
                'user_id' => 'a1234',
                'name' => 'Selena Wong',
                'email' => 'wongse@tarc.edu.my',
                'role' => 'Admin',
                'password' => Hash::make('Admin123!'),
                'programme' => null,
            ]
        ]);
    }
}
