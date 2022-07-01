<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', ['users' => User::paginate(10)]);
    }

    public function view($id)
    {
        return view('users.view', [
            'user' => User::findOrFail($id),
            'questions' => Question::whereHas('post', function (Builder $query) use ($id) {
                $query->where('user_id', $id);
            })->paginate(10)
        ]);
    }

    public function teams()
    {
        return view('users.teams');
    }

    public function favorites()
    {
        // TODO: why does pagination not work on this relation?
        $favorites = Auth::user()->favoriteQuestions;
        return view('users.favorites', ['questions' => $favorites, 'user' => Auth::user()]);
    }

    public function settings()
    {
        return view('users.settings');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(request()->header('Referer'));
    }

    public function search($query)
    {
        // API request
        // TODO: some fuzzy search capability would be preferred
        return response()->json(User::where('username', 'LIKE', '%'.$query.'%')->get()->map(function ($user) {
            return $user->username;
        }));
    }

    public function login()
    {
        return 'TODO';
    }
}
