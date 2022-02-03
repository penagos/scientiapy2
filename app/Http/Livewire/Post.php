<?php

namespace App\Http\Livewire;

use App\Models;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Post extends Component
{
    public Models\Post $post;
    public Models\Question $question;
    public $editLink;
    public $tags;
    public $showCommentPoster;
    public $showPostEditor;
    public $editorID;
    public $editorContents;
    public $newComment;

    protected $rules = [
        'post.content' => 'required|min:12',
        'post.question_id' => 'required|exists:questions,id',
        'tags' => 'nullable'
    ];

    protected $messages = [
        'post.content.required' => 'Post must contain at least 12 characters.',
        'post.content.min' => 'Post must contain at least 12 characters.'
    ];

    protected $listeners = [
        'save' => '$refresh',
        'acceptedAnswer' => 'acceptedAnswer'
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function mount($post = null)
    {
        if ($post) {
            $this->editorContents = $this->editorID . '-contents';
            $this->showCommentPoster = false;
            $this->showPostEditor = false;
            $this->editorID = 'postEditor' . $this->post->id;
        } else {
            $this->post = new Models\Post(['content' => '']);
            $this->post->question_id = $this->question->id;
            $this->editorID = 'answerPoster';
        }
    }

    public function edit()
    {
        $this->showPostEditor = true;
        $this->editLink = $this->post->editLink();
        $this->showEditor($this->post->content ?? '');
    }

    public function upvote()
    {
        $this->post->upvote();
    }

    public function favorite()
    {
        $this->post->favorite();
    }

    public function downvote()
    {
        $this->post->downvote();
    }

    public function accept()
    {
        // If there was a previously accepted answer, broadcast event to remove state
        if ($this->post->question->acceptedAnswer) {
            // This will cause an incessant number of DB queries but this is not the common
            // case. TODO: optimize duplicate queries away
            $this->emit('acceptedAnswer', $this->post->question->acceptedAnswer->id);
        }

        $this->post->accept();
    }

    public function acceptedAnswer($id)
    {
        if ($this->post->id == $id) {
            $this->post->refresh();
        }
    }

    public function delete()
    {
        // ..
    }

    public function cancelEdit()
    {
        $this->hideEditor();
    }

    public function save()
    {
        $this->cachedPost = $this->post->content;
        $this->validate();
        $this->post->edited_at = now();
        $this->post->user_id = $this->post->user_id || Auth::user()->id;
        $this->post->save();
    
        if ($this->post->isQuestion()) {
            $this->saveTags();
        }

        $this->hideEditor();
    }

    public function saveTags()
    {
        $q = $this->post->getQuestion();
        $tags = explode(',', strtolower($this->tags));

        $getOrCreateTags = function ($tag) {
            return Tag::firstOrCreate([
                'tag' => $tag
            ])->id;
        };

        $q->tags()->sync(array_map($getOrCreateTags, $tags));
    }

    public function hideEditor()
    {
        $this->showPostEditor = false;
        if ($this->post) {
            $this->emit('renderPost', 'postContainer'.$this->post->id);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('livewire.post');
    }

    private function showEditor($contents)
    {
        $this->emit('createEditor', $this->editorID, $contents);
    }
}
