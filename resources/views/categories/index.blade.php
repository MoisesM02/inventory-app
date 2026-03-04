@php
    $pageAggregator = ((request()->get('page') ?? 1) - 1) * 10 //Count accurately the number of categories in pagination
@endphp
<x-layout>
    <x-slot:header>Categories</x-slot:header>

    <x-table.layout
        title="Product Categories"
        description="Manage the categories of your products"
        :filters="$products"
        filter-name="product"
        filter-text="Filter by product"
    >
        <x-slot:button>
            <x-modals.trigger name="create-form">Add Category</x-modals.trigger>
        </x-slot:button>
        <x-table.wrapper>
            <x-slot:head>
                <tr>
                    <x-table.th>N°</x-table.th>
                    <x-table.th>Category</x-table.th>
                    <x-table.th>N° of Products Associated</x-table.th>
                    <x-table.th>Actions</x-table.th>
                </tr>
            </x-slot:head>
            @foreach($categories as $category)
                <tr>
                    <x-table.td>{{ $loop->iteration + $pageAggregator }}</x-table.td>
                    <x-table.td>{{ $category->name }}</x-table.td>
                    <x-table.td>{{ $category->products->count()}}</x-table.td>
                    <x-table.td><x-link href="{{ route('categories.edit', $category) }}">Modify</x-link></x-table.td>
                </tr>
            @endforeach
        </x-table.wrapper>
    </x-table.layout>
    {{ $categories->links() }}

    <x-modals.form name="create-form" :action="route('categories.store')" title="Create New Category" :should-show="$errors->any() ? 'true' : 'false'">
        <x-form.field>
            <x-form.label for="name">Name</x-form.label>
            <x-form.input name="name" value="{{ old('name') }}"/>
            <x-form.error name="name"/>
        </x-form.field>
    </x-modals.form>
    <x-flash-message/>
</x-layout>
