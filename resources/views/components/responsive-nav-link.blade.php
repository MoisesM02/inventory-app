@props(['active' => false])

@php
    $classes = ($active ?? false)
                ? 'border-blue-500 text-blue-700 bg-blue-50 focus:text-blue-800 focus:bg-blue-100'
                : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300';
@endphp

<a
    aria-current="{{ $active ? 'page' : 'false' }}"
    {{ $attributes->merge(['class' => 'block pl-3 pr-4 py-2 border-l-4 text-base font-medium focus:outline-none transition duration-150 ease-in-out ' . $classes]) }}
>
    {{ $slot }}
</a>
