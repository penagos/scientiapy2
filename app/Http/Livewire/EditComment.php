<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class EditComment extends Component
{
    public Post $post;
    public Comment $comment;
    public $edit = false;

    protected $rules = [
        'comment.content' => 'required',
        'comment.post_id' => 'required'
    ];


    public function comment($pid)
    {
        $this->comment = new Comment(['post_id' => $pid]);
        $this->edit();
    }

    public function edit()
    {
        $this->edit = true;
    }

    public function cancelEdit()
    {
        $this->edit = false;
    }

    public function save()
    {
        $this->validate();

        if ($this->comment->id) {
            $this->comment->edited_at = now();
        }

        $this->comment->save();
        $this->edit = false;
    }

    public function render()
    {
        return view('livewire.edit-comment');
    }
}
