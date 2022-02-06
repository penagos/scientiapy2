<?php

namespace App\Http\Controllers;

use App\Models\User;
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
