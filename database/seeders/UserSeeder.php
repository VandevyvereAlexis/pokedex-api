<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ADMIN
        User::create([
            'pseudo'            => 'Admin',
            'image'             => 'default.jpg',
            'email'             => 'admin@admin.fr',
            'email_verified_at' => now(),
            'password'          => Hash::make('Admin2024!'),
            'remember_token'    => Str::random(10),
            'role_id'           => 2,
        ]);

        // USER
        User::create([
            'pseudo'            => 'User',
            'image'             => 'default.jpg',
            'email'             => 'user@user.fr',
            'email_verified_at' => now(),
            'password'          => Hash::make('User2024!'),
            'remember_token'    => Str::random(10),
            'role_id'           => 1,
        ]);

        User::factory(20)->create();
    }
}
