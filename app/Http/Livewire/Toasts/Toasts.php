<?php

namespace App\Http\Livewire\Toasts;

use Livewire\Component;
use App\Http\Livewire\Traits\WithMessages;

class Toasts extends Component
{

    use WithMessages;

    protected $listeners = ['loading', 'success', 'error', 'exception', 'warning'];

    public function loading(): void
    {
        $this->toastWarning(__('loading'));
    }

    public function success(): void
    {
        $this->toastSuccess(__('success'));
    }

    public function exception(string $message = ''): void
    {
        $this->toastError($message);
    }

    public function error(): void
    {
        $this->toastError(__('error') . '. ' . __('try-again'));
    }

    public function warning(string $message): void
    {
        $this->toastWarning($message);
    }

    public function render()
    {
        return view('livewire.toasts.toasts');
    }
}
