@props(['key'])

<div class="h-screen w-screen flex items-center justify-center fixed bg-gray-700 bg-opacity-75 left-0 top-0 z-10">

    <div class="flex flex-col bg-white p-10 rounded-lg">

        <div class="flex justify-end">
            <x-i wire:click="$toggle('{{$key}}')">times</x-i>
        </div>

        <div class="">

            {{ $slot }}

        </div>

    </div>

</div>