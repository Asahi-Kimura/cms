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
            [
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
            ],
            [
                'authority' => 'guest',
                'prefecture_id' => '3',
                'name' => 'toyota',
                'kana' => 'トヨタ',
                'email' => 'toyota@gmail.com',
                'phone_number' => '080-1134-5578',
                'post_code' => '992-2322',
                'city' => '5',
                'address' => '6',
                'password' => Hash::make('password'),
            ],
            [
                'authority' => 'guest',
                'prefecture_id' => '10',
                'name' => 'kimura',
                'kana' => 'キムラ',
                'email' => 'kimura@gmail.com',
                'phone_number' => '010-1434-5178',
                'post_code' => '002-8787',
                'city' => '1',
                'address' => '2',
                'password' => Hash::make('password'),
            ],
    ],
    );
        DB::table('prefectures')->insert([ 
            ['prefecture_name' => 'hokkaido','prefecture_chinese_name' => '北海道'],
            ['prefecture_name' => 'aomori','prefecture_chinese_name' => '青森県'],
            ['prefecture_name' => 'iwate','prefecture_chinese_name' => '岩手県'],
            ['prefecture_name' => 'miyagi','prefecture_chinese_name' => '宮城県'],
            ['prefecture_name' => 'akita','prefecture_chinese_name' => '秋田県'],
            ['prefecture_name' => 'yamagata','prefecture_chinese_name' => '山形県'],
            ['prefecture_name' => 'fukushima','prefecture_chinese_name' => '福島県'],
            ['prefecture_name' => 'ibaraki','prefecture_chinese_name' => '茨城県'],
            ['prefecture_name' => 'tochigi','prefecture_chinese_name' => '栃木県'],
            ['prefecture_name' => 'gunma','prefecture_chinese_name' => '群馬県'],
            ['prefecture_name' => 'saitama','prefecture_chinese_name' => '埼玉県'],
            ['prefecture_name' => 'chiba','prefecture_chinese_name' => '千葉県'],
            ['prefecture_name' => 'tokyo','prefecture_chinese_name' => '東京都'],
            ['prefecture_name' => 'kanagawa','prefecture_chinese_name' => '神奈川県'],
            ['prefecture_name' => 'niigata','prefecture_chinese_name' => '新潟県'],
            ['prefecture_name' => 'yamanashi','prefecture_chinese_name' => '山梨県'],
            ['prefecture_name' => 'nagano','prefecture_chinese_name' => '長野県'],
            ['prefecture_name' => 'toyama','prefecture_chinese_name' => '富山県'],
            ['prefecture_name' => 'ishikawa','prefecture_chinese_name' => '石川県'],
            ['prefecture_name' => 'fukui','prefecture_chinese_name' => '福井県'],
            ['prefecture_name' => 'gifu','prefecture_chinese_name' => '岐阜県'],
            ['prefecture_name' => 'shizuoka','prefecture_chinese_name' => '静岡県'],
            ['prefecture_name' => 'aichi','prefecture_chinese_name' => '愛知県'],
            ['prefecture_name' => 'mie','prefecture_chinese_name' => '三重県'],
            ['prefecture_name' => 'shiga','prefecture_chinese_name' => '滋賀県'],
            ['prefecture_name' => 'kyoto','prefecture_chinese_name' => '京都府'],
            ['prefecture_name' => 'osaka','prefecture_chinese_name' => '大阪府'],
            ['prefecture_name' => 'hyogo','prefecture_chinese_name' => '兵庫県'],
            ['prefecture_name' => 'nara','prefecture_chinese_name' => '奈良県'],
            ['prefecture_name' => 'wakayama','prefecture_chinese_name' => '和歌山県'],
            ['prefecture_name' => 'tottori','prefecture_chinese_name' => '鳥取県'],
            ['prefecture_name' => 'shimane','prefecture_chinese_name' => '島根県'],
            ['prefecture_name' => 'oakayama','prefecture_chinese_name' => '岡山県'],
            ['prefecture_name' => 'hiroshima','prefecture_chinese_name' => '広島県'],
            ['prefecture_name' => 'yamaguchi','prefecture_chinese_name' => '山口県'],
            ['prefecture_name' => 'tokushima','prefecture_chinese_name' => '徳島県'],
            ['prefecture_name' => 'kagawa','prefecture_chinese_name' => '香川県'],
            ['prefecture_name' => 'ehime','prefecture_chinese_name' => '愛媛県'],
            ['prefecture_name' => 'kochi','prefecture_chinese_name' => '高知県'],
            ['prefecture_name' => 'fukuoka','prefecture_chinese_name' => '福岡県'],
            ['prefecture_name' => 'saga','prefecture_chinese_name' => '佐賀県'],
            ['prefecture_name' => 'nagasaki','prefecture_chinese_name' => '長崎県'],
            ['prefecture_name' => 'kumamoto','prefecture_chinese_name' => '熊本県'],
            ['prefecture_name' => 'oita','prefecture_chinese_name' => '大分県'],
            ['prefecture_name' => 'miyazaki','prefecture_chinese_name' => '宮崎県'],
            ['prefecture_name' => 'kagoshima','prefecture_chinese_name' => '鹿児島県'],
            ['prefecture_name' => 'okinawa','prefecture_chinese_name' => '沖縄県'],
        ]);
    }
}
