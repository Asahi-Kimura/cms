<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            'authority' => 'admin',
            'name' => 'yamada',
            'kana' => 'ヤマダ',
            'email' => 'admin@gmail.com',
            'phone_number' => '090-1234-5678',
            'post_code' => '222-2222',
            'city' => '4',
            'address' => '4',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(60)
        ]);
    }
}
