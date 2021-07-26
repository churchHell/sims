<div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0">

    <span class="sm:hidden">
        <a class="font-bold text-primary" href="https://sima-land.ru{{ $item['url'] }}">
            {{ $item['name'] }}
        </a>
    </span>

    <div class="flex space-x-4 sm:space-x-10">

        <a href="https://sima-land.ru{{ $item['url'] }}">
            <img class="rounded-lg" src="{{ $item['img'] }}" alt="{{ $item['name'] }}"
                title="{{ $item['name'] }}">
        </a>

        <div class="flex flex-col">

            <span class="hidden sm:block">
                <a class="font-bold text-primary" href="https://sima-land.ru{{ $item['url'] }}">
                    {{ $item['name'] }}
                </a>
            </span>

            <x-item-param icon='tag' name='sid'>
                {{ $item['sid'] }}
            </x-item-param>

            @yield('price')

            <x-item-param icon='cubes' name='min'>
                {{ $item['min_qty'] }}
                {{ data_get($item, 'plural_name_format', '') }}
            </x-item-param>

            @yield('created_at')

            @yield('cart_status')

        </div>

    </div>

</div>
