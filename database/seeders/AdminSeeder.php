<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@kostku.test'], // ganti sesuai kebutuhan
            [
                'name' => 'Admin Kostku',
                'email' => 'admin@kostku.test',
                'password' => Hash::make('password123'), // ganti jadi password kamu
                'role' => 'admin',
                'is_active' => true,
            ]
        );
    }
}
