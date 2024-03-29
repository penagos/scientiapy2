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
use Illuminate\Mail\Markdown;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function preview()
    {
        return substr(strip_tags(Markdown::parse($this->content)), 0, 250);
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

    public function unaccept()
    {
        if ($this->question) {
            $this->question->accepted_post_id = null;
            $this->question->save();
        }
    }

    public function getQuestion()
    {
        if ($this->isQuestion()) {
            return Question::where('post_id', $this->id)->firstOrFail();
        } else {
            return $this->question;
        }
    }

    public function isQuestion()
    {
        return !$this->question;
    }

    public function isEdited()
    {
        return $this->edited_at ? true : false;
    }

    public function editUser()
    {
        return $this->belongsTo(User::class, 'edit_user_id');
    }

    public function isAuthor()
    {
        return Auth::check() && $this->user == Auth::user();
    }

    public function favorited()
    {
        return Auth::check() ? $this->hasOne(Favorite::class)->where('user_id', Auth::user()->id) : null;
    }

    public function favorite()
    {
        Auth::user()->favorites()->toggle($this->id);
    }

    public function upvote()
    {
        if ($this->vote) {
            $amount = $this->resetVote();
        } else {
            $amount = -1;
        }

        if ($amount < 0) {
            $vote = Vote::updateOrCreate(
                ['post_id' => $this->id, 'user_id' => Auth::user()->id],
                ['amount' => 1]
            );
            $this->increment('score', $vote->amount);

            // Also update cached user reputation
            $this->user->increment('reputation', $vote->amount);
        }
    }

    public function downvote()
    {
        if ($this->vote) {
            $amount = $this->resetVote();
        } else {
            $amount = 1;
        }

        if ($amount > 0) {
            $vote = Vote::updateOrCreate(
                ['post_id' => $this->id, 'user_id' => Auth::user()->id],
                ['amount' => -1]
            );

            $this->decrement('score', abs($vote->amount));

            // Also update cached user reputation
            $this->user->decrement('reputation', abs($vote->amount));
        }
    }

    public function upvoted()
    {
        return $this->vote_id && $this->vote->amount > 0;
    }

    public function downvoted()
    {
        return $this->vote_id && $this->vote->amount < 0;
    }

    public function vote()
    {
        return Auth::check() ? $this->hasOne(Vote::class)->where('user_id', Auth::user()->id) : null;
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

    private function resetVote()
    {
        $amount = $this->vote->amount;
        $this->vote->delete();

        if ($amount > 0) {
            $this->decrement('score', abs($amount));
            $this->user->decrement('reputation', abs($amount));
        } else {
            $this->increment('score', abs($amount));
            $this->user->increment('reputation', abs($amount));
        }

        return $amount;
    }
}
