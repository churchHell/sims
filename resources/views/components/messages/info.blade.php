@props(['icon' => null])

<x-messages.message icon="{{$icon}}" text="blue-700" bg="blue-100">
    {{ $slot }}
</x-messages.message>