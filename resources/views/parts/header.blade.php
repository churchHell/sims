<header class="py-3 bg-blue-grey-700">
    <div class="container relative z-10 flex flex-col items-center justify-between sm:flex-row">
        <nav class="flex space-x-5 sm:flex-row">
            <x-a icon='home' href="{{ route('index') }}" class="text-white">{{ __("main") }}</x-a>
            <x-a icon='archive' href="{{ route('archive') }}" class="text-white">{{ __("archive") }}</x-a>
            <x-a icon='layer-group' href="{{ route('groups') }}" class="text-white">{{ ___("group", 2) }}</x-a>
            <x-a icon='users-cog' href="{{ route('accounts') }}" class="text-white">{{ ___("account", 2) }}</x-a>
        </nav>

        <div class="flex order-first mb-2 space-x-3 sm:order-none sm:mb-0">
            @guest
                <nav class="flex space-x-5">
                    <x-a href="{{ route('login') }}" class="text-white" icon="sign-in-alt">@lang('login')</x-a>
                    <x-a href="{{ route('register') }}" class="text-white" icon="user-plus">@lang('register')</x-a>
                </nav>
            @else
                <span class="text-white">{{ auth()->user()->short_name }}</span>
                <nav class="flex space-x-2 space-x-5">
                    <x-a icon='user-cog' href="{{ route('account') }}" class="text-white" title='{{ ___("account", 1) }}'></x-a>
                    <livewire:auth.logout />
                </nav>
            @endguest
        </div>
    </div>
</header>