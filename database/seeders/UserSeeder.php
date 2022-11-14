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

            // Student Records - 6
            [
                'user_id' => '21SMR10291',
                'name' => 'Lin Yik Enn,Ian Jonathan',
                'email' => 'linyej-sm19@tarc.edu.my',
                'role' => 'Student',
                'password' => Hash::make('ianjonLin@26'),
                'programme' => 1,
            ], [
                'user_id' => '18SMD04749',
                'name' => 'Bruce Wayne',
                'email' => 'wayneb@tarc.edu.my',
                'role' => 'Student',
                'password' => Hash::make('Im^Batman76'),
                'programme' => 2,
            ], [
                'user_id' => '14SMB16489',
                'name' => 'Tom Matthew Hanker',
                'email' => 'hanktm@tarc.edu.my',
                'role' => 'Student',
                'password' => Hash::make('$TMHswag7'),
                'programme' => 5,
            ], [
                'user_id' => '21SMR0449',
                'name' => 'Haw Hok Ki',
                'email' => 'hawhki@tarc.edu.my',
                'role' => 'Student',
                'password' => Hash::make('162046d3'),
                'programme' => 1,
            ], [
                'user_id' => '21SMR01314',
                'name' => 'D. R. Kuppusamy',
                'email' => 'drkupmy@tarc.edu.my',
                'role' => 'Student',
                'password' => Hash::make('e1fa1b1b'),
                'programme' => 5,
            ], [
                'user_id' => '21SMR13513',
                'name' => 'Loo Liew Khang',
                'email' => 'loolng@tarc.edu.my',
                'role' => 'Student',
                'password' => Hash::make('650ab335'),
                'programme' => 1,
            ],


            // Lecturer Records - 12
            [
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
                'user_id' => 'p9357',
                'name' => 'Kwok Siah Le',
                'email' => 'nharith@tarc.edu.my',
                'role' => 'Lecturer',
                'password' => Hash::make('f6eee91e'),
                'programme' => null,
            ], [
                'user_id' => 'p7189',
                'name' => 'Nor Hajjah Fakhira binti Wan Innamul Aizat',
                'email' => 'norhazat@tarc.edu.my',
                'role' => 'Lecturer',
                'password' => Hash::make('bf5fc60e'),
                'programme' => null,
            ], [
                'user_id' => 'p3228',
                'name' => 'Muhamed Sukri Hassim bin Wan Azizan',
                'email' => 'muhamezan@tarc.edu.my',
                'role' => 'Lecturer',
                'password' => Hash::make('fc5144e9'),
                'programme' => null,
            ], [
                'user_id' => 'p5884',
                'name' => 'Anand Puspanathan a/l Sumisha',
                'email' => 'anandpsha@tarc.edu.my',
                'role' => 'Lecturer',
                'password' => Hash::make('48a825b8'),
                'programme' => null,
            ], [
                'user_id' => 'p1718',
                'name' => 'M. G. Mohanadas',
                'email' => 'mgmohaas@tarc.edu.my',
                'role' => 'Lecturer',
                'password' => Hash::make('f73f65ce'),
                'programme' => null,
            ], [
                'user_id' => 'p9728',
                'name' => 'P. Melinder',
                'email' => 'pmeliner@tarc.edu.my',
                'role' => 'Lecturer',
                'password' => Hash::make('17c4793f'),
                'programme' => null,
            ], [
                'user_id' => 'p1929',
                'name' => 'Kasi Shivraj a/l Pereira',
                'email' => 'kasisira@tarc.edu.my',
                'role' => 'Lecturer',
                'password' => Hash::make('9c6b365f'),
                'programme' => null,
            ], [
                'user_id' => 'p3880',
                'name' => 'Ooi Thur Kee',
                'email' => 'ooitkee@tarc.edu.my',
                'role' => 'Lecturer',
                'password' => Hash::make('2cd1c8f0'),
                'programme' => null,
            ], [
                'user_id' => 'p543',
                'name' => 'Betty Dee Niu Jan',
                'email' => 'bettyjan@tarc.edu.my',
                'role' => 'Lecturer',
                'password' => Hash::make('5310de87'),
                'programme' => null,
            ], [
                'user_id' => 'p1416',
                'name' => 'Welson Quak Pu Bong',
                'email' => 'welsonong@tarc.edu.my',
                'role' => 'Lecturer',
                'password' => Hash::make('b0acdf91'),
                'programme' => null,
            ],



            //Admin Records - 5
            [
                'user_id' => 'a1234',
                'name' => 'Selena Wong',
                'email' => 'wongse@tarc.edu.my',
                'role' => 'Admin',
                'password' => Hash::make('Admin123!'),
                'programme' => null,
            ], [
                'user_id' => 'a3737',
                'name' => 'Uthaya a/l Pragash',
                'email' => 'uthaash@tarc.edu.my',
                'role' => 'Admin',
                'password' => Hash::make('68556ad6'),
                'programme' => null,
            ], [
                'user_id' => 'a2045',
                'name' => 'Mohammed Hj Saiful bin Huzzaini',
                'email' => 'mohani@tarc.edu.my',
                'role' => 'Admin',
                'password' => Hash::make('f9218b39'),
                'programme' => null,
            ], [
                'user_id' => 'a9664',
                'name' => 'Su Ong Bing',
                'email' => 'suonng@tarc.edu.my',
                'role' => 'Admin',
                'password' => Hash::make('0a41ad15'),
                'programme' => null,
            ], [
                'user_id' => 'a6828',
                'name' => 'Nur Azuin binti Nor',
                'email' => 'nurazunor@tarc.edu.my',
                'role' => 'Admin',
                'password' => Hash::make('fe5e5b47'),
                'programme' => null,
            ],
        ]);
    }
}
