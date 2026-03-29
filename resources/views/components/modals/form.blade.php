@props(['name', 'title'])

<div
    x-data="{
        show: {{ $errors->any() ? 'true' : 'false' }},
        name: '{{ $name }}',
        actionUrl: '',
        httpMethod: 'POST',
        formData: {}
    }"
    x-show="show"
    x-on:open-modal.window="
        if ($event.detail.name === name) {
            show = true;
            actionUrl = $event.detail.url;
            httpMethod = $event.detail.method;
            formData = $event.detail.data || {};
        }
    "
    x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="show = false"
    style="display: none;"
    class="fixed inset-0 z-50 overflow-y-auto"
    role="dialog"
    aria-modal="true"
>
    <div class="fixed inset-0 bg-gray-900/30 backdrop-blur-sm transition-opacity" @click="show = false"></div>

    <div class="relative z-10 flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">

            <form method="POST" :action="actionUrl">
                @csrf

                <template x-if="httpMethod !== 'POST'">
                    <input type="hidden" name="_method" :value="httpMethod">
                </template>

                <div class="bg-gray-50 px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $title }}</h3>
                    <button type="button" @click="show = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="px-4 py-5 sm:p-6">
                    {{ $slot }}
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-end gap-3">
                    <button type="button" @click="show = false" class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
