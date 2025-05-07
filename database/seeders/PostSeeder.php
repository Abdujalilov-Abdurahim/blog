<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = DB::table('categories')->pluck('id');
        // Create 10 posts with random category IDs
        for ($i = 0; $i < 10; $i++) {
            DB::table('posts')->insert([
                'user_id' => 1, 
                'category_id' => $categoryIds->random(), 
                'title' => Str::random(10),
                'short_content' => Str::random(20),
                'body' => Str::random(50),
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
