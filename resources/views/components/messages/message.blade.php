@props(['text', 'bg', 'icon' => null])

@php

    $size = $attributes->get('size') ?? 'xs';

    $sizes = ['xs' => 1, 's' => 2];

    $p = $sizes[$size];

@endphp

<div class="py-{{$p*2}} px-{{$p*4}} shadow border-l-8 text-{{$size}} text-{{$text}} bg-{{$bg}} border-{{$text}}">
    @if($icon) <x-i>{{$icon}}</x-i> @endif
    {{ $slot }}
</div>