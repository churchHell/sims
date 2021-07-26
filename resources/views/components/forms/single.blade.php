@props(['btnicon' => 'check', 'size' => 'm'])

<x-forms.form {{ $attributes->whereStartsWith(['wire:submit']) }}>

    <x-forms.input
        {{ $attributes->whereDoesntStartWith(['wire:submit'])->merge(['class' => 'border-none text-center']) }}
        size='{{ $size }}'>

        <x-forms.submit btnicon="{{ $btnicon }}"
            wire:target="{{ $attributes->whereStartsWith(['wire:submit'])->first() }}"></x-forms.submit>

    </x-forms.input>

</x-forms.form>
