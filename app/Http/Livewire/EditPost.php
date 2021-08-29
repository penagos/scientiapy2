<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Question;
use Livewire\Component;

class EditPost extends Component
{
    public Post $post;
    public $editLink;
    public $tags = [];
    public $showCommentPoster;
    public $showPostEditor;
    public $editorID;
    public $editorContents;

    protected $rules = [
        'post.content' => 'required'
    ];

    protected $listeners = [
        'save' => '$refresh'
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function mount($post)
    {
        $this->editorID = 'postEditor'.$this->post->id;
        $this->editorContents = $this->editorID . '-contents';
        $this->showCommentPoster = false;
        $this->showPostEditor = false;
        $this->editLink = $this->post->editLink();
    }

    public function comment()
    {
        $this->showCommentPoster = true;
    }

    public function edit()
    {
        $this->showPostEditor = true;
        $this->emit('createEditor', $this->editorID, $this->post->content);
    }

    public function upvote()
    {
        // ...
    }

    public function downvote()
    {
        // ...
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
        $this->validate();
        $this->post->save();
        $this->hideEditor();
    }

    public function hideEditor()
    {
        $this->showPostEditor = false;
        $this->emit('renderPost', $this->post->id);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('livewire.edit-post');
    }
}
