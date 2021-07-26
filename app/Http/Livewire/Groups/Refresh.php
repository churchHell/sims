<?php

namespace App\Http\Livewire\Groups;

use App\Http\Livewire\BaseComponent;
use App\Jobs\RefreshOrdersJob;
use App\Models\Group;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Refresh extends BaseComponent
{

    use AuthorizesRequests;

    public int $groupId;

    public function refresh(Group $group): void
    {
        
        $group = Group::with('orders')->findOrFail($this->groupId);
        $this->authorize('update', $group);

        RefreshOrdersJob::dispatch($group);

        $this->emitSuccess();
        
    }

    public function render()
    {
        return view('livewire.groups.refresh');
    }
}
