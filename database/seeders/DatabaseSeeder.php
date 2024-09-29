<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1000)->create();

//        $user = User::factory()->create([
//            'name' => 'bill',
//            'password' => '12345678',
//            'email' => 'bill80362@gmail.com',
//        ]);
        $user = new User();
        $user->remember_token = Str::random(10);
        $user->email_verified_at = now();
        $user->name = 'bill';
        $user->password = '12345678';
        $user->email = 'bill80362@gmail.com';
        $user->save();
        $user->permissions()->sync(Permission::get()->pluck("id"));
    }
}
