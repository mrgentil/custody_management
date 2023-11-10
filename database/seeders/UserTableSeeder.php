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
        \App\Models\User::factory(100)->create();
//        DB::table('users')->insert([
//            [
//                'name' => 'Super Administrateur',
//                'phone' => '+243812380589',
//                'address' => 'adresse 1',
//                'email' => 'super@amin.com',
//                'gender' => 'M',
//                'role_id' => 1, // ID du rôle administrateur
//                'category_id' => 1, // ID du category administrateur
//                'password' => Hash::make('password'),
//            ],
//            [
//                'name' => 'Administrateur',
//                'phone' => '+243812380589',
//                'address' => 'adresse 1',
//                'email' => 'admin@amin.com',
//                'gender' => 'M',
//                'role_id' => 2, // ID du rôle administrateur
//                'category_id' => 2, // ID du category administrateur
//                'password' => Hash::make('password'),
//            ],
//            [
//                'name' => 'Garde',
//                'phone' => '+243812380589',
//                'address' => 'adresse 1',
//                'email' => 'garde@amin.com',
//                'gender' => 'M',
//                'role_id' => 2, // ID du rôle administrateur
//                'category_id' => 2, // ID du category administrateur
//                'password' => Hash::make('password'),
//            ],
//        ]);
    }
}
