@props(['target'])

<i 
    wire:loading
    @if(!empty($target)) wire:target="{{ $target }}" @endif
    {{ $attributes->merge(['class' => 'fas fa-spinner animate-spin']) }}
></i>