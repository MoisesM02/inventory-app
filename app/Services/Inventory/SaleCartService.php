<?php

namespace App\Services\Inventory;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;

class SaleCartService extends BaseCartService
{
    public function __construct()
    {
        $this->sessionKey = 'sale_cart';
    }

    public function processTransaction(array $data): bool
    {
        try {
            DB::beginTransaction();

            $sale = Sale::create([
                // 'customer_id' => $data['customer_id'] ?? null,
                'total_amount' => $this->calculateTotal(),
                'status' => 'completed',
            ]);

            foreach ($this->getItems() as $item) {
                $sale->details()->create([
                    'product_id' => $item->product->id,
                    'quantity'   => $item->quantity,
                    'unit_price' => $item->unit_price,
                ]);

                // Decrease stock safely
                $product = Product::lockForUpdate()->findOrFail($item->product->id);
                if ($product->stock < $item->quantity) {
                    throw new Exception("Not enough stock for " . $product->name);
                }
                $product->decrement('stock', $item->quantity);
            }

            DB::commit();
            $this->clear();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
