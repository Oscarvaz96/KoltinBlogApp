<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $posts = [];
          // Create 1author
          \App\Models\User::factory(1)->create()->each(function ($author) use (&$posts){

            // Seed the relation with 5 posts
            $posts = \App\Models\Post::factory(5)->make();
            $author->posts()->saveMany($posts);
            
        });
        //We created this foreach outside of the other each, so we can avoid O(n * 2)
        foreach($posts as $post){
            // Seed the relation with 5 comments
            $comments= \App\Models\Comment::factory(5)->make();
            $post->comments()->saveMany($comments);
        }
    }
}
