<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface CartInterface
{
    /**
     * Add an item to the shopping cart.
     * @param int $productId Identifier for the product.
     * @param int $quantity Number of items to be added to the cart.
     * @param float $unitPrice Price per unit.
     * @return void Adds the item to the session.
     */
    public function addItem(int $productId, int $quantity, float $unitPrice): void;

    /**
     * Returns all the items currently in the cart.
     * @return Collection Collection of Product models
     */
    public function getItems(): Collection;

    /**
     * Removes the given item from the cart.
     * @param int $productId Identifier of product to be removed.
     * @return void Removes item from cart.
     */
    public function removeItem(int $productId): void;

    /**
     * Clears the session that stores the cart information
     * @return void
     */
    public function clear(): void;

    /**
     * Iterate through the cart items and get the sum of all the costs.
     * @return float Sum of the cost of all products in cart
     */
    public function calculateTotal(): float;

    /**
     * @param array $data
     * @return bool
     */
    public function processTransaction(array $data): bool;
}
