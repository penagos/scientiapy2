<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
class QuestionController extends Controller
{
    const PAGINATION_FACTOR = 15;

    public function index()
    {
        return view('questions.index', ['questions' => Question::with('post')->orderByDesc('created_at')->paginate(self::PAGINATION_FACTOR)]);
    }

    public function ask()
    {
        return view('questions.edit', ['question' => new Question()]);
    }

    public function search(Request $request)
    {
        // TODO: some fuzzy search capability would be preferred
        $query = $request->input('q');
        return view('questions.index', ['questions' => Question::where('title', 'LIKE', '%'.$query.'%')->paginate(self::PAGINATION_FACTOR)]);
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
