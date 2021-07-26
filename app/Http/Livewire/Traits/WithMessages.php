<?php

namespace App\Http\Livewire\Traits;

trait WithMessages
{

    public $toasts = ['error' => [], 'success' => [], 'warning' => []];

    public function toastError(string $error): void
    {
        $this->toasts['error'][] = $error;
    }

    public function toastSuccess(string $success): void
    {
        $this->toasts['success'][] = $success;
    }

    public function toastWarning(string $warning): void
    {
        $this->toasts['warning'][] = $warning;
    }

    public function removeToast(string $type, int $id): void
    {
        unset($this->toasts[$type][$id]);
    }
    
}