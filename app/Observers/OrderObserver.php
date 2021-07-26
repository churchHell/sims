<?php

namespace App\Observers;

use App\Models\Order;
use App\Observers\Traits\GroupTrait;

class OrderObserver
{

    use GroupTrait;

    /**
     * Handle the order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function creating(Order $order)
    {
        $this->before($order);
        throw_if($order->whereSid($order->sid)->exists(), \Exception::class, __('order.stored'));
    }

    public function created(Order $order)
    {
        // $qty = data_get(request(), 'serverMemo.data.qty');
        // if(!$qty){
        //     \DB::rollback();
        //     return false;
        // }
        // $delivery = deliveryRepository()->getPrice($order->sid, $qty)->get('cost');
        // $order->users()->attach(auth()->id(), compact('qty', 'delivery'));
    }

    public function updating(Order $order)
    {
        $this->before($order);
    }

    public function saving(Order $order)
    {
        $this->before($order);
    }
}
