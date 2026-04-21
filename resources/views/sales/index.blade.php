<x-layout>
    <x-slot:header>Purchases</x-slot:header>

    <x-table.layout
        :filters="$costumers"
        title="Sales"
        filter-text="Filter by costumer:"
        description="All sales made"
        button-text="Add new sale"
        filter-name="customer"
        button-url="{{ route('cart.index') }}">

        <x-table.wrapper>
            <x-slot:head>
                <tr>
                    <x-table.th><p class="font-bold text-lg"> </p> N°</x-table.th>
                    <x-table.th><p class="font-bold text-lg"> </p> Invoice number</x-table.th>
                    <x-table.th><p class="font-bold text-lg"> </p>Costumer</x-table.th>
                    <x-table.th><p class="font-bold text-lg"> </p>Total Cost</x-table.th>
                    <x-table.th><p class="font-bold text-lg"> </p>N° of items</x-table.th>
                    <x-table.th><p class="font-bold text-lg"> </p> Date of purchase</x-table.th>
                    <x-table.th><p class="font-bold text-lg"> </p>See details</x-table.th>
                </tr>
            </x-slot:head>
            @foreach($sales as $sale)
                <tr>
                    <x-table.td> {{ $loop->index + 1}}</x-table.td>
                    <x-table.td> {{ $sale->invoice_number }}</x-table.td>
                    <x-table.td> <p class="font-bold">{{ $sale->costumer->name }}</p></x-table.td>
                    <x-table.td>${{ $sale->total_price}}</x-table.td>
                    <x-table.td> {{ $sale->details_count}}</x-table.td>
                    <x-table.td> {{ $sale->created_at->format('D M d Y')}}</x-table.td>
                    <x-table.td><a class="text-blue-800 hover:underline" href="/sales/details/{{ $sale->id }}">See details</a></x-table.td>
                </tr>
            @endforeach
        </x-table.wrapper>
    </x-table.layout>
    {{ $sales->links() }}
    <x-flash-message/>
</x-layout>
