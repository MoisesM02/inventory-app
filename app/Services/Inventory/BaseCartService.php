<?php

namespace App\Services\Inventory;

use App\Contracts\CartInterface;
use App\DTO\CartItemDTO;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

abstract class BaseCartService implements CartInterface
{
    protected string $sessionKey;

    public function addItem(int $productId, int $quantity, float $unitPrice): void
    {
        $cart = Session::get($this->sessionKey, []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
            $cart[$productId]['unit_price'] = $unitPrice;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity,
                'unit_price' => $unitPrice
            ];
        }

        Session::put($this->sessionKey, $cart);
    }

    public function getItems(): Collection
    {
        $cart = Session::get($this->sessionKey, []);
        if (empty($cart)) return collect();

        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $dtoCollection = collect();

        foreach ($cart as $id => $data) {
            if (isset($products[$id])) {
                $dtoCollection->push(new CartItemDTO(
                    product: $products[$id],
                    quantity: $data['quantity'],
                    unit_price: $data['unit_price']
                ));
            }
        }

        return $dtoCollection;
    }

    public function removeItem(int $productId): void
    {
        $cart = Session::get($this->sessionKey, []);
        unset($cart[$productId]);
        Session::put($this->sessionKey, $cart);
    }

    public function clear(): void
    {
        Session::forget($this->sessionKey);
    }

    public function calculateTotal(): float
    {
        return $this->getItems()->sum(fn(CartItemDTO $item) => $item->getSubtotal());
    }

    abstract public function processTransaction(array $data): bool;
}
