<?php

namespace App\Http\Livewire\Accounts;

use Livewire\Component;
use App\Models\{Role, User};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Account extends \App\Http\Livewire\BaseComponent
{

    use AuthorizesRequests;

    public User $user;
    public int $userId;
    public string $role;
    public Collection $roles;
 
    public function mount()
    {
        $this->userId = $this->user->id;
        $this->role = $this->user->role_id;
        $this->active = $this->user->active;
    }

    public function update(User $user): void
    {
        $this->can();

        $this->validate(['role' => ['required', 'integer', 'min:1', 'exists:roles,id']]);

        $this->queryWithResult( fn() => $user->findOrFail($this->userId)->role()->associate($this->role)->save() );
    }

    public function activate(User $user): void
    {
        $this->can();

        $this->queryWithResult(fn () => $user->findOrFail($this->userId)->toggle('active') );

        $this->user = $user->findOrFail($this->userId);
    }

    private function can() : void
    {
        $this->authorize('update', User::class);
    }

    public function render()
    {
        return view('livewire.accounts.account');
    }
}
