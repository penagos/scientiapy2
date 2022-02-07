<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Question extends Component
{
    public Models\Question $question;
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

    public function mount() {
        if ($this->question->id) {
            $this->post = $this->question->post;
        }
    }
    public function create()
    {
        $this->validate();
        $post = new Post(array_merge([
            'content' => $this->post['content'],
            'user_id' => Auth::user()->id
        ]));

        $post->save();
        $this->question->post_id = $post->id;
        $this->question->save();
        
        return redirect()->to(route('questions.view', $this->question->id));
    }

    public function render()
    {
        return view('livewire.question');
    }
}
