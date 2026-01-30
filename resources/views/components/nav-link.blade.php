@props(['active' => false])
@php
    $activeClasses = 'border-blue-500 text-gray-900';

    $inactiveClasses = 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
@endphp
<a
    aria-current="{{ $active ? 'page' : 'false' }}"
    class="{{ $active ? $activeClasses : $inactiveClasses }} border-b-2 inline-flex items-center px-1 pt-1 text-sm font-medium transition duration-150 ease-in-out"
    {{ $attributes }}
>
    {{ $slot }}
</a>
