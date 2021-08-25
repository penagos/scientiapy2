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

    public function search($query)
    {
        return response()->json(Question::where('title', 'LIKE', '%'.$query.'%')->get()->map(function ($question) {
            return $question->title;
        }));
    }

    public function view($id)
    {
        return view('questions.view', [
            'question' => Question::findOrFail($id)
        ]);
    }
}
