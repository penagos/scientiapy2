<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditQuestion extends Component
{
    public $question;

    protected $rules = [
        'question.title' => 'required|min:12|max:255',
        'question.post.content' => 'required'
    ];

    public function updated()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.edit-question');
    }
}
