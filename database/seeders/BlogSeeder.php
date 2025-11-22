<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Get all bloggers
        $bloggers = User::where('role', 'blogger')->get();

        // Create 10 blogs, assign to a random blogger
        Blog::factory()->count(10)->make()->each(function ($blog) use ($bloggers) {
            $blog->user_id = $bloggers->random()->id;
            $blog->save();
        });
    }
}
