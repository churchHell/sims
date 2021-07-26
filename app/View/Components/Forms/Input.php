<?php

namespace App\View\Components\Forms;

use Illuminate\Support\Facades\Lang;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class Input extends Component
{
    
    public string $icon = '';
    public ?string $placeholder = null;

    public function __construct(string $icon = '', string $placeholder = null)
    {
        $this->icon = $icon;
        $this->placeholder = Lang::has($placeholder) ? __($placeholder) : $placeholder;
    }

    public function placeholder():string
    {
        $model = $this->attributes->whereStartsWith('wire:model')->first();
        $lastWord = Str::of($model)->explode('.')->last();
        return $this->placeholder ?? __($lastWord);
    }

    public function render()
    {
        return view('components.forms.input');
    }
}
