<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'content'
    ];

    // TODO: make logged in user
    protected $attributes = [
        'user_id' => 1
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withDefault([
            'user_id' => 1
        ]);
    }

    public function preview()
    {
        return nl2br(substr(strip_tags($this->content), 0, 250));
    }

    public function date()
    {
        return $this->created_at;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function editLink()
    {
        if ($this->question) {
            return route('answers.edit', $this->id);
        } else {
            return route('questions.edit', Question::findByPost($this));
        }
    }
}
