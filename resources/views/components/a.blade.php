<a
    title='{{ $title($slot->toHtml()) }}'
    {{ $attributes->merge(['class' => 'w-full flex items-center '.$spaceX($slot->toHtml())]) }}
>

    <x-i>{{ $icon }}</x-i>

    {{--  <span class="w-min sm:w-max">  --}}
    <span class="w-full">
        {{ $slot }}
    </span>

</a>