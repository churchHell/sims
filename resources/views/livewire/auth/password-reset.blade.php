<div>

    <x-card title='{{ __("update") }} {{ __("password") }}' submit='update'>

        <x-forms.input wire:model='password' placeholder='{{ __("password") }}' icon='key' size='m'></x-forms.input>
        <x-forms.input wire:model='password_confirmation' placeholder='{{ __("password") }}' icon='key' size='m'></x-forms.input>
        
        <x-forms.button wire:target='update' icon='check' class='m primary' >@lang('update')</x-forms.button>

    </x-card>

</div>
