@extends('items.info', compact('item'))

@section('price')

    <x-item-param icon='coins' name='price'>

        {{ $item['price'] }}
        {{ data_get($item, 'currency', '') }}

    </x-item-param>

    @overwrite

@section('created_at')
    @overwrite

@section('cart_status')
    @overwrite
