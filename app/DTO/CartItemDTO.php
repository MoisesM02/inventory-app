<?php

namespace App\DTO;

use App\Models\Product;
readonly class CartItemDTO
{
    public function __construct(
        public Product $product,
        public int $quantity,
    ){}

    public function getSubtotal(): float
    {
        return $this->quantity * $this->product->cost;
    }
}
