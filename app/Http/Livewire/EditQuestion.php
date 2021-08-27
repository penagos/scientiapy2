<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Question;
use Livewire\Component;

class EditQuestion extends Component
{
    public $question;
    public $post;

    protected $rules = [
        'question.title' => 'required|min:12|max:255',
        'post.content' => 'required'
    ];

    protected $messages = [
        'question.title.required' => 'Please enter a question title longer than 12 characters.',
        'question.title.min' => 'Please enter a question title longer than 12 characters.',
        'post.content.required' => 'Please enter a valid question.'
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

        $q = new Question($this->question);
        $q->post()->create($this->post);
        $q->save();

    }

    public function render()
    {
        return view('livewire.edit-question');
    }
}
