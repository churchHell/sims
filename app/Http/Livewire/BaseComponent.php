<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BaseComponent extends Component
{

    protected function query(callable $function)
    {
        try {
            return $function();
        } catch (\Exception $e) {
            $this->emitException($e->getMessage());
            return;
        }
    }

    protected function queryWithResult(callable $function): void
    {
        $result = $this->query($function);
        $this->result($result);
    }

    protected function result($condition): void
    {
        (bool)$condition ? $this->emitSuccess() : $this->emitError();
    }

    public function emitSuccess(): void
    {
        $this->emit('success');
    }

    public function emitError(): void
    {
        $this->emit('error');
    }

    public function emitWarning(string $message): void
    {
        $this->emit('warning', $message);
    }

    public function emitException(string $message): void
    {
        $this->emit('exception', $message);
    }

    public function sleep()
    {
        sleep(3);
    }
}
