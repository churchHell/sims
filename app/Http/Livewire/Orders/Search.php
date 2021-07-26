<?php

namespace App\Http\Livewire\Orders;

use App\Models\{Order, Group};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;

class Search extends \App\Http\Livewire\BaseComponent
{

    use AuthorizesRequests;

    public int $groupId;
    public $sid;
    public array $items = [];
    public array $qtys = [];

    protected $listeners = ['remove'];

    protected $rules = [
        'sid' => ['required', 'integer', 'min:1']
    ];

    public function search()
    {
        $this->authorize('create', Order::class);

        $this->validate();

        if (Group::findOrFail($this->groupId)->orders()->whereSid($this->sid)->count() > 0) {
            $this->emitWarning('Товар с артикулом ' . $this->sid . ' уже есть в группе');
            return;
        }

        try {
            $item = itemRepository()->where('sid', $this->sid);
            $this->items = collect($this->items)->mapInto(Collection::class)->keyBy('sid')->put($item->get('sid'), $item)->toArray();
        } catch (\Exception $e) {
            $this->addError('sid', $e->getMessage());
            return;
        }

        $this->emitSuccess();
    }

    // Store new order
    public function store(int $sid): void
    {
        $this->authorize('create', Order::class);
        $this->validate(['qtys.' . $sid => ['required', 'integer', 'min:1']], [], ['qtys.' . $sid => 'количество']);

        $this->query(fn () => Group::findOrFail($this->groupId)
            ->orders()->create($this->items[$sid])
            ->users()->attach(auth()->id(), ['qty' => $this->qtys[$sid]]));

        $this->emitSuccess();
        $this->drop($sid);
    }

    public function remove(int $key): void
    {
        unset($this->items[$key]);
    }

    public function drop(int $sid): void
    {
        $this->remove($sid);
        unset($this->qtys[$sid]);
    }

    public function render()
    {
        return view('livewire.orders.search');
    }
}
