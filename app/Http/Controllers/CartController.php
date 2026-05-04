<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Factories\CartFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 *This class manages the functionality of both the purchase and sales carts
 *It implements the factory method to create the appropriate service for each case.
*/
class CartController extends Controller
{
    /**
     * Gets all the items stored in the cart, either for purchases or sales
     * and pass them to the view cart.index
     *
     * @param string $type
     * @return view The view that contains the cart
     *
     */
    public function index(string $type) : View
    {
        $cartService = CartFactory::make($type);

        $cartItems = $cartService->getItems();
        $grandTotal = $cartService->calculateTotal();

        $suppliers = $type === 'purchase' ? Supplier::orderBy('name')->get() : collect();

        return view('cart.index', [
            'cartItems'  => $cartItems,
            'grandTotal' => $grandTotal,
            'suppliers'  => $suppliers,
            'type'       => $type, // Pass type to the view for conditional UI
        ]);
    }

    /**
     * Stores an item in the cart session.
     *
     * @param Request $request Contains the product basic information.
     * @param string $type Determines if it is a purchase or a sale.
     * @return RedirectResponse Redirect to cart view with a message of success.
     */
    public function store(Request $request, string $type)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity'   => ['required', 'integer', 'min:1'],
            'unit_price' => ['required', 'numeric', 'min:0']
        ]);

        $cartService = CartFactory::make($type);

        $cartService->addItem(
            $request->product_id,
            $request->quantity,
            $request->unit_price
        );

        return redirect()->route('cart.index', ['type' => $type])
            ->with('success', ucfirst($type) . ' item added');
    }

    /**
     * Search the database for the product required by the cart.
     * @param Request $request The string used to find the product
     * @return JsonResponse JSON used by AlpineJS to manage the functionality of the cart
     */
    public function show(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([]);
        }

        $products = Product::query()
            ->where('name', 'like', "%{$query}%")
            ->orWhere('code', 'like', "{$query}%")
            ->orWhere('id', $query)
            ->take(10)
            ->get(['id', 'name', 'code', 'cost', 'price', 'unit']);

        return response()->json($products);
    }

    /**
     * Removes item from the cart.
     * @param string $type Determines if it is a purchase or a sale
     * @param int $productId Product to be removed
     * @return RedirectResponse Redirects to the cart view with a message of success.
     */
    public function destroy(string $type, int $productId)
    {
        $cartService = CartFactory::make($type);
        $cartService->removeItem($productId);

        return redirect()->route('cart.index', ['type' => $type])
            ->with('success', 'Item removed.');
    }
}
