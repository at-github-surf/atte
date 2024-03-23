<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkingtimesTableSeeder extends Seeder
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
            'work_on' => '2024-3-6',
            'working_at' => '8:56:36',
            'closing_at' => '18:3:46',
            'created_at' => '2024-3-6 8:56:36',
            'updated_at' => '2024-3-6 18:3:46',
        ];
        DB::table('workingtimes')->insert($param);
        $param = [
            'user_id' => 2,
            'work_on' => '2024-3-6',
            'working_at' => '8:43:3',
            'closing_at' => '18:36:25',
            'created_at' => '2024-3-6 8:43:3',
            'updated_at' => '2024-3-6 18:36:25',
        ];
        DB::table('workingtimes')->insert($param);
        $param = [
            'user_id' => 3,
            'work_on' => '2024-3-6',
            'working_at' => '13:23:23',
            'closing_at' => '20:46:45',
            'created_at' => '2024-3-6 13:23:23',
            'updated_at' => '2024-3-6 20:46:45',
        ];
        DB::table('workingtimes')->insert($param);
    }
}
