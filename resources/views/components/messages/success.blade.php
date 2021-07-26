@props(['icon' => null])

<x-messages.message icon="{{$icon}}" text="green-700" bg="green-100">
    {{ $slot }}
</x-messages.message>