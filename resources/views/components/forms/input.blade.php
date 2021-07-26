<div {{ $attributes->merge(['class' => "input-wrapper"]) }}>
    {{ $slot }}
    <input type="text" placeholder='{{$placeholder()}}' class="{{ filterClasses($attributes['class'], ['text', 'placeholder']) }}">
</div>