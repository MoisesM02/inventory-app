<x-layout>
    {{ old('supplier_id') }}
    <div class="container mx-auto px-4 py-8">
        <div>
            <x-form.error name="cost"/>
            <x-form.error name="quantity"/>
            <x-form.error name="product_id"/>
        </div>

        <x-dropdown-search :route="route('cart.search')"/>
        <h1 class="text-3xl font-bold mb-6 mt-4">Shopping Cart</h1>

        @if($cartItems->isEmpty())
            <div class="bg-gray-100 p-6 rounded-lg text-center mt-5">
                <p class="text-gray-600 my-auto">Your purchase cart is empty.</p>
            </div>
        @else

            <div class="flex flex-col lg:flex-row gap-8">

                <div class="w-full lg:w-3/4">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-full whitespace-nowrap">
                                <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cost</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Qty</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td class="px-6 py-4 flex items-center">
                                            {{-- <img src="{{ $item->image_url }}" class="h-10 w-10 rounded mr-3" alt=""> --}}
                                            <span class="font-medium text-gray-900">{{ $item->product->name }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-500">
                                            ${{ number_format($item->getSubtotal(), 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                                <span class="inline-block bg-gray-100 px-3 py-1 rounded-full text-sm font-semibold">
                                                    {{ $item->quantity }}
                                                </span>
                                        </td>
                                        <td class="px-6 py-4 text-right font-medium text-gray-900">
                                            ${{ number_format($item->getSubtotal(), 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <form action="{{ route('cart.destroy', $item->product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/4">
                    <form action="{{ route('purchases.store') }}" method="POST">
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h2 class="text-lg font-bold mb-4">Order Summary</h2>
                            <div class="my-3 flex-row align-items-center space-y-3">
                                <div>
                                    <x-form.label for="invoice_number">Invoice number:</x-form.label>
                                    <x-form.input name="invoice_number"/>
                                </div>
                                <div>
                                    <x-form.label for="description">Description:</x-form.label>
                                    <x-form.input name="description"/>
                                </div>

                            </div>
                            <div class="my-3">
                                <x-form.label for="supplier_id">Supplier:</x-form.label>
                                <x-form.select name="supplier_id" x-for="supplier">
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                    @endforeach
                                </x-form.select>
                            </div>
                            <div class="flex justify-between mb-2 text-gray-600">
                                <span>Subtotal</span>
                                <span>${{ number_format($grandTotal, 2) }}</span>
                            </div>
                            <div class="border-t pt-4 flex justify-between font-bold text-xl mb-6">
                                <span>Total</span>
                                <span>${{ number_format($grandTotal, 2) }}</span>
                            </div>

                                @csrf
                                <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                                    Proceed to Checkout
                                </button>
                        </div>
                    </form>
                </div>

            </div>
        @endif
    </div>

    <x-flash-message/>
</x-layout>
