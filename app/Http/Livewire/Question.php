<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models;
use Livewire\Component;

class Question extends Component
{
    public Question $question;

    protected $rules = [
        'question.title' => 'required|min:12|max:255',
        'question.post.content' => 'required',
        'question.tags' => 'optional'
    ];

    protected $messages = [
        'question.title.required' => 'Please enter a question title longer than 12 characters.',
        'question.title.min' => 'Please enter a question title longer than 12 characters.',
        'question.post.content.required' => 'Please enter a valid question.'
    ];

    public function mount($question)
    {
        $this->question->load('post');
    }

    public function hydrate()
    {
        $this->emit('hydrateTypeahead');
    }

    public function submit()
    {
        $this->validate();

        $question = Models\Question::create($this->question);
        $post = Post::create($this->question['post']);
        $question->post_id = $post->id;
        $question->save();
        
        return redirect()->to(route('questions.view', $question->id));
    }

    public function render()
    {
        return view('livewire.question');
    }
}
