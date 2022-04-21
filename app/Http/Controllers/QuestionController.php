<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
class QuestionController extends Controller
{
    const PAGINATION_FACTOR = 15;

    public function index(Request $request)
    {
        $orderBy = 'created_at';

        if ($order = $request->get('sort')) {
            if ($order == 'new') {
                $orderBy = 'created_at';
            } elseif ($order == 'hot') {
                $orderBy = 'created_at';
            } elseif ($order == 'unanswered') {
                $orderBy = 'accepted_post_id';
            }
        }

        $questions = Question::with('post')->orderByDesc($orderBy)->paginate(self::PAGINATION_FACTOR);
        return view('questions.index', ['questions' => $questions]);
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

    public function view(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        if ($request->has('sort')) {
            $question->sortAnswers($request->get('sort'));
        }

        return view('questions.view', ['question' => $question]);
    }

    public function edit($id)
    {
        return view('questions.edit', ['question' => Question::findOrFail($id)]);
    }
}
