<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($x = 0; $x <= 5; $x++){
        $i = random_int(1, 20);
        \App\Models\Post::factory()->
            has(\App\Models\Tag::factory()->count(3))->
            hasComments($i)->
            create();
        }

        for ($x = 0; $x <= 100; $x++) {
        $post = \App\Models\Post::all()->random();
        $comment = \App\Models\Comment::all()->where('commentable_id', $post->id)
            ->where('parent_id', NULL)
            ->random();

        \App\Models\Comment::factory()->
            state([
                'commentable_id' => $post->id,
                'parent_id' => $comment->id,
                'commentable_type' => 'App\Models\Post',
            ])->
            create();
        }
    }
}
