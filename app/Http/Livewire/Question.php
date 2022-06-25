<?php

namespace App\Http\Livewire;

use App\Mail\NewQuestion;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Question extends Component
{
    public Models\Question $question;
    public $post;
    public $tags;
    public $users;

    protected $rules = [
        'question.title' => 'required|min:12|max:255',
        'tags' => 'required',
        'users' => 'nullable',
        'post.content' => 'required'
    ];

    protected $messages = [
        'question.title.required' => 'Please enter a question title longer than 12 characters.',
        'question.title.min' => 'Please enter a question title longer than 12 characters.',
        'tags.required' => 'Please enter at least 1 tag.',
        'post.content.required' => 'Please enter a valid question.'
    ];

    public function mount() {
        if ($this->question->id) {
            $this->post = $this->question->post;

            // TODO: single source with livewire post mount logic
            $this->tags = [];
            foreach($this->question->tags as $tag) {
                array_push($this->tags, $tag->tag);
            }

            $this->users = [];
            foreach($this->question->users as $user) {
                array_push($this->users, $user->username);
            }
        } else {
            // Question poster is by default on the notify list
            $this->users = [Auth::user()->username];
        }
    }
    public function create()
    {
        $this->validate();

        DB::transaction(function () {
            $post = new Post(array_merge([
                'content' => $this->post['content'],
                'user_id' => Auth::user()->id
            ]));

            $post->save();
            $this->question->post_id = $post->id;
            
            $this->question->save();

            // Create tags as needed
            $columnsToUpdate = ['updated_at'];
            $explodedTags = explode(',', $this->tags);
            $questionTags = [];

            foreach($explodedTags as $key => $value) {
                // TODO: optimize into 1 UPSERT
                array_push($questionTags, Tag::updateOrCreate(['tag' => $value], ['tag' => $value], $columnsToUpdate)->id);
            }

            // TODO: single source with post editor
            $this->users = explode(',', strtolower($this->users));

            $getOrCreateUsers = function ($username) {
                return User::where('username', $username)->firstOrFail()->id;
            };
    
            $this->question->users()->sync(array_map($getOrCreateUsers, $this->users));

            // Attach to question
            $this->question->tags()->attach($questionTags, ['question_id' => $this->question->id]);
            $this->question->save();
        });
        
        return redirect()->to(route('questions.view', $this->question->id));
    }

    public function render()
    {
        return view('livewire.question');
    }
}
