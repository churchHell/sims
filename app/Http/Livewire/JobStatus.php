<?php

namespace App\Http\Livewire;

use App\Models\Work;
use Livewire\Component;

class JobStatus extends Component
{

    public bool $poll = false;

    protected $listeners = ['poll', 'render'];

    public function poll(): void
    {
        $this->poll = true;
    }

    public function render(Work $work)
    {
        $works = $work->actual();
        if($works->count() > 0 && $works->whereNull('ended_at')->count() > 0){
            $this->poll = true;
        } else {
            $this->poll = false;
        }
        return view('livewire.job-status', compact('works'));
    }
}
