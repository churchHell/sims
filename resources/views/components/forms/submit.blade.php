@props(['btnicon' => 'check'])

<button type="submit">
    <x-i {{ $attributes }} class='text-primary cursor-pointer'>{{ $btnicon }}</x-i>
</button>