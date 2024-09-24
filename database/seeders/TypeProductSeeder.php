<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types_products')->insert([
            'description' => "Pastel",
        ]);
        DB::table('types_products')->insert([
            'description' => "Pastel Doce",
        ]);
        DB::table('types_products')->insert([
            'description' => "Refrigerantes",
        ]);
        DB::table('types_products')->insert([
            'description' => "Sucos",
        ]);
    }
}
