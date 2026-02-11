<?php
namespace App\Services;

use App\DTO\CartItemDTO;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartService
{
    const SESSION_KEY = 'shopping_cart';

    public function add(int $productId, int $quantity, ?float $customCost = 0) : void
    {
        $cart = Session::get(self::SESSION_KEY, []);

        // Logic: If item exists, update it. If not, create it.
        // Note: This logic overwrites the old price if the item was already in cart.
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
            $cart[$productId]['cost'] = $customCost; //Update the cost if already in the cart
        } else {
            $cart[$productId] = [
                'quantity' => $quantity,
                'cost' => $customCost
            ];
        }

        Session::put(self::SESSION_KEY, $cart);
    }

    public function getCartContents(): Collection
    {
        $cart = Session::get(self::SESSION_KEY, []);
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();

        return $products->map(function ($product) use ($cart) {
            // Use the stored price from session, not the database price
            $sessionData = $cart[$product->id];

            // We clone the product to avoid modifying the actual Eloquent instance permanently
            $productWithCustomPrice = $product->replicate();
            $productWithCustomPrice->id = $product->id; // replicate clears ID
            $productWithCustomPrice->cost = $sessionData['cost'];

            return new CartItemDTO(
                product: $productWithCustomPrice,
                quantity: $sessionData['quantity']
            );
        });
    }

    public function remove(int $productId): void
    {
        $cart = Session::get(self::SESSION_KEY, []);
        unset($cart[$productId]);
        Session::put(self::SESSION_KEY, $cart);
    }

    public function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }
}
