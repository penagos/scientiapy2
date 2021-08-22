<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return view('questions.index', ['questions' => Question::all()]);
    }

    public function ask()
    {
        return view('questions.ask');
    }

    public function view($id)
    {
        return view('questions.view', [
            'question' => Question::findOrFail($id)
        ]);
    }
}
