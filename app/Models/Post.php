<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function preview()
    {
        return substr(strip_tags($this->content), 0, 250);
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

    public function favoriters()
    {
        // Get a list of users who have favorited this post
        return Favorite::where(['post_id' => $this->id])->all();
    }

    public function isEdited()
    {
        return $this->edited_at ? true : false;
    }

    public function isFavoritedBy(User $user)
    {

    }

    public function isFavorited()
    {
        return Favorite::where('user_id', Auth::id())
            ->where('post_id', $this->id)
            ->first();
    }

    public function favorite()
    {
        Auth::user()->favorites()->toggle($this->id);
    }

    public function lastEditDate()
    {
        return $this->edited_at;
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
