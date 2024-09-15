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
        User::factory(1000)->create();

        User::factory()->create([
            'name' => 'bill',
            'password' => '12345678',
            'email' => 'bill80362@gmail.com',
        ]);
    }
}
