@props(['title', 'description' => null, 'buttonText' => null, 'buttonUrl' => '#'])

<div class="bg-white shadow sm:rounded-lg border border-gray-200 mb-8">
    @if($title)
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center border-b border-gray-200">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $title }}
                </h3>
                @if($description)
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        {{ $description }}
                    </p>
                @endif
            </div>
            @if($buttonText)
                <div>
                    <a href="{{ $buttonUrl }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-sm sm:text-base transition-colors">
                        {{ $buttonText }}
                    </a>
                </div>
            @endif
        </div>
    @endif

    <div class="overflow-x-auto">
        {{ $slot }}
    </div>
</div>
