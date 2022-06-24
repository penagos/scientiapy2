<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'post'
    ];

    public static function isa($post)
    {
        return is_a($post, Question::class);
    }

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }

    public function acceptedAnswer()
    {
        return $this->hasOne(Post::class, 'id', 'accepted_post_id');
    }

    public function answers()
    {
        // Bubble accepted answer to top first
        return $this->hasMany(Post::class)->with(['comments']);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function date()
    {
        return $this->post->date();
    }

    public function isAcceptedAnswer(Post $post)
    {
        return $this->acceptedAnswer && $post->id == $this->acceptedAnswer->id;
    }

    public function sortAnswers($type)
    {
        if ($type == 'hot') {
            $this->answers = $this->answers->sortByDesc('score');
        } elseif ($type == 'new') {
            $this->answers = $this->answers->sortByDesc('created_at');
        } elseif ($type == 'old') {
            $this->answers = $this->answers->sortBy('created_at');
        }
    }

    public static function findByPost($post)
    {
        return Question::where('post_id', $post->id)->firstOrFail();
    }
}
