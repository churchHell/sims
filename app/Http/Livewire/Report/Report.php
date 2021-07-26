<?php

namespace App\Http\Livewire\Report;

use App\Models\Group;

class Report extends \App\Http\Livewire\BaseComponent
{

    public int $group;
    public array $users = [];
    public array $orders = [];
    public $rate;

    protected array $rules = [
        'rate' => ['numeric', 'min:0']
    ];

    public function mount(int $group)
    {
        $this->group = $group;
        $this->users = Group::findOrFail($group)->orders
            ->reduce(fn($carry, $order) => $carry->push($order->users), collect() )
            ->collapse()
            ->each(fn($user) => $user->pivotParent = $user->pivot->pivotParent->toArray() )
            ->groupBy('id')
            ->toArray();
    }

    public function emitRate(): void
    {
        $this->validate();
        $this->emit('rate', $this->rate);
    }

    public function render()
    {
        return view('livewire.report.report')->extends('layouts.empty');
    }
}
