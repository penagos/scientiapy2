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

    protected $with = [
        
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
        return $this->hasMany(Post::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function asker()
    {
        $s = $this->post;
        return $this->post->user;
        //return $this->hasOneThrough(User::class, Post::class);
    }

    public function date()
    {
        return $this->post->date();
    }

    public function isAcceptedAnswer(Post $post)
    {
        return $post == $this->acceptedAnswer();
    }

    public static function findByPost($post)
    {
        return Question::where('post_id', $post->id)->firstOrFail();
    }
}
