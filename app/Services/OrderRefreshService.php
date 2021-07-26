<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Collection;

class OrderRefreshService
{

    public function refresh (Order $order, ?float $price, ?float $orderDelivery): void
    {
        if($price){
            $order->update([
                'price' => $price,
                'updated_at' => now()
            ]);
        }

        if($orderDelivery){
            $order->users->each(
                fn($user) => $user->pivot->updateQuietly([
                    'delivery' => ceil($orderDelivery * $user->pivot->qty / $order->qty()),
                    'updated_at' => now()
                ])
            );
        }
    }

    
}