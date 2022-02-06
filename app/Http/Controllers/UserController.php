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
        return view('users.index', ['users' => User::all()]);
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
        return view('users.favorites');
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
}
