<?php

namespace App\Http\Livewire\Archive;

use Livewire\Component;
use App\Models\Group;

class Archive extends Component
{

    public function render(Group $group)
    {
        return view('livewire.archive.archive', ['groups' => $group->archived()->paginate(1)])->extends('layouts.app');
    }
}
