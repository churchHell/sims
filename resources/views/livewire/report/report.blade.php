<div class="container space-y-4 flex flex-col items-start">

    <h1>@choice('group', 1)# {{ $group }}</h1>

    <x-forms.single wire:model.debounce.150ms="rate" wire:submit.prevent="emitRate" icon="percent"></x-forms.single>

    @foreach($users as $userOrders)

        <livewire:report.user :userOrders="$userOrders" :key="$userOrders[0]['id']"/>

    @endforeach

</div>