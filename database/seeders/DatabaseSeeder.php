<?php

namespace Database\Seeders;

use App\Models\Listing;
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
         $user = User::factory()->create();
         $user2=User::factory()->create();
        // Create listings for the user
        Listing::factory()->count(10)->create([
            'user_id' => $user->id, // Associate with the user
        ]);
        Listing::factory()->count(10)->create([
            'user_id' => $user2->id, // Associate with the user
        ]);
         User::factory()->create([
            'name'=>'mradmin',
            'email'=>'mradmin@test.com',
            'is_admin'=>true,
         ]);
//namespace first letters capital mai xa bhaney automatch handinxa with the same path the path letters being in lowercase
   //    \App\Models\Listing::factory(20)->create(); //already seeded

    }
}
