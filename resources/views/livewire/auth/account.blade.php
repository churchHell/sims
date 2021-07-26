<div class=''>
    
    <x-card title='{{ ___("account", 1) }}' submit='update'>

        <x-forms.input wire:model='name' placeholder='{{ __("name") }}' icon='user' size='m'></x-forms.input>
        <x-forms.input wire:model='surname' placeholder='{{ __("surname") }}' icon='user-friends' size='m'></x-forms.input>
        <x-forms.input wire:model='phone' placeholder='{{ __("phone") }}' icon='phone-alt' size='m'></x-forms.input>
        
        <x-forms.button target='update' icon='check' class='m primary' >@lang('update')</x-forms.button>

    </x-card>

    <x-card title='{{ __("update") }} {{ __("password") }}' submit='changePassword'>

        <x-forms.input wire:model='password' placeholder='{{ __("password") }}' icon='key' size='m'></x-forms.input>
        <x-forms.input wire:model='new_password' placeholder='{{ __("new") }} {{ __("password") }}' icon='key' size='m'></x-forms.input>
        <x-forms.input wire:model='new_password_confirmation' placeholder='{{ __("new") }} {{ __("password") }}' icon='key' size='m'></x-forms.input>
        
        <x-forms.button wire:target='changePassword' icon='check' class='m primary' >@lang('update')</x-forms.button>

    </x-card>

</div>
