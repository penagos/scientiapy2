<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Question extends Component
{
    public Models\Question $question;

    protected $rules = [
        'question.title' => 'required|min:12|max:255',
        'question.post.content' => 'required'
    ];

    protected $messages = [
        'question.title.required' => 'Please enter a question title longer than 12 characters.',
        'question.title.min' => 'Please enter a question title longer than 12 characters.',
        'question.post.content.required' => 'Please enter a valid question.'
    ];

    public function create()
    {
        $this->validate();
        $this->question->post()->sync(['user_id' => Auth::user()->id, 'content' => $this->question->post['content']]);
        $this->question->save();
        
        return redirect()->to(route('questions.view', $this->question->id));
    }

    public function render()
    {
        return view('livewire.question');
    }
}
