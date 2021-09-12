<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class Login extends ModalComponent
{
    public $username;
    public $password;

    protected $rules = [
        'username' => 'required',
        'password' => 'required'
    ];

    public function authenticate()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            return redirect(request()->header('Referer'));
        }

        $this->addError('status', 'Invalid credentials entered. Please try again.');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
