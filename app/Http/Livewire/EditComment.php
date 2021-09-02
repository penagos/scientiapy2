<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class EditComment extends Component
{
    public Comment $comment;

    public function render()
    {
        return view('livewire.edit-comment');
    }
}
