@props(['id', 'cond'])

<label for='{{ $id }}'>
    
    {{ $slot }}

    <input {{ $attributes->merge(['class' => 'hidden', 'type' => 'checkbox', 'id' => $id]) }}>

    @if($cond)
        <x-i click='activate'>check</x-i>
    @else
        <x-i click='activate'>times</x-i>
    @endif

</label>