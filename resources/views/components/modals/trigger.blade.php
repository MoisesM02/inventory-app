@props([
    'name', 
    'class' => 'px-4 py-2 border border-transparent font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-sm sm:text-base transition-colors w-full sm:w-auto" transition ease-in-out duration-150'
])

<button 
    type="button" 
    x-data 
    @click="$dispatch('open-modal', '{{ $name }}')"
    {{ $attributes->merge(['class' => $class]) }}
>
    {{ $slot }}
</button>