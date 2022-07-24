<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
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

        $questions = Question::with(['post', 'tags'])->orderByDesc($orderBy)->paginate(self::PAGINATION_FACTOR);
        return view('questions.index', ['questions' => $questions]);
    }

    public function ask()
    {
        return view('questions.edit', ['question' => new Question()]);
    }

    public function search(Request $request)
    {
        $searchKeywords = $request->input('q');
        $tag = $request->input('tag');
        $titleSuffix = "";

        if ($tag) {
            // Attempt to find tag and pull questions with this tag. If the tag is
            // non-existant, redirect to the homepage
            try {
                $questions = Tag::where('tag', $tag)->firstOrFail()->questions();
            } catch (ModelNotFoundException $e) {
                return redirect()->route('');
            }
        } else {
            // TODO: this is an ugly query
            $searchQuery =  preg_split('/\s+/', $searchKeywords, -1, PREG_SPLIT_NO_EMPTY);
            $questions = Question::where(function ($q) use ($searchQuery) {
                                foreach ($searchQuery as $value) {
                                    $q->orWhere('title', 'LIKE', "%$value%");
                                }
                            })
                            ->orWhereHas('post', function ($q) use ($searchQuery) {
                                foreach ($searchQuery as $value) {
                                    $q->where('content', 'LIKE', "%$value%");
                                }
                            })
                            ->orWhereHas('tags', function ($q) use ($searchQuery) {
                                foreach ($searchQuery as $value) {
                                    $q->where('tag', $value);
                                }
                            });
        }

        // Append correct suffix to questions title for enhanced usability
        if (!empty($searchQuery)) {
            $titleSuffix = " matching \"$searchKeywords\"";
        } else if (!empty($tag)) {
            $titleSuffix = " tagged \"$tag\"";
        }

        return view('questions.index', [
            'questions' => $questions->paginate(self::PAGINATION_FACTOR),
            'titleSuffix' => $titleSuffix
        ]);
    }

    public static function getEloquentSqlWithBindings($query)
    {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
            return is_numeric($binding) ? $binding : "'{$binding}'";
        })->toArray());
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
