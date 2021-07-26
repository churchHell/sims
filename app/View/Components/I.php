<?php

namespace App\View\Components;

use Illuminate\View\Component;

class I extends Component
{
    
    public ?string $icon = null;
    private array $colors = [
        'check' => 'success',
        'check-circle' => 'success',
        'backspace' => 'primary',
        'plus' => 'primary',
        'times' => 'error',
        'trash' => 'error',
        'exclamation-circle' => 'error',
        'truck' => 'primary',
    ];

    public function __construct(string $icon = null)
    {
        $this->icon = $icon;
    }

    public function color (): void
    {
        // return $color ?? data_get($colors, $slot, 'accent');
    }

    public function render()
    {
        return view('components.i');
    }
}
