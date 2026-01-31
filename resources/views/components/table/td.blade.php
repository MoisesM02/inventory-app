@props(['edit' => false])

<td {{ $attributes->merge(['class' => 'px-6 py-4 whitespace-nowrap text-sm ' . ($edit ? 'text-right font-medium' : 'text-gray-900')]) }}>
    @if($edit)
        <a href="#" class="text-indigo-600 hover:text-indigo-900 transition-colors">{{ $slot }}</a>
    @else
        {{ $slot }}
    @endif
</td>
