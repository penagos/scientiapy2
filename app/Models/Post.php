<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Question;
use App\Models\User;
use App\Models\Vote;
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

    protected $with = ['comments', 'question', 'user', 'vote', 'favorited'];

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function accept()
    {
        if ($this->question) {
            $this->question->accepted_post_id = $this->id;
            $this->question->save();
        }
    }

    public function isEdited()
    {
        return $this->edited_at ? true : false;
    }

    public function isAcceptedAnswer()
    {
        return $this->question && $this->question->accepted_post_id == $this->id;
    }

    public function isAuthor()
    {
        return $this->user_id == Auth::user()->id;
    }

    public function favorited()
    {
        return $this->hasOne(Favorite::class)->where('user_id', Auth::user()->id ?? 0);
    }

    public function favorite()
    {
        Auth::user()->favorites()->toggle($this->id);
        $this->load('favorited');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function voteCount()
    {
        return $this->votes()->sum('amount');
    }

    public function upvote()
    {
        // If previously down voted, reset to 0, otherwise increment by 1
        Vote::updateOrCreate(
            ['post_id' => $this->id, 'user_id' => Auth::user()->id],
            ['amount' => 1]
        );

        $this->load('vote');
    }

    public function downvote()
    {
        // If previously up voted, reset to 0, otherwise decrement by 1
        Vote::updateOrCreate(
            ['post_id' => $this->id, 'user_id' => Auth::user()->id],
            ['amount' => -1]
        );

        $this->load('vote');
    }

    public function upvoted()
    {
        return $this->vote && $this->vote->amount > 0;
    }

    public function downvoted()
    {
        return $this->vote && $this->vote->amount < 0;
    }

    public function vote()
    {
        return $this->hasOne(Vote::class)->where('user_id', Auth::user()->id ?? 0);
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
