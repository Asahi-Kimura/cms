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
            'prefecture_id' => '1',
            'name' => 'yamada',
            'kana' => 'ヤマダ',
            'email' => 'admin@gmail.com',
            'phone_number' => '090-1234-5678',
            'post_code' => '222-2222',
            'city' => '4',
            'address' => '4',
            'password' => Hash::make('password'),
            // 'remember_token' => Str::random(60)
        ]);
        DB::table('prefectures')->insert([ 
            ['prefecture_name' => 'hokkaido'],
            ['prefecture_name' => 'aomori'],
            ['prefecture_name' => 'iwate'],
            ['prefecture_name' => 'miyagi'],
            ['prefecture_name' => 'akita'],
            ['prefecture_name' => 'yamagata'],
            ['prefecture_name' => 'fukushima'],
            ['prefecture_name' => 'ibaraki'],
            ['prefecture_name' => 'tochigi'],
            ['prefecture_name' => 'gunma'],
            ['prefecture_name' => 'saitama'],
            ['prefecture_name' => 'chiba'],
            ['prefecture_name' => 'tokyo'],
            ['prefecture_name' => 'kanagawa'],
            ['prefecture_name' => 'niigata'],
            ['prefecture_name' => 'yamanashi'],
            ['prefecture_name' => 'nagano'],
            ['prefecture_name' => 'toyama'],
            ['prefecture_name' => 'ishikawa'],
            ['prefecture_name' => 'fukui'],
            ['prefecture_name' => 'gifu'],
            ['prefecture_name' => 'shizuoka'],
            ['prefecture_name' => 'aichi'],
            ['prefecture_name' => 'mie'],
            ['prefecture_name' => 'shiga'],
            ['prefecture_name' => 'kyoto'],
            ['prefecture_name' => 'osaka'],
            ['prefecture_name' => 'hyogo'],
            ['prefecture_name' => 'nara'],
            ['prefecture_name' => 'wakayama'],
            ['prefecture_name' => 'tottori'],
            ['prefecture_name' => 'shimane'],
            ['prefecture_name' => 'oakayama'],
            ['prefecture_name' => 'hiroshima'],
            ['prefecture_name' => 'yamaguchi'],
            ['prefecture_name' => 'tokushima'],
            ['prefecture_name' => 'kagawa'],
            ['prefecture_name' => 'ehime'],
            ['prefecture_name' => 'kochi'],
            ['prefecture_name' => 'fukuoka'],
            ['prefecture_name' => 'saga'],
            ['prefecture_name' => 'nagasaki'],
            ['prefecture_name' => 'kumamoto'],
            ['prefecture_name' => 'oita'],
            ['prefecture_name' => 'miyazaki'],
            ['prefecture_name' => 'kagoshima'],
            ['prefecture_name' => 'okinawa'],
            
            ['prefecture_chinese_name' => '北海道'],
            ['prefecture_chinese_name' => '青森'],
            ['prefecture_chinese_name' => '岩手'],
            ['prefecture_chinese_name' => '宮城'],
            ['prefecture_chinese_name' => '秋田'],
            ['prefecture_chinese_name' => '山形'],
            ['prefecture_chinese_name' => '福島'],
            ['prefecture_chinese_name' => '茨城'],
            ['prefecture_chinese_name' => '栃木'],
            ['prefecture_chinese_name' => '群馬'],
            ['prefecture_chinese_name' => '埼玉'],
            ['prefecture_chinese_name' => '千葉'],
            ['prefecture_chinese_name' => '東京'],
            ['prefecture_chinese_name' => '神奈川'],
            ['prefecture_chinese_name' => '新潟'],
            ['prefecture_chinese_name' => '山梨'],
            ['prefecture_chinese_name' => '長野'],
            ['prefecture_chinese_name' => '富山'],
            ['prefecture_chinese_name' => '石川'],
            ['prefecture_chinese_name' => '福井'],
            ['prefecture_chinese_name' => '岐阜'],
            ['prefecture_chinese_name' => '静岡'],
            ['prefecture_chinese_name' => '愛知'],
            ['prefecture_chinese_name' => '三重'],
            ['prefecture_chinese_name' => '滋賀'],
            ['prefecture_chinese_name' => '京都'],
            ['prefecture_chinese_name' => '大阪'],
            ['prefecture_chinese_name' => '兵庫'],
            ['prefecture_chinese_name' => '奈良'],
            ['prefecture_chinese_name' => '和歌山'],
            ['prefecture_chinese_name' => '鳥取'],
            ['prefecture_chinese_name' => '島根'],
            ['prefecture_chinese_name' => '岡山'],
            ['prefecture_chinese_name' => '広島'],
            ['prefecture_chinese_name' => '山口'],
            ['prefecture_chinese_name' => '徳島'],
            ['prefecture_chinese_name' => '香川'],
            ['prefecture_chinese_name' => '愛媛'],
            ['prefecture_chinese_name' => '高知'],
            ['prefecture_chinese_name' => '福岡'],
            ['prefecture_chinese_name' => '佐賀'],
            ['prefecture_chinese_name' => '長崎'],
            ['prefecture_chinese_name' => '熊本'],
            ['prefecture_chinese_name' => '大分'],
            ['prefecture_chinese_name' => '宮崎'],
            ['prefecture_chinese_name' => '鹿児島'],
            ['prefecture_chinese_name' => '沖縄'],
        ]);
    }
}
