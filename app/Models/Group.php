<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'created_user_id', 'processed_user_id', 'status_id', 'processed_at'];

    protected $casts = ['processed_at' => 'datetime'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function archived(): HasMany
    {
        return (new Status)->archived()->groups();
    }

    public function actual(): HasMany
    {
        return (new Status)->actual()->groups();
    }

    public function isArchived(): bool
    {
        return $this->status->isArchived();
    }
}
