<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InlinePostEditor extends Component
{
    public $contents;
    public $id;
    public $fullEditorLink;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $contents, $fullEditorLink)
    {
        $this->id = $id;
        $this->contents = $contents;
        $this->fullEditorLink = $fullEditorLink;
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
