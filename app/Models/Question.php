<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Question extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }

    public function answers()
    {
        return $this->hasMany(Post::class, 'question_id', 'id');
    }

    public function asker()
    {
        return $this->post->user;
    }

    public function date()
    {
        return $this->post->date();
    }
}
