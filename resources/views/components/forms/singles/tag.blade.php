@props(['class' => 'w-10'])

<x-forms.single {{ $attributes->merge(['icon' => 'tag', 'placeholder' => __('sid'), 'class' => $class]) }}>
    {{ $slot }}
</x-forms.single>
