<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BreakingtimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'break_on' => '2024-3-6',
            'break_at' => '12:2:40',
            'breakover_at' => '12:56:18',
            'created_at' => '2024-3-6 12:2:40',
            'updated_at' => '2024-3-6 12:56:18',
        ];
        DB::table('breaktimes')->insert($param);
        $param = [
            'user_id' => 2,
            'break_on' => '2024-3-6',
            'break_at' => '13:6:12',
            'breakover_at' => '13:59:38',
            'created_at' => '2024-3-6 13:6:12',
            'updated_at' => '2024-3-6 13:59:38',
        ];
        DB::table('breaktimes')->insert($param);
        $param = [
            'user_id' => 3,
            'break_on' => '2024-3-6',
            'break_at' => '16:1:52',
            'breakover_at' => '16:55:58',
            'created_at' => '2024-3-6 16:1:52',
            'updated_at' => '2024-3-6 16:55:58',
        ];
        DB::table('breaktimes')->insert($param);   
    }
}
