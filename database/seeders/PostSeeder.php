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
            
            'body' => '電車を出るときに譲ってくれる人',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'category_id' => 1,
            'user_id' => 1
        ]);
         DB::table('posts')->insert([
            
             'body' => '定時直前の作業依頼',
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
             'category_id' => 2,
             'user_id' => 2
         ]);

    }
}
