<?php

namespace App\Services\Inventory;

use App\DTO\CartItemDTO;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;

class PurchaseCartService extends BaseCartService
{
    public function __construct()
    {
        $this->sessionKey = 'purchase_cart';
    }

    public function processTransaction(array $data): bool
    {
        try {
            DB::beginTransaction();

            $purchase = Purchase::create([
                'supplier_id' => $data['supplier_id'] ?? null,
                'total_cost' => $this->calculateTotal(),
                'invoice_number' => $data['invoice_number'] ?? null,
                'description' => $data['description'] ?? null,
            ]);

            foreach ($this->getItems() as $item) {
                $purchase->details()->create([
                    'product_id' => $item->product->id,
                    'quantity'   => $item->quantity,
                    'cost'  => $item->unit_price,
                ]);

                // Increase stock and adjust average cost of product
                $this->updateAverageCostAndStock($item);
            }

            DB::commit();
            $this->clear();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    private function updateAverageCostAndStock(CartItemDTO $item): void
    {
        // 1. Lock the row so no one else can modify this product while we calculate
        $product = Product::lockForUpdate()->findOrFail($item->product->id);

        // 2. Perform the Moving Average math
        $currentInventoryValue = $product->stock * $product->cost;
        $purchaseValue         = $item->getSubtotal();
        $newStock              = $product->stock + $item->quantity;

        // Safety check: Prevent division by zero if inventory was somehow negative
        $newAverageCost = $newStock > 0
            ? ($currentInventoryValue + $purchaseValue) / $newStock
            : $item->unit_price;

        // 3. Apply the updates and save
        $product->stock = $newStock;
        $product->cost  = $newAverageCost;

        $product->save();
    }
}
