<?php

namespace App\Http\Livewire\Groups;

use App\Http\Livewire\BaseComponent;
use App\Jobs\OrdersToCartJob;
use App\Models\CartStatus;
use App\Models\Group;
use App\Services\CartService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Cart extends BaseComponent
{

    use AuthorizesRequests;

    public int $groupId;

    public $batch = 1;
    public $delay = 10;
    public bool $skipLoaded = false;

    public ?string $email = '';
    public ?string $password = 'nokia6600';

    public function mount (): void
    {
        $this->email = auth()->user()->cart_email;
    }

    public function send(): void
    {
        $with = $this->skipLoaded 
            ? ['orders' => fn($query) => $query->where('cart_status_id', '!=', CartStatus::ADDED)] 
            : 'orders';
        $group = Group::with($with)->findOrFail($this->groupId);
        
        $this->authorize('update', $group);
       
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'batch' => ['required', 'integer', 'min:1'],
            'delay' => ['required', 'integer', 'min:1'],
            'skipLoaded' => ['required', 'boolean'],
        ]);

        auth()->user()->update(['cart_email' => $this->email]);

        $this->emitTo('job-status', 'poll');

        try{
            OrdersToCartJob::dispatch($group->orders, $this->batch, $this->delay, new CartService($this->email, $this->password));
        } catch (Exception $e) {
            $this->addError('password', $e->getMessage());
            return;
        }
    }

    public function render()
    {
        return view('livewire.groups.cart');
    }
}
