<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Question;
use Illuminate\Http\Request;
use Livewire\Component;

class EditPost extends Component
{
    public Post $post;
    public $editLink;
    public $tags;
    public $showCommentPoster;
    public $showPostEditor;
    public $editorID;
    public $editorContents;
    public $newComment;

    protected $rules = [
        'post.content' => 'required|min:12',
        'post.question_id' => 'required',
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
    public function mount($post = null, $qid = 0)
    {
        if ($post) {
            $this->editorContents = $this->editorID . '-contents';
            $this->showCommentPoster = false;
            $this->showPostEditor = false;
            $this->editorID = 'postEditor' . $this->post->id;
        } else {
            $this->post = new Post(['content' => '']);
            $this->post->question_id = $qid;
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
        // If previously favorited, unfavorite post.
        $this->post->favorite();
    }

    public function downvote()
    {
        $this->post->downvote();
    }

    public function accept()
    {
        // If there was a previously accepted answer, broadcast event to remove state
        if ($this->post->question->acceptedAnswer()) {
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

        $this->post->save();
        $this->post->edited_at = now();
        $this->hideEditor();
    }

    public function hideEditor()
    {
        $this->showPostEditor = false;
    }

    public function hydrate()
    {
        if ($this->post) {
            $this->emit('renderPost', $this->post->id);
        }
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
