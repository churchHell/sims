<?php

namespace App\Models\Traits;

use Carbon\Carbon;

trait isNew
{

    protected int $diffInMinutes = 1440;

    public function isNew(): bool
    {
        return Carbon::now()->diffInMinutes(new Carbon($this->updated_at)) < $this->diffInMinutes;
    }
}
