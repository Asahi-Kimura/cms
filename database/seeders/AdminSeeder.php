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
            'kana' => '山田',
            'email' => 'admin@gmail.com',
            'phone_number' => '09012345678',
            'city' => '4',
            'address' => '4',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(60)
        ]);
    }
}
