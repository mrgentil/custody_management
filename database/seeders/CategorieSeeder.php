<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorie_users')->insert([
            ['name' => 'VIP'],
            ['name' => 'Ordinaire'],
            ['name' => 'Militaire'],
            ['name' => 'Police'],
            ['name' => 'Autres'],
        ]);
    }
}
