<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class PostAuthor extends Component
{
    public Post $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-author');
    }
}
