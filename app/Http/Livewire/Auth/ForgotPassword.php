<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\BaseComponent;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends BaseComponent
{

    public bool $show = false;
    public bool $success = false;
    public string $email = '';


    protected $rules = [
        'email' => ['required', 'email', 'exists:users']
    ];

    public function send (): void
    {
        $validated = $this->validate();
        $status = Password::sendResetLink($validated);
        
        if($status === Password::RESET_LINK_SENT){
            $this->success = true;
        } else {
            $this->emitError();
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
