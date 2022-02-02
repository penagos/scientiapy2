<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return view('questions.index', ['questions' => Question::with('post')->get()]);
    }

    public function ask()
    {
        return view('questions.edit', ['question' => new Question()]);
    }

    public function search($query)
    {
        // TODO: some fuzzy search capability would be preferred
        return response()->json(Question::where('title', 'LIKE', '%'.$query.'%')->get()->map(function ($question) {
            return $question->title;
        }));
    }

    public function view($id)
    {
        return view('questions.view', ['question' => Question::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('questions.edit', ['question' => Question::findOrFail($id)]);
    }
}
