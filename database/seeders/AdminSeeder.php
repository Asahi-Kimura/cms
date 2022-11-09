<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'phone_number1' => '09012345678',
            'phone_number1' => '1234',
            'phone_number1' => '5678',
            'city' => '4',
            'address' => '4',
            'password' => Hash::make('password'),
        ]);
    }
}
