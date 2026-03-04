@props(['delete' => false])
@php
    $classes = 'rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-xs focus-visible:outline-2 focus-visible:outline-offset-2 ';
    if($delete)
        $classes .= 'bg-red-600 hover:bg-red-500 focus-visible:outline-red-600';
    else
        $classes .= 'bg-indigo-600 hover:bg-indigo-500 focus-visible:outline-indigo-600'
@endphp
<button {{ $attributes->merge(['class' => $classes, 'type' => 'submit']) }} >
    {{ $slot }}
</button>
