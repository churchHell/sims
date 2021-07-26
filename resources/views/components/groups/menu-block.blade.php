@props(['color', 'title'])

<div
    {{ $attributes->merge(['class' => 'bg-'.$color.'-100 w-1/2 p-10 space-y-2 flex flex-col items-center']) }}
>

    <h3 class="mb-4">{{ $title }}</h3>

    {{ $slot }}

</div>