<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class EditComment extends Component
{
    public Comment $comment;
    public $showCommentEditor;

    protected $rules = [
        'comment.content' => 'required'
    ];

    public function mount($comment)
    {
        $this->showCommentEditor = false;
    }

    public function edit()
    {
        $this->showCommentEditor = true;
    }

    public function cancelEdit()
    {
        $this->showCommentEditor = false;
    }

    public function save()
    {
        $this->validate();
        $this->comment->edited_at = now();
        $this->comment->save();
        $this->showCommentEditor = false;
    }

    public function render()
    {
        return view('livewire.edit-comment');
    }
}
