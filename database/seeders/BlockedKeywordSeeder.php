<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlockedKeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        DB::table('blocked_keywords')->insert([
            [
                'value' => "bad",
                'added_by' => 20,
                'added_at' => now("Asia/Kuala_Lumpur")->toDateTimeString()
            ], [
                'value' => "compromised",
                'added_by' => 20,
                'added_at' => now("Asia/Kuala_Lumpur")->toDateTimeString()
            ], [
                'value' => "ugly",
                'added_by' => 22,
                'added_at' => now("Asia/Kuala_Lumpur")->toDateTimeString()
            ],
        ]);
    }
}
