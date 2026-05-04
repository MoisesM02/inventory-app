<x-layout>
    <x-slot:header>Sale detail</x-slot:header>
    <x-table.layout
        :title="'Invoice number: ' . $sale->invoice_number"
        :description="'Purchase made to ' . $sale->costumer->name . ' on ' .  date_format($sale->created_at , 'D, M d Y') "
    >
        <x-table.wrapper>
            <x-slot:head class="bg-gray-50">
                <tr>
                    <x-table.th>N°</x-table.th>
                    <x-table.th>Product</x-table.th>
                    <x-table.th>Product Price</x-table.th>
                    <x-table.th>Qty.</x-table.th>
                </tr>
            </x-slot:head>

            @foreach($details as $detail)
                <tr>
                    <x-table.td> {{ $loop->iteration }}</x-table.td>
                    <x-table.td> {{ $detail->product->name }} </x-table.td>
                    <x-table.td>${{ number_format($detail->price, 2) }}</x-table.td>
                    <x-table.td> {{ $detail->quantity }} <span class="text-xs text-gray-600/75">({{$detail->product->unit}})</span></x-table.td>
                </tr>
            @endforeach

            <x-slot:foot>
                <tr>
                    <x-table.td><span class="font-bold text-lg">Total</span></x-table.td>
                    <x-table.td></x-table.td>
                    <x-table.td>${{ number_format($sale->total_price , 2) }}</x-table.td>
                    <x-table.td>{{ $details->sum('quantity') }} product(s)</x-table.td>
                </tr>
            </x-slot:foot>
        </x-table.wrapper>
    </x-table.layout>
    <x-form.modal-confirm
        :action="route('sales.return', $sale)"
    >
        <x-form.button class="text-white hover:bg-red-900 bg-red-700 font-medium text-sm" type="button">Return sale</x-form.button>
    </x-form.modal-confirm>
</x-layout>
