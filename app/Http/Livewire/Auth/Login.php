<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\BaseComponent;
use Livewire\Component;
use Auth;

class Login extends BaseComponent
{

    public $email;
    public $password;

    public function login()
    {
        $data = $this->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if(Auth::attempt($data, true)){
            return redirect()->route('index');
        }
        
        $this->addError('password', 'Неверный email или пароль.');

    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
