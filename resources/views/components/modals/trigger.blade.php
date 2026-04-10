@props([
    'name',
    'type' => 'button',
    'url' => '',
    'method' => 'POST',
    'data' => []
])

@php
    $class = 'px-4 py-2 border border-transparent font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-sm sm:text-base transition-colors w-full sm:w-auto transition ease-in-out duration-150';
@endphp

@if($type == 'button')
    <button
        type="button"
        x-data="{ payload: {{ json_encode($data) }} }"
        @click="$dispatch('open-modal', {
            name: '{{ $name }}',
            url: '{{ $url }}',
            method: '{{ $method }}',
            data: payload
        })"
        {{ $attributes->merge(['class' => $class]) }}
    >
        {{ $slot }}
    </button>
@else
    <x-link class="my-2" href="#"
       x-data="{ payload: {{ json_encode($data) }} }"
       @click.prevent="$dispatch('open-modal', {
            name: '{{ $name }}',
            url: '{{ $url }}',
            method: '{{ $method }}',
            data: payload
        })"
    >
        {{ $slot }}
    </x-link>
@endif
