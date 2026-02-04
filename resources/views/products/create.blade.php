<x-layout>
    <x-slot:heading>
        Create Job
    </x-slot:heading>
    <form method="POST" action="/products/create">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Create a new product</h2>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form.field>
                        <x-form.label for="name">Product name</x-form.label>
                        <div class="mt-2">
                            <x-form.input name="name" placeholder="LED strip" required/>
                            <x-form.error name="name"/>
                        </div>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="code">Product Code</x-form.label>
                        <div class="mt-2">
                            <x-form.input name="code" placeholder="P0001" required/>
                            <x-form.error name="code"/>
                        </div>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="price">Product Price ($USD)</x-form.label>
                        <div class="mt-2">
                            <x-form.input name="price" placeholder="50.00" required/>
                            <x-form.error name="price"/>
                        </div>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="unit">Product Unit</x-form.label>
                        <div class="mt-2">
                            <x-form.input name="unit" placeholder="Bag" required/>
                            <x-form.error name="unit"/>
                        </div>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label>Categories (Select multiple)</x-form.label>
                        <x-form.error name="categories"/>
                        <div class="mt-2">
                            @foreach($categories as $category)
                                <x-form.checkbox name="categories"
                                                 id="category_{{ $category->id }}"
                                                 value="{{ $category->id }}"
                                                 label="{{$category->name}}"></x-form.checkbox>
                            @endforeach
                        </div>
                    </x-form.field>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
            <x-form.button>Save</x-form.button>
        </div>
    </form>
    <x-flash-message/>
</x-layout>
