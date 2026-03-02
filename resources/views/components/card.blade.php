@props(['title', 'value'])

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col relative overflow-hidden transition-all hover:shadow-md">
    <div class="flex justify-between items-start">

        <div>
            <p class="text-sm font-medium text-gray-500 truncate">{{ $title }}</p>
            <h3 class="mt-2 text-3xl font-bold text-gray-900">{{ $value }}</h3>
        </div>

        @if (isset($icon))
            <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                {{ $icon }}
            </div>
        @endif
    </div>

    @if(isset($footer))
        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
            <div class="text-sm text-gray-500 w-full text-right">
                {{ $footer }}
            </div>
        </div>
    @endif
</div>
