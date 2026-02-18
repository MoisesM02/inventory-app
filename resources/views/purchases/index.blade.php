<x-layout>
    <x-slot:header>Purchases</x-slot:header>

    <x-table.layout
        title="Purchases"
        description="All purchases made"
        button-text="Add new purchase"
        button-url="{{ route('cart.index') }}">

        <x-table.wrapper>
            <thead class="bg-gray-50">
                <tr>
                    <x-table.th>N°</x-table.th>
                    <x-table.th>Invoice number</x-table.th>
                    <x-table.th>Supplier</x-table.th>
                    <x-table.th>Total Cost</x-table.th>
                    <x-table.th>N° of items</x-table.th>
                    <x-table.th>Date of purchase</x-table.th>
                    <x-table.th>See details</x-table.th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($purchases as $purchase)
                <tr>
                    <x-table.td> {{ $loop->index + 1}}</x-table.td>
                    <x-table.td> {{ $purchase->invoice_number }}</x-table.td>
                    <x-table.td> {{ $purchase->supplier->name }}</x-table.td>
                    <x-table.td>${{ $purchase->total_cost}}</x-table.td>
                    <x-table.td> {{ $purchase->details_count}}</x-table.td>
                    <x-table.td> {{ $purchase->created_at->format('D M d Y')}}</x-table.td>
                    <x-table.td><a class="text-blue-800 hover:underline" href="/purchases/details/{{ $purchase->id }}">See details</a></x-table.td>
                </tr>
            @endforeach
            </tbody>
        </x-table.wrapper>

    </x-table.layout>

</x-layout>
