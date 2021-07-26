@if (!empty($slot->toHtml()))
    <i {{ $attributes->merge(['class' => "fas fa-".$slot]) }}></i>    
@endif


@if (false)
    



<i

        @if($click = $attributes->get('wire:click'))
        wire:click='{{ $click }}'
        wire:loading.class.remove='fa-{{ $slot }}'
        wire:loading.class="fa-spinner animate-spin"
        wire:target="{{ $click }}"
        @endif

        @if($target = $attributes->get('wire:target'))
        wire:loading.class.remove='fa-{{ $slot }}'
        wire:loading.class="fa-spinner animate-spin"
        wire:target="{{ $target }}"
        @endif

        @if(empty($attributes['title']) && !empty($click)) title='{{ __($click) }}' @endif

        {{ $attributes->merge(['class' =>
            ($click ? ' cursor-pointer' : '')
            . " text-".$color." fas fa-".$slot])
        }}

></i>

@endif