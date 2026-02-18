<x-layout>
    <x-slot:header>Purchase detail</x-slot:header>
    <x-table.layout
        :title="'Invoice number: ' . $purchase->invoice_number"
        :description="'Purchase made to ' . $purchase->supplier->name . ' on ' .  date_format($purchase->created_at , 'D, M d Y') "
    >
        <x-table.wrapper>
            <thead class="bg-gray-50">
                <tr>
                    <x-table.th>N°</x-table.th>
                    <x-table.th>Product</x-table.th>
                    <x-table.th>Products Cost</x-table.th>
                    <x-table.th>Qty.</x-table.th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($details as $detail)
                    <tr>
                        <x-table.td> {{ $loop->iteration }}</x-table.td>
                        <x-table.td> {{ $detail->product->name }} </x-table.td>
                        <x-table.td>${{ number_format($detail->cost, 2) }}</x-table.td>
                        <x-table.td> {{ $detail->quantity }} <span class="text-xs text-gray-600/75">({{$detail->product->unit}})</span></x-table.td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <x-table.td><span class="font-bold text-lg">Total</span></x-table.td>
                    <x-table.td></x-table.td>
                    <x-table.td>${{ number_format($purchase->total_cost , 2) }}</x-table.td>
                    <x-table.td>{{ $details->sum('quantity') }} products</x-table.td>
                </tr>
            </tfoot>
        </x-table.wrapper>
    </x-table.layout>
</x-layout>
