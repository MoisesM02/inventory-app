<?php

namespace App\DTO;

use App\Models\Product;
readonly class CartItemDTO
{
    public function __construct(
        public Product $product,
        public int $quantity,
        public ?string $type = "purchase",
    ){}

    public function getSubtotal(): float
    {
        if($this->type == "purchase")
            return  $this->product->cost;
        elseif($this->type == "sale")
            return $this->quantity * $this->product->cost;
    }
}
