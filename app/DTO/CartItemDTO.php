<?php

namespace App\DTO;

use App\Models\Product;

readonly class CartItemDTO
{
    public function __construct(
        public Product $product,
        public int $quantity,
        public float $unit_price,
    ){}

    public function getSubtotal(): float
    {
        return $this->quantity * $this->unit_price;
    }
}
