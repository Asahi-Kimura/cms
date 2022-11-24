<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        // User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
        ]);
        Contact::factory()->count(5)->create();
    }
}
