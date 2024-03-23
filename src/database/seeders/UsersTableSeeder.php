<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '山田A太郎',
            'email' => 'aaa@aaa.com',
            'email_verified_at' => '2020-11-12 10:35:36',
            'password' => Hash::make('aaaa1234'),
            'created_at' => '2023-11-12 10:35:36',
            'updated_at' => '2023-11-12 10:35:36',
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '佐々木B太郎',
            'email' => 'bbb@bbb.com',
            'email_verified_at' => '2020-11-12 10:35:36',
            'password' => Hash::make('bbbb1234'),
            'created_at' => '2023-11-12 10:35:36',
            'updated_at' => '2023-11-12 10:35:36',
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '宮本C太郎',
            'email' => 'ccc@ccc.com',
            'email_verified_at' => '2020-11-12 10:35:36',
            'password' => Hash::make('cccc1234'),
            'created_at' => '2023-11-12 10:35:36',
            'updated_at' => '2023-11-12 10:35:36',
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '伊藤D太郎',
            'email' => 'ddd@ddd.com',
            'email_verified_at' => '2020-11-12 10:35:36',
            'password' => Hash::make('dddd1234'),
            'created_at' => '2023-11-12 10:35:36',
            'updated_at' => '2023-11-12 10:35:36',
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '塚原E太郎',
            'email' => 'eeee@eee.com',
            'email_verified_at' => '2020-11-12 10:35:36',
            'password' => Hash::make('eeee1234'),
            'created_at' => '2023-11-12 10:35:36',
            'updated_at' => '2023-11-12 10:35:36',
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '柳生F太郎',
            'email' => 'fff@fff.com',
            'email_verified_at' => '2020-11-12 10:35:36',
            'password' => Hash::make('ffff1234'),
            'created_at' => '2023-11-12 10:35:36',
            'updated_at' => '2023-11-12 10:35:36',
        ];
        DB::table('users')->insert($param);
    }
}
