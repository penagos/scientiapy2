<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class Post extends Component
{
    public $post;
    public $editLink;
    public $tags = [];

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

        $this->editLink = ''; //$this->post->editLink();
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
