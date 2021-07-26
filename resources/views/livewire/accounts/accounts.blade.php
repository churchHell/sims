<div class='container py-8 space-y-2'>

    <div class="flex justify-end">
        <x-forms.input wire:model='name' icon='user' placeholder="{{ __('name') }} / {{ __('phone') }}"></x-forms.input>
    </div>

    <div class='flex hidden md:block'>
        <div class="w-2/3 flex">
            <div class="w-1/3 px-2">@lang('name')/@lang('surname')</div>
            <div class="w-1/3 px-2">@lang('phone')</div>
        </div>
        <div class="w-1/3 flex">
            <div class="w-1/2 px-2">@lang('role')</div>
            <div class="w-1/2 px-2">@lang('active')</div>
        </div>
    </div>

    @forelse($users as $user)

        <livewire:accounts.account :user="$user" :roles="$roles" :key="$user->id">

        @empty
    @endforelse

</div>
