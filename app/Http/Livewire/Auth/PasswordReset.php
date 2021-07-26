<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\BaseComponent;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordReset extends BaseComponent
{

    public string $token;
    public string $email;
    public string $password = '';
    public string $password_confirmation = '';

    protected $rules = [
        'token' => ['required', 'string'],
        'email' => ['required', 'email'],
        'password' => ['required', 'string', 'confirmed', 'min:8', 'max:50']
    ];

    public function update (): void
    {
        Password::reset($this->validate(), 
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password)
                ])->setRememberToken(Str::random(60));
    
                $this->result($user->save());
            }
        );

    }

    public function render()
    {
        return view('livewire.auth.password-reset');
    }
}
