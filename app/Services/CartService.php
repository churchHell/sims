<?php

namespace App\Services;

use App\Models\{CartStatus, Order, Work};
use App\Repositories\CartRepository;
use Illuminate\Database\Eloquent\Collection;

class CartService
{
    
    private CartRepository $repository;

    public function __construct(string $email, string $password)
    {
        $this->repository = cartRepository($email, $password);
    }

    public function send(Collection $orders, int $batch, int $delay, Work $work)
    {
        $ordersLeft = $orders->count();

        foreach ($orders as $order) {

            $request = $this->repository->send($order->pid, $order->sid, $order->qty());

            if(!$request){
                $status =  CartStatus::NOT_ADDED;
            } elseif($order->qty() < $request->get('qty') && $request->get('qty') == $request->get('min_qty')){
                $status =  CartStatus::LESS_QTY;
            } elseif ($request->get('qty') != $request->get('qty')) {
                $status = CartStatus::DIFF_QTY;
            } else {
                $status = CartStatus::ADDED;
            }

            $this->updateCartStatus($order, $status);

            $ordersLeft--;
            if($ordersLeft % $batch == 0 && $ordersLeft != 0){
                sleep($delay);
            }

            $work->iterate();

        };
    }

    private function updateCartStatus(Order $order, int $status): void
    {
        $order->cartStatus()->associate($status)->save();
    }

}