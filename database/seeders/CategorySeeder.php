<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
        'id' => 1,
        'name' => '優しい'
    ]);

    DB::table('categories')->insert([
        'id' => 2,
        'name' => '悲しい'
    ]);

    }
}
