<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\User as UserModel;

class User extends \App\Http\Livewire\BaseComponent
{

    public string $fullName;
    public array $orders = [];
    public $rate;

    protected $listeners = ['rate'];



    public function mount(array $userOrders)
    {
        $user = new UserModel($userOrders[0]);
        $this->fullName = $user->full_name;
        foreach($userOrders as $order){
            $this->orders[] = array_merge($order['pivot'], $order['pivotParent']);
        }
    }

    public function rate($rate): void
    {


        $this->rate = $rate;
    }

    public function render()
    {
        return view('livewire.report.user');
    }
}
