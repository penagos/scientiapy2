<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class InlinePostEditor extends Component
{
    public $post;
    public $contents;
    public $id;
    public $fullEditorLink;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $contents, $fullEditorLink, $post)
    {
        $this->id = $id;
        $this->contents = $contents;
        $this->fullEditorLink = $fullEditorLink;
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inline-post-editor');
    }
}
