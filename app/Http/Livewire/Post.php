<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class Post extends Component
{
    public $post;
    public $editLink;
    public $tags = [];
    public $showCommentPoster;
    public $showPostEditor;
    public $editorID;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function mount($post)
    {
        if (is_a($post, Question::class)) {
            $this->post = $post->post;
            $this->tags = $post->tags;
        } else {
            $this->post = $post;
        }

        $this->editorID = 'postEditor'.$this->post->id;
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

    public function cancelEdit()
    {
        $this->showPostEditor = false;
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
}
