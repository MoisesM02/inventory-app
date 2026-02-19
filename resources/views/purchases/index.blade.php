<x-layout>
    <x-slot:header>Purchases</x-slot:header>

    <x-table.layout
        :filters="$suppliers"
        title="Purchases"
        filter-text="Filter by supplier:"
        description="All purchases made"
        button-text="Add new purchase"
        filter-name="supplier"
        button-url="{{ route('cart.index') }}">

        <x-table.wrapper>
            <x-slot:head>
                <tr>
                    <x-table.th><p class="font-bold text-lg"> </p> N°</x-table.th>
                    <x-table.th><p class="font-bold text-lg"> </p> Invoice number</x-table.th>
                    <x-table.th><p class="font-bold text-lg"> </p>Supplier</x-table.th>
                    <x-table.th><p class="font-bold text-lg"> </p>Total Cost</x-table.th>
                    <x-table.th><p class="font-bold text-lg"> </p>N° of items</x-table.th>
                    <x-table.th><p class="font-bold text-lg"> </p> Date of purchase</x-table.th>
                    <x-table.th><p class="font-bold text-lg"> </p>See details</x-table.th>
                </tr>
            </x-slot:head>
            @foreach($purchases as $purchase)
                <tr>
                    <x-table.td> {{ $loop->index + 1}}</x-table.td>
                    <x-table.td> {{ $purchase->invoice_number }}</x-table.td>
                    <x-table.td> <p class="font-bold">{{ $purchase->supplier->name }}</p></x-table.td>
                    <x-table.td>${{ $purchase->total_cost}}</x-table.td>
                    <x-table.td> {{ $purchase->details_count}}</x-table.td>
                    <x-table.td> {{ $purchase->created_at->format('D M d Y')}}</x-table.td>
                    <x-table.td><a class="text-blue-800 hover:underline" href="/purchases/details/{{ $purchase->id }}">See details</a></x-table.td>
                </tr>
            @endforeach
        </x-table.wrapper>
    </x-table.layout>
    {{ $purchases->links() }}
<x-flash-message/>
</x-layout>
