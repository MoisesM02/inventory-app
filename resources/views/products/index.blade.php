<x-layout>
    <x-slot:header> Products </x-slot:header>
        <x-table.layout
            title="Products"
            description="A list of all your products"
            buttonText="Add product"
            buttonUrl="/products/create"
            :filters="$categories"
        >
            <x-table.wrapper>
                <x-slot:head>
                <tr>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Code</x-table.th>
                    <x-table.th>Units</x-table.th>
                    <x-table.th>Selling Price</x-table.th>
                    <x-table.th>Average Cost</x-table.th>
                    <x-table.th>Categories</x-table.th>
                    <x-table.th>Stock</x-table.th>
                    <x-table.th>Edit</x-table.th>
                </tr>
                </x-slot:head>

                @foreach($products as $product)
                    <tr>
                        <x-table.td><p class="text-md font-bold">{{ $product->name}} </p></x-table.td>
                        <x-table.td>{{ $product->code}}</x-table.td>
                        <x-table.td>{{ $product->unit}}</x-table.td>
                        <x-table.td>${{ $product->price}}</x-table.td>
                        <x-table.td>${{ $product->cost}}</x-table.td>
                        <x-table.td>{{ $product->categories->pluck('name')->join(', ')}}</x-table.td>
                        <x-table.td>{{ $product->stock}}</x-table.td>
                        <x-table.td><a href="/products/{{ $product->id }}/edit" class="text-blue-700 hover:underline">Edit</a></x-table.td>
                    </tr>
                @endforeach

            </x-table.wrapper>
        </x-table.layout>
    <div class="m-4">
        {{$products->links()}}
    </div>
    <x-flash-message />
</x-layout>
