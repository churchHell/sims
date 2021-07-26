<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ItemParam extends Component
{
    
    public string $icon = '';
    public string $name = '';

    public function __construct(string $icon = '', string $name = '')
    {
        $this->icon = $icon;
        $this->name = $name;
    }

    public function render()
    {
        return view('components.item-param');
    }
}
