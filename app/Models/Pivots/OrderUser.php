<?php

namespace App\Models\Pivots;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Traits\IsNew;

class OrderUser extends Pivot
{
    use HasFactory, IsNew;

    protected $fillable = ['user_id', 'qty', 'delivery', 'updated_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
