<?php

namespace App\Http\Livewire;

use App\Models;
use Illuminate\Support\Str;
use Livewire\Component;

class Comment extends Component
{
    public $postID;
    public Models\Comment $comment;
    public $edit = false;
    public $editorID;

    protected $rules = [
        'comment.content' => 'required|min:12',
        'comment.post_id' => 'required'
    ];

    protected $messages = [
        'comment.content.required' => 'Please enter a comment longer than 12 characters.',
        'comment.content.min' => 'Please enter a comment longer than 12 characters.'
    ];

    public function mount()
    {
        // The odds of this colliding with an existing editor on the page are quite small
        // If such a collision occurs, we'll just focus the wrong input
        $this->editorID = 'commentEditor'.Str::random();
    }

    public function comment()
    {
        $this->comment = new Models\Comment(['post_id' => $this->postID]);
        $this->edit();
    }

    public function edit()
    {
        $this->edit = true;
        $this->emit('focusInput', $this->editorID);
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
        return view('livewire.comment');
    }
}
