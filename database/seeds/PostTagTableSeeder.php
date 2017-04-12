<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $post = Post::find(3);
        $post->tags()->attach([1, 2]);
    }
}
