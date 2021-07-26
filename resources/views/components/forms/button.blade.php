@props(['icon' => null])

@php
    $click = $attributes->whereStartsWith('wire:click')->first();
    $target = $attributes->whereStartsWith('wire:target')->first();
@endphp

<button 
    wire:loading.attr="disabled"
    {{ $attributes->merge([
        'class' => 'text-white shadow rounded shadow-lg' . ($slot->toHtml() ? ' space-x-2' : '')
        ]) }}
    title="{{ $attributes['title'] ?? $slot }}"
>

    @if ($icon)

        <i class="fas fa-{{ $icon }}" 
            wire:loading.class.remove="fa-{{ $icon }}"
            wire:loading.class="fa-spinner animate-spin" 
            wire:target="{{ $click ?? $target }}"></i>

    @else

        <x-preloader target="{{ $click }}"></x-preloader>

    @endif

    {{ $slot }}

</button>
