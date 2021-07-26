<?php

namespace App\Jobs;

use App\Models\Work;
use App\Services\CartService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;

class OrdersToCartJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Collection $orders;
    private int $batch;
    private int $batchDelay;
    private CartService $service;

    public function __construct(Collection $orders, int $batch, int $delay, CartService $service)
    {
        $this->orders = $orders;
        $this->batch = $batch;
        $this->batchDelay = $delay;
        $this->service = $service;
    }

    public function handle(Work $work)
    {
        $work = $work->start(self::class, $this->orders->count());
 
        $this->service->send($this->orders, $this->batch, $this->batchDelay, $work);

        $work->end();
    }
}
