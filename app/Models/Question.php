<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\Tag;

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
        return $this->hasMany(Post::class)->with(['comments', 'vote', 'favorited']);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function date()
    {
        return $this->post->date();
    }

    public function isAcceptedAnswer(Post $post)
    {
        return $post == $this->acceptedAnswer();
    }

    public function flattenTags()
    {
        return implode(',', $this->tags->map(function ($item, $key) {
            return $item->tag;
        })->toArray());
    }

    public static function findByPost($post)
    {
        return Question::where('post_id', $post->id)->firstOrFail();
    }
}
