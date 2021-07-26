<?php

namespace App\Jobs;

use App\Models\Group;
use App\Models\Work;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Throwable;

class RefreshOrdersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Group $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $work = new Work();
        $work = $work->start('asd', 30);
        for($i = 0; $i < 30; $i ++){
            $work->iterate();
            info($i);
            sleep(1);
        }
        $work->end();
        return;


        $ids = $this->group->orders->pluck('sid')->implode(',');
        $items = itemRepository()->findAll($ids);

        $qtys = $this->getQtys($this->group);
        $deliveries = deliveryRepository()->getPrices($qtys);

        try {

            $this->group->orders->each(
                fn($order) => RefreshOrderJob::dispatch(
                    $order, 
                    data_get($items, $order->pid.'.price'),
                    data_get($deliveries, $order->sid.'.cost')
                )
            );

        } catch (\Exception $e) {
        }
    }

    private function getQtys (Group $group): Collection
    {
        return $group->orders->mapWithKeys(
            fn($order) => [
                $order->id => [
                    'sid' => $order->sid,
                    'qty' => $order->users->sum('pivot.qty')
                ]
            ]
        );
    }

}
