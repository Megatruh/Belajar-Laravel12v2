<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=> env('ADMIN_NAME'),
            'username'=>env('ADMIN_USERNAME'),
            'email'=>env('ADMIN_EMAIL'),
            'email_verified_at' => now(),
            'password'=>Hash::make(env('ADMIN_PASSWORD')),
            'remember_token' => Str::random(10),

        ]);

        User::factory(7)->create();
    }
}
