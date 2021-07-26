<?php

namespace App\Http\Livewire\Accounts;

use DB;
use App\Models\{Role, User};

class Accounts extends \App\Http\Livewire\BaseComponent
{

    public string $name = '';

    public function render()
    {
        return view('livewire.accounts.accounts', [
            'users' => User::where(DB::raw('concat(name," ",surname, " ",phone)'), 'like', '%' . $this->name . '%')->get(),
            'roles' => Role::all()
        ])->extends('layouts.app');
    }
}
