<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'id' => 1,
            'body' => '命名はデータを基準に考える',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'category_id' => 1,
            'user_id' => 1
        ]);
         DB::table('posts')->insert([
            'id' => 2,
             'body' => '読めるようになれば怖くない',
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
             'category_id' => 2,
             'user_id' => 2
         ]);

    }
}
