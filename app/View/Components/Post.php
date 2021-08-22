<?php

namespace App\View\Components;

use App\Models\Question;
use Illuminate\View\Component;

class Post extends Component
{
    public $post;
    public $tags = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        if (is_a($post, Question::class)) {
            $this->post = $post->post;
            $this->tags = $post->tags;
        } else {
            $this->post = $post;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post');
    }
}
