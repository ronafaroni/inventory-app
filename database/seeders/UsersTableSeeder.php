<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'name' => 'admin',
            'password' => Hash::make('password123'),
            'email' => 'Jn7ZI@example.com',
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'username' => 'user',
            'name' => 'user',
            'password' => Hash::make('password123'),
            'email' => 'Jn8ZI@example.com',
            'role' => 'user',
        ]);
    }
}
