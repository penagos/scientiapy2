<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Question;
use App\Models\Tag;
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
            $accepted = false;

            Tag::all()->random(random_int(1, 5))->each(function ($tag) use ($question) {
                $question->tags()->attach($tag, [
                    'created_at' => now()
                ]);
            });

            Post::factory(random_int(0, 5))->create(['question_id' => $question->id])->each(function ($answer) use ($accepted, $question) {
                Comment::factory(random_int(0, 4))->create(['post_id' => $answer->id]);

                // Randomly accept an answer for some questions
                if (!$accepted && rand(0,5)) {
                    $question->accepted_post_id = $answer->id;
                    $question->save();
                    $accepted = true;
                }
            });
        });

        // Update caches
        // TODO
    }
}
