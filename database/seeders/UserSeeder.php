<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            
            'name' => 'おぐり',
            'email' => 'shourinzi524@gmail.com',
            'password' => bcrypt('223070'),
        ]);

        DB::table('users')->insert([
            
            'name' => 'たなか',
            'email' => 'tanaka@gmail.com',
            'password' => bcrypt('aiueo'),
        ]);
    }
}
