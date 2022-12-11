<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        DB::table('forum_post')->insert([
            [
                'course_id' => 1,
                'created_at' => '2022-11-29 15:28:04',
                'created_by' => 3,
                'title' => "What is IT?",
                'body' => "I don't understand what is IT, and why is it so important?",
            ], [
                'course_id' => 1,
                'created_at' => '2022-12-02 23:44:52',
                'created_by' => 6,
                'title' => "Do I really need to change my password often?",
                'body' => "I am lazy to change my password, and can't think of new passwords everytime...",
            ], [
                'course_id' => 1,
                'created_at' => '2022-12-09 09:09:09',
                'created_by' => 1,
                'title' => "Can machines and people live together?",
                'body' => "I really hope it happens like Sci-Fi movies.. I want to have a R2-D2 and a C3PO robot friend >.<",
            ],
        ]);

        DB::table('forum_reply')->insert([
            [
                'forum_id' => 1,
                'created_at' => '2022-11-29 15:38:04',
                'created_by' => 8,
                'body' => "Information technology (IT) involves the study and application of computers and any type of telecommunications that store, retrieve, study, transmit, manipulate data and send information. Information technology involves a combination of hardware and software that is used to perform the essential tasks that people need and use on an everyday basis.",
            ],[
                'forum_id' => 3,
                'created_at' => '2022-12-09 17:55:59',
                'created_by' => 2,
                'body' => "Me too! But I am terrified of them turning bad like Ultron in Marvel Avengers.",
            ],[
                'forum_id' => 3,
                'created_at' => '2022-12-11 11:11:11',
                'created_by' => 7,
                'body' => "Yes, I would want one too. The fact that machines and AI have unlock all sorts of possibilities, it is possible to have a robotic friend! But hope that there won't be a doomsday when machines take control over us humans...",
            ],
        ]);
    }
}
