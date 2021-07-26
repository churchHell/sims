<?php

namespace App\View\Components;

use Illuminate\View\Component;

class A extends Component
{

    public string $icon = '';

    public function __construct(string $icon = '')
    {
        $this->icon = $icon;
    }

    public function title (string $slot = ''): string
    {
        return $this->attributes['title'] ?? $slot;
    }

    public function spaceX (string $slot = ''): string
    {
        return $slot ? ' space-x-2 ' : '' ;
    }

    public function render()
    {
    //     return function ($data){
    //         dd($data);
    //     };
        return view('components.a');
    }
}
