<div>

    <x-card title='{{ __("register") }}' submit='store'>

        <x-forms.input wire:model.lazy='name' icon='user' class="m"></x-forms.input>
        <x-forms.input wire:model.lazy='surname' icon='user-friends' class="m"></x-forms.input>
        <x-forms.input wire:model.lazy='phone' icon='phone-alt' class="m"></x-forms.input>
        <x-forms.inputs.email></x-forms.inputs.email>
        <x-forms.inputs.password></x-forms.inputs.password>
        <x-forms.input wire:model.lazy='password_confirmation' icon='key' type='password' class="m"></x-forms.input>

        <x-forms.button icon='plus' target='store' class='primary' size='m'>@lang('register')</x-forms.button>

    </x-card>
    
</div>