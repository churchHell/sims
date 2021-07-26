<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotsOrderUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'qty', 'delivery', 'updated_at'];
}
