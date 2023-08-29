<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Administrateur',
                'email' => 'super@amin.com',
                'gender' => 'M',
                'role_id' => 1, // ID du rôle administrateur
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Administrateur',
                'email' => 'admin@amin.com',
                'gender' => 'M',
                'role_id' => 2, // ID du rôle administrateur
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Garde',
                'email' => 'garde@garde.com',
                'gender' => 'F',
                'role_id' => 3, // ID du rôle garde
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
