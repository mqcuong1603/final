<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'fullName' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'isAdmin' => true,
            'isActivated' => true,
            'isLocked' => false,
            'profilePicture' => 'default.jpg'
        ]);
    }
}