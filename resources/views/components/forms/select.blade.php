<select {{ $attributes->merge(['class' => 'border border-primary rounded xs']) }}>

    {{ $slot }}

    <x-preloader target='update'></x-preloader>

</select>