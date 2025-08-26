<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin JMBMART',
            'email' => 'admin@jmbmart.com',
            'password' => Hash::make('password123'), // Gunakan hash agar aman
        ]);
    }
}
