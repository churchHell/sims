<div class='flex flex-col items-center space-y-2'>

    <x-forms.button wire:click.prevent="$toggle('show')" icon='question' class='primary xs'>
        {{ __('forgot') }} {{ __('password') }}?
    </x-forms.button>

    @if($show)

        <x-forms.form wire:submit.prevent='send' class='flex flex-col items-center space-y-2'>

            <x-forms.inputs.email></x-forms.inputs.email>

            <x-forms.button wire:click.prevent="send" wire:target='send' icon='paper-plane' class='primary m'>
                {{ __('send') }}
            </x-forms.button>

        </x-forms.form>

    @endif

    @if($success)

        <x-messages.success icon='check'>
            {{ __('email-sended') }}
        </x-messages.success>

    @endif

</div>
