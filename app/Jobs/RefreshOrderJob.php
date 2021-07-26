<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\OrderRefreshService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RefreshOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Order $order;
    private ?float $price;
    private ?float $orderDelivery;

    public function __construct(Order $order, ?float $price, ?float $orderDelivery)
    {
        $this->order = $order;
        $this->price = $price;
        $this->orderDelivery = $orderDelivery;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $service = new OrderRefreshService();
        $service->refresh($this->order, $this->price, $this->orderDelivery);
        Log::info('Order ' . $this->order->id . ' updated');
    }
}
