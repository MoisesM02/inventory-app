<x-layout>
    <x-slot:heading>
        Create Job
    </x-slot:heading>
    <form method="POST" action="/products/{{ $product->id }}/edit">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Create a new product</h2>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form.field>
                        <x-form.label for="name">Product name</x-form.label>
                        <div class="mt-2">
                            <x-form.input value="{{ $product->name }}" name="name" placeholder="LED strip" required/>
                            <x-form.error name="name"/>
                        </div>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="code">Product Code</x-form.label>
                        <div class="mt-2">
                            <x-form.input value="{{ $product->code }}" name="code" placeholder="P0001" required/>
                            <x-form.error name="code"/>
                        </div>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="price">Product Price ($USD)</x-form.label>
                        <div class="mt-2">
                            <x-form.input value="{{ $product->price }}" name="price" placeholder="50.00" required/>
                            <x-form.error name="price"/>
                        </div>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="unit">Product Unit</x-form.label>
                        <div class="mt-2">
                            <x-form.input value="{{ $product->unit }}" name="unit" placeholder="Bag" required/>
                            <x-form.error name="unit"/>
                        </div>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label>Categories (Select multiple)</x-form.label>
                        <x-form.error name="categories"/>
                        <div class="mt-2">
                            @foreach($categories as $category)
                                @if($productCategories->contains($category))
                                    <x-form.checkbox name="categories"
                                                     id="category_{{ $category->id }}"
                                                     value="{{ $category->id }}"
                                                     checked="true"
                                                     label="{{$category->name}}">
                                    </x-form.checkbox>
                                @else
                                    <x-form.checkbox name="categories"
                                                     id="category_{{ $category->id }}"
                                                     value="{{ $category->id }}"
                                                     label="{{$category->name}}">
                                    </x-form.checkbox>
                                @endif
                            @endforeach
                        </div>
                    </x-form.field>
                </div>
            </div>
        </div>
        <div class="mt-6 flex justify-between">
            <div class="flex items-center">
                <button form="delete-form" class="text-sm font-semibold text-white px-3 py-2 rounded-xl bg-red-800">Delete</button>
            </div>
            <div class="flex items-center gap-x-6">
                <a href="/products" class="text-sm font-semibold text-gray-900 px-3 py-2 rounded-xl bg-gray-300">Cancel</a>
                <x-form.button>Save</x-form.button>
            </div>
        </div>
    </form>
    <form method="POST" action="/products/{{$product->id}}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    <x-flash-message />
</x-layout>
