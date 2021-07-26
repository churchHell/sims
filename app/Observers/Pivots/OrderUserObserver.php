<?php

namespace App\Observers\Pivots;

use App\Models\CartStatus;
use App\Models\Pivots\OrderUser;
use App\Models\Order;
use Illuminate\Support\Collection;
use App\Observers\Traits\GroupTrait;

class OrderUserObserver
{

    use GroupTrait;

    public function creating(OrderUser $orderUser)
    {
        $this->before($orderUser->order);
        $this->changing($orderUser->order);
        $this->setDelivery($orderUser, $orderUser->qty);
    }

    public function created(OrderUser $orderUser)
    {
        $this->changed($orderUser->order);
    }

    public function updating(OrderUser $orderUser)
    {
        $this->before($orderUser->order);
        $this->changing($orderUser->order);
        $this->setDelivery($orderUser, $orderUser->qty);
    }

    public function updated(OrderUser $orderUser)
    {
        $this->changed($orderUser->order);
    }

    public function deleting(OrderUser $orderUser)
    {
        $this->before($orderUser->order);
        $this->changing($orderUser->order);
    }

    public function deleted(OrderUser $orderUser)
    {
        if ($orderUser->order->load('users')->users->count() <= 0) {
            $orderUser->order->delete();
        }
    }

    private function setDelivery(OrderUser &$orderUser, int $qty): OrderUser
    {
        $orderUser->delivery = deliveryRepository()->getPrice($orderUser->order->sid, $qty)->get('cost');
        return $orderUser;
    }

    private function changing(Order &$order)
    {
        $order->cartStatus()->associate(CartStatus::whereSlug('changed')->first())->save();
    }

    private function changed(Order &$order)
    {
        $order->save();
    }
}
