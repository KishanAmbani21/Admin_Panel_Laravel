<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::create([
        //     "name"=>"Kishan Ambani",
        //     "email"=>"admin@admin.com",
        //     "password"=>Hash::make("password")
        // ]);

        $this->call(AdminSeeder::class);
    }
}
