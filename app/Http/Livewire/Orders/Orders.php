<?php

namespace App\Http\Livewire\Orders;

use DB;
use App\Models\{Group, Order};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Orders extends \App\Http\Livewire\BaseComponent
{

    use AuthorizesRequests;

    public int $groupId;
    public array $filters = [
        'title' => '',
        'user' => '',
    ];

    protected $listeners = ['render'];

    public function updatePrice(int $id) : void
    {
        $order = Order::findOrFail($id);
        $this->authorize('refresh', $order);

        $item = itemRepository()->where('sid', $order->sid);
        $this->result($order->update(['price' => $item->get('price'), 'updated_at' => now()]));
    }

    public function render()
    {

        // $orders = Group::findOrFail($this->groupId)->orders()->with('users')
        //     ->where('name', 'like', '%'.$this->filters['title'].'%')
        //     ->whereHas('users', function($query){
        //         $query->where(DB::raw('concat(name," ",surname)'), 'like', '%'.$this->filters['user'].'%');
        //     })->get();

        $orders = Order::with('users')
            ->where('name', 'like', '%'.$this->filters['title'].'%')
            ->whereHas('users', function($query){
                $query->where(DB::raw('concat(name," ",surname)'), 'like', '%'.$this->filters['user'].'%');
            })->whereGroupId($this->groupId)->get();

        return view('livewire.orders.orders', compact('orders'));
    }
}
