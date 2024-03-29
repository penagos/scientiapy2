<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id')->withTimeStamps();
    }

    public function favoriteQuestions()
    {
        return $this->hasManyThrough(Question::class, Favorite::class, 'user_id', 'post_id', 'id', 'post_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function questions()
    {
        return [];
    }

    public function answers()
    {
        return [];
    }

    public function upvotes()
    {
        return [];
    }

    public function downvotes()
    {
        return [];
    }

    public function votes()
    {
        return [];
    }
}
