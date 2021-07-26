@props(['title', 'submit' => ''])

<div class="space-y-8 my-12">

    <x-title>{{ $title }}</x-title>

    <div {{ $attributes->merge(['class' => 'container flex justify-center items-center vertical']) }}>

        <x-forms.form wire:submit.prevent='{{ $submit }}' class='flex flex-col items-center space-y-4'>

            {{ $slot }}

        </x-forms.form>

    </div>

</div>
