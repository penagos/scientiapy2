<?php

namespace App\Http\Livewire;

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
        $this->validate();
    }

    public function render()
    {
        return view('livewire.login');
    }
}
