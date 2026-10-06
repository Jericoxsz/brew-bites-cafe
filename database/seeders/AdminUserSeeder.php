<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Brew Bites Admin',
            'email' => 'admin@brewandbites.com',
            'password' => Hash::make('admin12345'),
            'role' => 'admin'
        ]);
    }
}