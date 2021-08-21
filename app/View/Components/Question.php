<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Question extends Component
{
    public $question;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $question)
    {
        $this->type = $type;
        $this->question = $question;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if ($this->type == 'simple') {
            return view('components.question.simple');
        } else {
            return view('components.question.detailed');
        }
    }
}
