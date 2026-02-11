@props([
    'route' => route('cart.search'), // Default route, can be change
    'post' => route('cart.store'),
    'placeholder' => 'Scan code or type name/ID...'
])

<div
    x-data="productSearch('{{ $route }}')"
    class="relative w-full max-w-xl"
>
    <label class="block text-sm font-medium text-gray-700 mb-2">
        {{ $slot->isEmpty() ? 'Quick Add Item' : $slot }}
    </label>

    <div class="relative">
        <input
            type="text"
            x-model="query"
            @input.debounce.300ms="search"
            placeholder="{{ $placeholder }}"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
            autocomplete="off"
        >

        <div x-show="isLoading" class="absolute right-3 top-3 text-gray-400" style="display: none;">
            <svg class="animate-spin h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>

    <div
        x-show="results.length > 0"
        @click.outside="results = []"
        class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-xl max-h-[400px] overflow-y-auto"
        style="display: none;"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
    >
        <template x-for="product in results" :key="product.id">
            <div
                x-data="{ qty: 1, cost: product.cost }"
                class="border-b last:border-b-0 hover:bg-gray-50 transition-colors"
            >
                <div class="overflow-x-auto">
                    <form action="{{ $post }}" method="POST" class="flex items-center gap-4 p-4 min-w-[500px]">
                        @csrf
                        <input type="hidden" name="product_id" :value="product.id">

                        <div class="flex-1 min-w-[150px]">
                            <div class="font-bold text-gray-800 text-sm truncate" x-text="product.name"></div>
                            <div class="text-xs text-gray-500 font-mono mt-0.5">
                                <span x-text="product.code"></span>
                            </div>
                        </div>

                        <div class="w-24 shrink-0">
                            <label class="block text-[10px] text-gray-500 uppercase font-bold mb-1">Cost</label>
                            <div class="relative">
                                <span class="absolute left-2 top-1.5 text-gray-400 text-xs">$</span>
                                <input
                                    type="number"
                                    step="0.01"
                                    name="cost"
                                    x-model="cost"
                                    class="w-full pl-5 pr-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                >
                            </div>
                        </div>

                        <div class="w-16 shrink-0">
                            <label class="block text-[10px] text-gray-500 uppercase font-bold mb-1">Qty</label>
                            <input
                                type="number"
                                name="quantity"
                                x-model="qty"
                                min="1"
                                class="w-full px-2 py-1 text-sm text-center border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                            >
                        </div>

                        <div class="shrink-0 pt-4">
                            <button
                                type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-md text-sm font-semibold shadow-sm transition-colors whitespace-nowrap flex items-center gap-1"
                            >
                                <span>Add</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </div>

    <div
        x-show="query.length > 1 && results.length === 0 && !isLoading"
        class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg p-4 text-center text-gray-500 text-sm"
        style="display: none;"
    >
        No products found matching "<span x-text="query" class="font-medium text-gray-900"></span>"
    </div>
</div>
