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

    protected $messages = [
        'question.title.min|question.title.required' => 'Please enter a question title longer than 12 characters.',
        'question.post.content.required' => 'Please enter a valid question.'
    ];

    public function updated()
    {
        // ...
    }

    public function hydrate()
    {
        $this->emit('hydrateTypeahead');
    }

    public function submit()
    {
        $this->validate();
        $this->question->save();

        // Redirect user to new question

    }

    public function render()
    {
        return view('livewire.edit-question');
    }
}
