<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
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
    public $newComment;

    protected $rules = [
        'post.content' => 'required|min:12'
    ];

    protected $messages = [
        'post.content.min' => 'Post must contain at least 12 characters.',
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

    public function edit()
    {
        $this->showPostEditor = true;
        $this->showEditor($this->post->content);
    }

    public function upvote()
    {
        ++$this->post->reputation;
        $this->post->save();
        $this->emit('renderPost', $this->post->id);
    }

    public function favorite()
    {
        // If previously favorited, unfavorite post.
        
    }

    public function downvote()
    {
        --$this->post->reputation;
        $this->post->save();
        $this->emit('renderPost', $this->post->id);
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
        $this->post->save();
        $this->post->edited_at = now();
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

    private function showEditor($contents)
    {
        $this->emit('createEditor', $this->editorID, $contents);
    }
}
