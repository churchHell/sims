<div class="">

    <div class="flex flex-col sm:flex-row space-y-1 sm:space-y-0 justify-between items-center py-8">

        <x-a icon='home' href="{{ route('index') }}" class='btn m' title="{{ __('main') }}">{{ __('main') }}
        </x-a>

        <x-forms.singles.tag wire:model.lazy='sid' wire:submit.prevent='search' btnicon='search' class='w-30'>
        </x-forms.singles.tag>

    </div>

    <div class="space-y-4">

        @forelse ($items as $key => $item)

            <div
                class="flex flex-col md:flex-row justify-between items-start w-full space-x-0 md:space-x-4 space-y-2 md:space-y-0">

                @include('items.item-info', compact('item'))

                <div class="flex items-center space-x-2 md:space-x-4">
                    <x-forms.singles.qty wire:submit.prevent="store({{ $item['sid'] }})"
                        wire:model="qtys.{{ $item['sid'] }}">
                    </x-forms.singles.qty>
                    <x-i wire:click="remove({{ $key }})" class="xs danger">trash</x-i>
                </div>


            </div>

        @empty
        @endforelse

    </div>

</div>
