@props(['class' => 'w-10'])

<x-forms.single {{ $attributes->merge(['icon' => 'cubes', 'placeholder' => __('qty'), 'class' => $class]) }}>
    {{ $slot }}
</x-forms.single>
