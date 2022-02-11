<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m = Question::factory(20)->create()->each(function ($question) {
            Post::factory(random_int(0, 5))->create(['question_id' => $question->id])->each(function ($answer) {
                Comment::factory(random_int(0, 4))->create(['post_id' => $answer->id]);
            });

            // Randomly accept an answer for some questions
        });

        // Update caches
        // TODO
    }
}
