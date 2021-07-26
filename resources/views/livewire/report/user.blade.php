<div class="w-full">

    <div class="w-full bg-blue-100 text-blue-800 rounded-lg m">
        {{ $fullName }}
    </div>

    @php $toPay = 0 @endphp

    @foreach($orders as $order)

        {{ $loop->iteration }}.
        <x-items.params.name :item="$order"></x-items.params.name>

        <div class="flex">

            <div class="w-1/6">
                <x-items.params.sid :item="$order"></x-items.params.sid>
            </div>
            <div class="w-1/6">
                <x-items.params.price :item="$order"></x-items.params.price>
            </div>
            <div class="w-1/6">
                <x-items.params.param icon="cubes" name="{{ __('qty') }}">
                    {{ $qty = $order['qty'] }}
                </x-items.params.param>
            </div>
            <div class="w-1/6">
                <x-items.params.param icon="check" name="{{ __('sum') }}">
                    {{ $sum = $qty * $order['price'] }}
                </x-items.params.param>
            </div>
            <div class="w-1/6">
                <x-items.params.param icon="truck" name="{{ __('delivery') }}">
                    {{ $delivery = $order['delivery'] }}
                </x-items.params.param>
            </div>
            <div class="w-1/6">
                <x-items.params.param icon="check-double" name="{{ __('total') }}">
                    {{ $total= $sum + $delivery }}
                </x-items.params.param>
            </div>

        </div>

        @php $toPay += $total @endphp

    @endforeach

    <div class="flex justify-end mt-2">
        <div class="bg-green-200 text-green-800 m rounded-lg">
            @lang('to-pay'): {{ $toPay }} {{$order['currency']}}
            @if($rate) @lang('or') {{ $toPay * $rate }} BYN @endif
        </div>
    </div>

</div>
