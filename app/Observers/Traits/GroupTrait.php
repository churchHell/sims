<?php

namespace App\Observers\Traits;

use App\Models\Order;

trait GroupTrait
{

    private function before(Order $order): void
    {
        throw_if($order->group->isArchived(), \Exception::class, __('group.archived'));
    }

}