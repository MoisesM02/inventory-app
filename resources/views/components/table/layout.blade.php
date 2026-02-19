@props(['title',
        'description' => null,
        'buttonText' => null,
        'buttonUrl' => '#',
        'filters' => null,
        'filterText' => 'Filter by category:',
        'filterName' => 'category'
        ])

<div class="bg-white shadow sm:rounded-lg border border-gray-200 mb-8">
    @if($title)
        <div class="px-4 py-5 sm:px-6 flex flex-col sm:flex-row sm:items-center justify-between border-b border-gray-200 gap-4 sm:gap-0">

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

            <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6">

                @if($filters)
                    <div class="flex items-center mb-2 sm:mb-0">
                        <form method="GET" action="{{ request()->path() }}" class="flex flex-wrap items-center gap-x-3 gap-y-2">
                            <label for="category" class="text-sm font-medium text-gray-700 whitespace-nowrap mt-4">
                                {{ $filterText }}
                            </label>

                            <div class="w-40">
                                <x-form.select
                                    name="{{ $filterName }}"
                                    onchange="this.form.submit()"
                                >
                                    <option value="">All</option>
                                    @foreach($filters as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            {{ request($filterName) == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </x-form.select>
                            </div>

                            @if(request($filterName))
                                <a href="{{ request()->path() }}" class="text-sm text-red-600 hover:text-red-800 underline whitespace-nowrap">
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>
                @endif

                @if($buttonText)
                    <div>
                        <a href="{{ $buttonUrl }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-sm sm:text-base transition-colors w-full sm:w-auto">
                            {{ $buttonText }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="overflow-x-auto">
        {{ $slot }}
    </div>
</div>
