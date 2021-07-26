@props(['selected' => false])

<option {{ $attributes }} class='s border-none' {{ $selected ? 'selected' : '' }}>
    {{ $slot }}
    <x-preloader target='update'></x-preloader>
</option>