<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id'
    ];

    // TODO: make logged in user   
    protected $attributes = [
        'user_id' => 1
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function date()
    {
        return $this->created_at;
    }

    public function isEdited()
    {
        return $this->edited_at ? true : false;
    }
}
