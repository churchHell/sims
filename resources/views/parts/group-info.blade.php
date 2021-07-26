<section class="relative bg-wet-asphalt-500">

    <div class="container flex flex-col items-center justify-between py-4 space-x-2 sm:flex-row sm:space-x-8">
        <div class='flex flex-col w-full space-y-2 text-xl'>
            <div class="flex flex-row items-end justify-between">
                @include('parts.groups-list', ['groupId' => $group->id])
            </div>
            
            @if (!empty($group->comment))
                {{--  <div class="text-sm italic text-justify">
                    <x-i class="text-accent">comment</x-i>
                    {{ $group->comment }}
                </div>  --}}
            @endif
        </div>
        <div class="flex space-x-8">
            {{--  <x-a icon="cart-plus" class='border border-white rounded sm:text-xl s'
                href="{{ route('search.index', [$group->id]) }}">@lang('find-item')</x-a>
            <x-a icon="clipboard-list" class='text-base border border-white rounded-full sm:text-xl s'
                href="{{ route('report', [$group->id]) }}">@lang('create-report')</x-a>  --}}
        </div>
    </div>

</section>



@if (false)
<section class="relative text-gray-700">

    <div class="container flex flex-col items-center justify-between py-4 pt-8 space-x-2 sm:flex-row sm:space-x-8">
        <div class='flex flex-col w-full space-y-2 text-xl'>
            <div class="flex flex-row items-end justify-between">
                <x-title>
                    {{--  <x-i>layer-group</x-i>  --}}
                    @choice('group', 1) #{{ $group->id }}
                </x-title>
                
                <div class="text-sm text-gray-500">
                    <x-i class="text-accent">clock</x-i>
                    {{ dateToShow($group->created_at) }}
                </div>
            </div>
            
            @if (!empty($group->comment))
                <div class="text-sm italic text-justify">
                    <x-i class="text-accent">comment</x-i>
                    {{ $group->comment }}
                </div>
            @endif
        </div>
        <div class="flex space-x-8">
            <x-a icon="cart-plus" class='border border-white rounded sm:text-xl s'
                href="{{ route('search.index', [$group->id]) }}">@lang('find-item')</x-a>
            <x-a icon="clipboard-list" class='text-base border border-white rounded-full sm:text-xl s'
                href="{{ route('report', [$group->id]) }}">@lang('create-report')</x-a>
        </div>
    </div>

</section>

@endif
