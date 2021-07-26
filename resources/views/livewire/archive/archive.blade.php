<div class="container">

    <x-title>{{ __('archive')  }}</x-title>
    
    @foreach($groups as $group)

        <livewire:orders.orders :groupId="$group->id" />

    @endforeach

    {{ $groups->links() }}

</div>
