<nav x-data="{ open: false }" x-cloak class="bg-canvas border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="font-bold text-xl text-black/80">
                        InventoryApp
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="/" :active="request()->is('/')"> Dashboard</x-nav-link>
                    <x-nav-link href="/products" :active="request()->is('products*')"> Products</x-nav-link>
                    <x-nav-link href="/suppliers" :active="request()->is('suppliers*')"> Suppliers</x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @guest
                <a href="/login" class="text-sm font-medium text-gray-500 hover:text-gray-900">
                    Sign in
                </a>
                @endguest
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                class="transition-all duration-300 ease-in-out origin-center"
                                :class="{'opacity-0 scale-50 rotate-45': open, 'opacity-100 scale-100 rotate-0': ! open }"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />

                            <path
                                class="transition-all duration-300 ease-in-out origin-center absolute"
                                :class="{'opacity-100 scale-100 rotate-0': open, 'opacity-0 scale-50 -rotate-45': ! open }"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="sm:hidden"
    >
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :active="request()->is('/')" href="/">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :active="request()->is('products')" href="/products">Products</x-responsive-nav-link>
            <x-responsive-nav-link :active="request()->is('suppliers')" href="/suppliers">Suppliers</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-4 border-t border-gray-200">
            <div class="space-y-1">
                <x-responsive-nav-link href="/login">
                    Sign in
                </x-responsive-nav-link>
            </div>
        </div>
    </div>
</nav>
