<?php

namespace App\Factories;

use App\Contracts\CartInterface;
use App\Services\Inventory\PurchaseCartService;
use App\Services\Inventory\SaleCartService;
use InvalidArgumentException;

class CartFactory
{
    public static function make(string $type): CartInterface
    {
        return match ($type) {
            'purchase' => new PurchaseCartService(),
            'sale'     => new SaleCartService(),
            default    => throw new InvalidArgumentException("Invalid cart type: {$type}"),
        };
    }
}
