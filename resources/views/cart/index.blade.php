<x-layout>
    <!-- Dynamic Header -->
    <x-slot:header>{{ ucfirst($type) }} Cart</x-slot:header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Left Side: Search & Cart Items -->
        <div class="md:col-span-2 space-y-6">

            <!-- Pass the type to your Alpine component! -->
            <x-dropdown-search :type="$type" />

            <x-table.wrapper>
                <x-slot:head class="bg-gray-50">
                    <tr>
                        <x-table.th>Product</x-table.th>
                        <!-- Dynamic Column Name -->
                        <x-table.th>Unit {{ $type === 'purchase' ? 'Cost' : 'Price' }}</x-table.th>
                        <x-table.th>Qty</x-table.th>
                        <x-table.th>Subtotal</x-table.th>
                        <x-table.th></x-table.th>
                    </tr>
                </x-slot:head>

                @forelse($cartItems as $item)
                    <tr>
                        <x-table.td>{{ $item->product->name }}</x-table.td>
                        <x-table.td>${{ number_format($item->unit_price, 2) }}</x-table.td>
                        <x-table.td>{{ $item->quantity }}</x-table.td>
                        <x-table.td>${{ number_format($item->getSubtotal(), 2) }}</x-table.td>
                        <x-table.td>
                            <form action="{{ route('cart.destroy', ['type' => $type, 'productId' => $item->product->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Remove</button>
                            </form>
                        </x-table.td>
                    </tr>
                @empty
                    <tr>
                        <x-table.td colspan="5" class="text-center py-4 text-gray-500">
                            Your {{ $type }} cart is empty.
                        </x-table.td>
                    </tr>
                @endforelse
            </x-table.wrapper>
        </div>

        <!-- Right Side: Checkout Summary -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 h-fit">
            <h3 class="text-lg font-bold mb-4">Summary</h3>

            <div class="flex justify-between items-center mb-6 text-xl font-bold">
                <span>Total:</span>
                <span>${{ number_format($grandTotal, 2) }}</span>
            </div>


            <form action="{{ $type === 'purchase' ? route('purchases.store') : route('sales.store') }}" method="POST">
                @csrf
                @if($type === 'purchase')
                    <!-- Purchase specific fields -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Supplier</label>
                        <select name="supplier_id" class="w-full border-gray-300 rounded-md" required>
                            <option value="">Select Supplier...</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Invoice Number</label>
                        <input type="text" name="invoice_number" class="w-full border-gray-300 rounded-md" required>
                    </div>

                @else
                    <!-- Sale specific fields -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Customer (Optional)</label>
                        <select name="customer_id" class="w-full border-gray-300 rounded-md">
                            <option value="">Walk-in Customer</option>
                            <!-- Assuming you eventually pass $customers from the CartController -->
                            @if(isset($customers))
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                @endif

                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 disabled:opacity-50" @if($cartItems->isEmpty()) disabled @endif>
                    Process {{ ucfirst($type) }}
                </button>
            </form>
        </div>

    </div>
</x-layout>
