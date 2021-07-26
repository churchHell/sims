<?php

namespace App\Http\Livewire\Groups;

use App\Http\Livewire\BaseComponent;
use App\Models\Group;
use App\Models\Status;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Groups extends BaseComponent
{

    use AuthorizesRequests;

    public ?Group $selectedGroup;
    public int $groupId = 0;
    public ?string $comment = '';

    protected $rules = [
        'comment' => 'string'
    ];

    public function select(int $groupId, Group $group): void
    {
        $this->selectedGroup = $group->actual()->findOrFail($groupId);
        $this->comment = $this->selectedGroup->comment;
    }

    public function store(Group $group): void
    {
        $this->authorize('create', Group::class);

        $this->result($group->create());
    }

    public function update(): void
    {
        $this->authorize('update', $this->selectedGroup);
        $validated = $this->validate();

        $this->result($this->selectedGroup->update($validated));
    }

    public function archivate(): void
    {
        $this->authorize('update', $this->selectedGroup);

        $this->result($this->selectedGroup->status()->associate(Status::ARCHIVED)->save());

        $this->drop();
    }

    public function destroy(): void
    {
        $this->authorize('delete', $this->selectedGroup);

        $this->result($this->selectedGroup->delete());

        $this->drop();
    }

    private function drop (): void
    {
        $this->selectedGroup = null;
    }

    public function render(Group $group)
    {
        return view('livewire.groups.groups', ['groups' => $group->actual()->get()]);
    }
}
