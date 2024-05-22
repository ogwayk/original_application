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
            'id' => 1,
            'name' => 'おぐり',
            'email' => 'ogutaku@gmail.com',
            'password' => 'pasuwa-do',
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'たなか',
            'email' => 'tanaka@gmail.com',
            'password' => 'pasuwa-do',
        ]);
    }
}
