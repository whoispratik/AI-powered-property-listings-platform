<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create(); i have seeded already
//namespace first letters capital mai xa bhaney automatch handinxa with the same path the path letters being in lowercase
       \App\Models\Listing::factory(20)->create(); //already seeded
    }
}
