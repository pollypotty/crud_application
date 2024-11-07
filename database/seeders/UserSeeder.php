<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create an admin with Admin role
        $adminUser = User::create([
            'email' => 'admin@example.com',
            'name' => 'Ad Min',
            'password' => bcrypt('admin_pw'),
        ]);

        $adminUser->assignRole('Admin');

        // create a plain user with user role
        $plainUser = User::create([
            'email' => 'plain_user@example.com',
            'name' => 'Pl Ain',
            'password' => bcrypt('plain_user_pw'),
        ]);

        $plainUser->assignRole('User');
    }
}
