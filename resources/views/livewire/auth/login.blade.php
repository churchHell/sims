<div>

    <x-card title="{{ __('login') }}" submit='login'>

        <x-forms.inputs.email></x-forms.inputs.email>
        <x-forms.inputs.password></x-forms.inputs.password>


        <x-forms.button wire:click.prevent="login" target='login' icon='sign-in-alt' class='primary m'>
            @lang('login')
        </x-forms.button>

        <livewire:auth.forgot-password />

    </x-card>

</div>
