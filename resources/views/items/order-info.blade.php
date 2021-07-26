@extends('items.info')

@section('price')

    <x-item-param icon='coins' name='price'>

        @can('refresh', \App\Models\Order::class)

            <x-forms.button 
                wire:click="updatePrice({{ $item['id'] }})"
                wire:target="updatePrice({{ $item['id'] }})" 
                class="xs bg-{{ isNewColor($item['updated_at']) }}"
                title="{{ __('refresh') }}"
            >

                {{ $item['price'] }}
                {{ data_get($item, 'currency', '') }}

            </x-forms.button>

        @else

            {{ $item['price'] }}
            {{ data_get($item, 'currency', '') }}

        @endif

    </x-item-param>

@overwrite

@section('created_at')

    <x-item-param icon='clock' name='created_at'>
        {{ dateToShow($item['created_at']) }}
    </x-item-param>

@overwrite

@section('cart_status')

    @if (false && $item['cart_status_id'])
        @php
            $component = 'messages.'. $item->cartStatus->status->slug;
        @endphp

        {{--  <x-dynamic-component :component="$component" size="xs" icon="{{$item->cartStatus->status->icon}}">
            {{ $item->cartStatus->name }}
        </x-dynamic-component>  --}}
    @endif

@overwrite
