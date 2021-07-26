<div class="flex items-center space-x-2">

    <span class="flex items-center space-x-2 text-accent">
        <x-i>{{$icon}}</x-i>
        <span class="hidden sm:block">
            @lang($name) :        
        </span>
    </span>

    <span>{{ $slot }}</span>

</div>