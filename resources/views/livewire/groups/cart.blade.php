<x-groups.menu-block color="red" title="{{__('to-cart')}}">

    <x-forms.inputs.email></x-forms.inputs.email>
    <x-forms.inputs.password></x-forms.inputs.password>

    <x-forms.input 
        wire:model='batch'
        icon="layer-group"
    >
    </x-forms.input>
    <x-messages.text>{{ __('cart-batch') }}</x-messages.text>

    <x-forms.input 
        wire:model='delay'
        icon="stopwatch"
    >
    </x-forms.input>
    <x-messages.text>{{ __('cart-delay') }}</x-messages.text>

    <x-forms.checkbox
        wire:click="$toggle('skipLoaded')"
        id="skip-loaded" 
        cond="{{$skipLoaded}}"
    >
        {{ __('cart-skip-loaded') }}
    </x-forms.checkbox>

    <x-messages.info>
        {{ __('job.starting') }}
    </x-messages.info>

    <x-forms.button 
        icon='cart-arrow-down' 
        wire:click="send" 
        class="s bg-accent"
    >
        @lang('to-cart')
    </x-forms.button>

</x-groups.menu-block>
