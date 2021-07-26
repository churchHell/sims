<?php

namespace App\Http\Livewire\Auth;

use Hash;
use Auth;
use App\Http\Livewire\BaseComponent;
use App\Models\User;

class Register extends BaseComponent
{

    public $name = '';
    public $surname = '';
    public $phone = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'surname' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:20'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'max:50', 'confirmed'],
    ];

    public function store()
    {
        $data = $this->validate();

        $user = User::create([
            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $auth = Auth::attempt($data, true);

        return redirect()->route('index');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
