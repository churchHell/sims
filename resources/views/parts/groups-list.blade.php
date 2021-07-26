<span x-data="{ open : false }">

    <div 
        @click="open = !open" 
        @keydown.escape="open = false" 
        class="s space-x-2 bg-amber-500 text-white cursor-pointer rounded shadow"
    >
        <x-i>layer-group</x-i>
        @choice('group', 1) #{{ $groupId }}
        <x-i>chevron-down</x-i>
    </div>

    <div 
        x-show="open" 
        @click.away="open = false"
        x-transition 
        class="bg-deep-orange-400 absolute rounded shadow text-white"
        style="display: none;"
    >
        @foreach ($groups->except($groupId) as $group)
            <x-a href="{{ route('index', [$group->id]) }}" title=" ___('group', 1) #{{$group->id}}">
                <div class="px-4 py-2 hover:bg-wet-asphalt-900">
                    @choice('group', 1) #{{$group->id}}
                    <div class="text-sm italic text-wet-asphalt-300">
                        {{ Str::words($group->comment, 5, '...') }}
                    </div>
                </div>
            </x-a>
        @endforeach
    </div>

</span>
