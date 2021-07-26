<div class="space-y-1 flex flex-col flex-no-wrap">

    @forelse ($order->users as $user)

        <div class="order__user space-x-2 flex flex-nowrap">

            <span>
                <div class="hidden sm:block whitespace-no-wrap">{{ fullName($user->name, $user->surname) }}</div>
                <div class="sm:hidden whitespace-no-wrap">{{ shortName($user->name, $user->surname) }}</div>
            </span>

            <span class="space-x-2 whitespace-no-wrap ">

                @if ($user->pivot->id != $pivotIdToUpdate)

                    @can('any', ['App\Models\Pivots\OrderUser', $user->pivot])

                        <x-forms.button 
                            wire:click="$set('pivotIdToUpdate', {{ $user->pivot->id }})" 
                            class="xs bg-primary"
                            icon="cubes" 
                            title="{{ __('qty') }}/{{ __('edit') }}"
                        >
                            {{ $qtys[$user['pivot']['id']] }} {{ $order->plural_name_format }}
                        </x-forms.button>

                        <x-forms.button 
                            wire:click="updateDelivery({{ $user->pivot->id }})"
                            class="xs bg-{{ isNewColor($user->pivot->updated_at) }}"
                            icon="truck"
                            title="{{ __('delivery') }}/{{ __('refresh') }}"
                        >
                            {{ $user->pivot->delivery }} {{ $order->currency }}
                        </x-forms.button>

                    @else

                        <span class="text-accent">
                            <x-i>cubes</x-i>{{ $user->pivot->qty }} {{ $order->plural_name_format }}
                        </span>
                        <span class="text-primary">
                            <x-i>truck</x-i>{{ $user->pivot->delivery }} {{ $order->currency }}
                        </span>

                    @endcan

                @else

                    <span class="flex items-center space-x-2 only-icon">
                        <x-forms.single icon='cubes' size='xs' wire:model.lazy="qtys.{{ $user->pivot->id }}"
                            wire:submit.prevent='update' class='w-5' placeholder="{{ __('qty') }}"
                            value="{{ $user->pivot->qty ?? 0 }}"></x-forms.single>
                        <x-i class="danger" wire:click="destroy" title="{{ __('delete') }}">trash</x-i>
                        <x-i wire:click="$set('pivotIdToUpdate', 0)" title="{{ __('cancel') }}">backspace</x-i>
                    </span>

                @endif

            </span>

        </div>

    @empty

    @endforelse

    <div class="flex justify-between items-center space-x-4">

        <div class="w-full alert s {{ $order->min_qty <= ($total = array_sum($qtys)) ? 'success' : 'error' }}">
            @lang('total'): {{ $total }}
        </div>

        @can('join', $order)

            <x-forms.singles.qty wire:model.lazy='qty' wire:submit.prevent='store' size='s'>
            </x-forms.singles.qty>

        @endcan

    </div>

</div>
