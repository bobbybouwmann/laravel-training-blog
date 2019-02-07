<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = factory(Post::class, 20)->create();

        $posts->each(function (Post $post) {
            $number = random_int(0, 5);

            factory(\App\Comment::class, $number)->create([
                'post_id' => $post->id,
            ]);
        });
    }
}
