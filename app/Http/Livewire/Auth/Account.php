<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Hash;

class Account extends \App\Http\Livewire\BaseComponent
{

    public string $name;
    public string $surname;
    public string $phone;

    public string $password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'surname' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:20'],
    ];

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->surname = auth()->user()->surname;
        $this->phone = auth()->user()->phone;
    }

    public function update(): void
    {
        $validated = $this->validate();

        $this->queryWithResult( fn() => auth()->user()->update($validated) );
    }

    public function changePassword(): void
    {
        $this->validate([
            'password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'confirmed', 'min:8', 'max:50'],
        ]);

        $this->queryWithResult( fn() => auth()->user()->update(['password' => Hash::make($this->new_password)]) );
    }

    public function render()
    {
        return view('livewire.auth.account')->extends('layouts.app');
    }
}
