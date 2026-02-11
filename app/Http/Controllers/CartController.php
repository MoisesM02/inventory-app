<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartService $cartService)
    {
        $cartItems = $cartService->getCartContents();
        $suppliers = Supplier::orderBy('name')->get();
        //
        $grandTotal = $cartItems->sum(fn($item) => $item->getSubtotal());

        return view('cart.index',
            [
                'cartItems' => $cartItems,
                'grandTotal' => $grandTotal,
                'suppliers' => $suppliers,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CartService $cartService)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0' // New validation
        ]);

        $cartService->add(
            $request->product_id,
            $request->quantity,
            $request->cost
        );

        return redirect()->route('cart.index')->with('success', 'Item added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([]);
        }

        $products = Product::query()
            ->where('name', 'like', "%{$query}%")
            ->orWhere('code', 'like', "{$query}%") // Assuming you have a 'code' column
            ->orWhere('id', $query)
            ->take(10) // Limit results to keep it fast
            ->get(['id', 'name', 'code', 'cost']); // Only fetch what we need

        return response()->json($products);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productId, CartService $cartService)
    {
        $cartService->remove($productId);

        return redirect()->route('cart.index')
            ->with('success', 'Item removed.');
    }
}
