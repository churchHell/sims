<div {{ $poll ? 'wire:poll.1s' : ''}}>

    @if (($inProcess = $works->whereNull('ended_at'))->count() > 0)

        <x-messages.info>
            
            @foreach ($inProcess as $work)

                <div>
                    <i class="fas fa-spinner animate-spin"></i>
                    {{ __($work->job) }} {{ __('in-process') }}
                    [ {{ $work->current }} \ {{ $work->max }} ]
                </div>
                
            @endforeach

        </x-messages.info>
        
    @endif

    @if (($ended = $works->whereNotNull('ended_at'))->count() > 0)

        <x-messages.success>
            
            @foreach ($ended as $work)

                <div>
                    <x-i>check</x-i>
                    {{ __($work->job) }} {{ __('ended') }}
                </div>
                
            @endforeach

        </x-messages.success>
        
    @endif

</div>
