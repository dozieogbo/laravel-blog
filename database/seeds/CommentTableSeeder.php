<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $comment = new Comment([
            'message' => "When accessing the records for a model, you may wish to limit your results based on the absence of a relationship. For example, imagine you want to retrieve all blog posts that don't have any comments. To do so, you may pass the name of the relationship to the doesntHave method",
            'user_id' => 3,
            'post_id' => 3,
            'comment_id' => 1
        ]);
        $comment->save();

        $comment = new Comment([
            'message' => "If you need even more power, you may use the whereHas and orWhereHas methods to put 'where' conditions on your has queries. These methods allow you to add customized constraints to a relationship constraint, such as checking the content of a comment:",
            'user_id' => 3,
            'post_id' => 3,
            'comment_id' => 2
        ]);
        $comment->save();
    }
}
