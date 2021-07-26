@props(['icon' => null])

<x-messages.message icon="{{$icon}}" text="red-700" bg="red-100">
    {{ $slot }}
</x-messages.message>