<x-groups.menu-block color="purple"  title="{{__('refresh')}}">

    <x-forms.button 
        wire:click="refresh"
        icon='sync-alt'
        class="s bg-text"
    >
        @lang('refresh')
    </x-forms.button>

    <x-messages.info>
        {{ __('job.starting') }}
    </x-messages.info>

</x-groups.menu-block>
