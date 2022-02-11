<?php

namespace App\View\Components;

use App\Models\Question;
use Illuminate\View\Component;

class UnansweredQuestions extends Component
{
    public $questions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->questions = Question::all()->random(5)->whereNull('accepted_post_id');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.unanswered-questions');
    }
}
