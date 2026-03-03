@php
//  To calculate the item number we use the arithmetic succession formula (An = A0+(n-1)*d)
// Where An = the n term in the succession, A0 = the first term in the succession,
// n = is the iteration and d = the difference between each term.
    $pageAggregator = ((request()->get('page') ?? 1) - 1) * 10
@endphp

<x-layout>
    <x-slot:header>Suppliers</x-slot:header>
    <x-table.layout
        title="Manage your suppliers"
        description="Create or modify your suppliers' information"
        button-text="Create supplier"
        button-url="/suppliers/create"
    >

        <x-table.wrapper>
            <x-slot:head>
                <tr>
                    <x-table.th>N°</x-table.th>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Phone</x-table.th>
                    <x-table.th>Contact Person</x-table.th>
                    <x-table.th>Actions</x-table.th>
                </tr>
            </x-slot:head>
            @foreach($suppliers as $supplier)
                <tr>
                    <x-table.td> {{ $loop->iteration + $pageAggregator}}</x-table.td>
                    <x-table.td> {{ $supplier->name }}</x-table.td>
                    <x-table.td> {{ $supplier->phone ?? 'Not defined' }}</x-table.td>
                    <x-table.td> {{ $supplier->contact_person ?? 'Not defined' }}</x-table.td>
                    <x-table.td> <x-link href="{{ route('suppliers.edit', $supplier) }}">Modify</x-link></x-table.td>
                </tr>
            @endforeach

        </x-table.wrapper>
    </x-table.layout>
    {{ $suppliers->links() }}
</x-layout>
