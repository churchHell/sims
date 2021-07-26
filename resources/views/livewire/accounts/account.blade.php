<div class='flex items-center justify-between'>

    <div class='flex flex-col md:flex-row w-full'>
        <div class="w-full md:w-2/3 flex flex-col md:flex-row">
            <div class="w-full md:w-1/3 px-2">
                <x-i>user</x-i>{{ $user->full_name }}
            </div>
            <div class="w-full md:w-1/3 px-2">
                <x-i>phone-alt</x-i>{{ $user->phone }}
            </div>
        </div>
        <div class="w-full md:w-1/3 flex flex-row items-center">
            <div class="w-full md:w-1/2 px-2">
                <x-forms.select name='role' wire:model='role' wire:change='update' class='w-full md:w-4/5'>
                    @foreach ($roles as $role)
                        <x-forms.option value="{{ $role->id }}"
                            selected="{{ $role->id == $user->role_id }}">
                            {{ $role->name }}
                        </x-forms.option>
                    @endforeach
                </x-forms.select>
                <x-preloader target='update'></x-preloader>
            </div>
            <div class="w-full md:w-1/2 px-2 flex">
                <span class="block md:hidden">@lang('active')?</span>
                <x-i wire:click='activate'>
                    {{ $user->active ? 'check' : 'times' }}
                </x-i>
            </div>
        </div>
    </div>

</div>
