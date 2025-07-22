<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'anup',
            'email' => 'anup@gmail.com',
            'password' => Hash::make('123123123'),
            'is_admin' => true,  // Assuming you have an is_admin boolean column on your users table
        ]);

        // Create normal user
        User::factory()->create([
            'name' => 'rammu',
            'email' => 'ram@gmail.com',
            'password' => Hash::make('123123123'),
            'is_admin' => false,  // normal user
        ]);
    }
}
