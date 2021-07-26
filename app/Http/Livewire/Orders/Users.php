<?php

namespace App\Http\Livewire\Orders;

use App\Http\Livewire\BaseComponent;
use App\Models\Order;
use App\Models\Pivots\OrderUser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Users extends BaseComponent
{

    use AuthorizesRequests;

    public Order $order;
    public int $orderId;
    public ?int $qty = null;
    public array $qtys = [];
    public int $pivotIdToUpdate = 0;

    protected array $rules = [
        'qtys.*' => ['required', 'integer', 'min:1']
    ];

    public function mount(): void
    {
        $this->orderId = $this->order->id;
        $this->qtys();
    }

    public function update(): void
    {
        $pivot = OrderUser::findOrFail($this->pivotIdToUpdate);
        $this->can($pivot);
        $this->validate();

        $this->queryWithResult(fn () => $pivot->update(['qty' => $this->qtys[$this->pivotIdToUpdate]]));

        $this->drop();
    }

    public function destroy(): void
    {
        $pivot = OrderUser::findOrFail($this->pivotIdToUpdate);
        $this->can($pivot);

        $this->result($pivot->delete());

        $this->drop();
        $this->refresh();
        $this->emitUp('render');
    }

    // Join to exists order
    public function store(): void
    {
        $order = Order::findOrFail($this->orderId);
        $this->authorize('join', $order);
        $validated = $this->validate(['qty' => ['required', 'integer', 'min:1']]);

        $synced = $this->query(fn () => Order::findOrFail($this->orderId)->users()->syncWithoutDetaching([auth()->id() => $validated]));
        $this->result(isSynced($synced));

        $this->refresh();
    }

    public function updateDelivery(int $pivotId): void
    {
        $pivot = OrderUser::findOrFail($pivotId);
        $this->can($pivot);

        $delivery = deliveryRepository()->getPrice($pivot->order->sid, $pivot->qty);

        $this->result($pivot->update(['delivery' => $delivery->get('cost'), 'updated_at' => now()]));

        $this->refresh();
    }

    public function refresh(): void
    {
        $this->order = Order::firstOrNew(['id' => $this->orderId])->load('users');
        

        // $order = Order::find($this->orderId);
        // if ($order) {
        //     $order->load('users');
        // }
        $this->qtys();
    }

    public function can(OrderUser $pivot): void
    {
        $this->authorize('any', [OrderUser::class, $pivot]);
    }

    private function drop(): void
    {
        $this->pivotIdToUpdate = 0;
        $this->qty = null;
    }

    private function qtys(): void
    {
        $this->qtys = $this->order->users->mapWithKeys(fn ($user) => [$user->pivot->id => $user->pivot->qty])->toArray();
    }

    public function render()
    {
        return view('livewire.orders.users');
    }
}
