<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;

class Register extends ModalComponent
{
    public $email;
    public $username;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'email' => 'required|email',
        'username' => 'required',
        'password' => 'required|required_with:password_confirmation'
    ];

    public function register()
    {
        $credentials = $this->validate();
        $credentials['password'] = Hash::make($credentials['password']);

        $user = User::create($credentials);   
        Auth::login($user);
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.register');
    }
}
