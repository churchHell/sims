<section class="container space-y-4">

    <livewire:job-status />

    <x-title>@choice('group', 2)</x-title>

    <x-forms.button icon='layer-group' class='primary l' wire:click='store'>
        @choice('store', 1)
    </x-forms.button>

    <div>

        <x-forms.select wire:model='groupId'>
            <x-forms.option value='0' selected disabled hidden>
                {{___('group', 1)}}
            </x-forms.option>
            @foreach ($groups as $group)
                <x-forms.option value="{{$group->id}}" wire:click='select({{$group->id}})'>
                    <div>
                        <div>{{ $group->id }}</div>
                        <div>{{ Str::words($group->comment, 5, '...') }}</div>
                    </div>
                    
                </x-forms.option>
            @endforeach
        </x-forms.select>
    
    </div>

    @if ($selectedGroup)

        <div class="">
            <h3>@choice('group', 1) №{{ $selectedGroup->id }}. @choice('store', 2): {{ dateToShow($selectedGroup->created_at) }}</h3>
            <div>@lang('comment'): {{ $selectedGroup->comment }}</div>
        </div>

        <div class="flex flex-wrap">

            <x-groups.menu-block color="yellow" title="{{__('comment')}}">
               
                <x-forms.single
                    wire:model.lazy='comment'
                    wire:submit.prevent='update' 
                    size='xs'  
                    value='{{ $comment }}' 
                    title="{{ __('comment') }}" 
                    btnicon='check'>
                </x-forms.single>
            </x-groups.menu-block>

            <x-groups.menu-block color="green" title="{{__('archivate')}}">
                <x-forms.button 
                    wire:click="archivate"                             
                    icon='archive' 
                    class="s bg-primary"
                >
                    @lang('archivate')
                </x-forms.button>
            </x-groups.menu-block>

            <x-groups.menu-block color="blue" title="{{__('delete')}}">
                <x-forms.button 
                    wire:click="destroy" 
                    icon='trash' 
                    class="s bg-error"
                >
                    @lang('delete')
                </x-forms.button>
            </x-groups.menu-block>


            <livewire:groups.refresh :groupId="$selectedGroup->id" :wire:key="'refresh-'.$selectedGroup->id" />

            <livewire:groups.cart :groupId="$selectedGroup->id" :wire:key="'cart-'.$selectedGroup->id" />

        </div>
        
    @endif
    

</section>
