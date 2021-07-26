{{--  <div class="h-20 p-8 m-8 w-full bg-gradient-to-r from-light-blue-500 to-bright-teal-500"></div>  --}}

<div class="container space-y-8">

    {{--  <div class="flex flex-col justify-between items-center bg-midnight-blue-600 rounded shadow p-4 space-y-2 sm:flex-row sm:space-y-0">
        <div>
            @include('parts.groups-list', compact($groupId))
        </div>
        <div class='flex flex-col sm:flex-row space-x-2'>
            <x-forms.input wire:model='filters.title' class="s border-none bg-wet-asphalt-500 text-wet-asphalt-100">
                <x-i class="text-wet-asphalt-100">tag</x-i>
            </x-forms.input>
            <x-forms.input wire:model='filters.user' icon='user' class="s border-none bg-wet-asphalt-500 text-wet-asphalt-100">
                <x-i class="text-wet-asphalt-100">user</x-i>
            </x-forms.input>
        </div>
    </div>  --}}

    <div class='flex flex-col space-y-4 sm:space-y-10'>
        @forelse($orders as $order)

            <div class="flex flex-col items-start justify-between w-full space-x-0 space-y-2 order md:flex-row md:space-x-4 md:space-y-0">

                @include('items.order-info', ['item' => $order])
                {{-- <x-items.item :order="$order" :item="$order->toArray()"></x-items.item> --}}

                <div class="flex space-x-4">

                    <livewire:orders.users :order="$order" :key="$order->id" />

                </div>

            </div>

        @empty
        @endforelse
    </div>
</div>
