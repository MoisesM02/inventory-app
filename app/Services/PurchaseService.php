<?php
namespace App\Services;

use App\DTO\CartItemDTO;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class PurchaseService
{
    private float $total = 0;
    private int $numberItems = 0;

    public function __construct(public Collection $details = new Collection()){}
    public function process(Collection $products, array $data): Bool
    {
//        $this->total = $products->sum(fn ($item) => $item->getSubtotal());

        //Begin transaction in case of failure
        DB::beginTransaction();

        //Generate new purchase
        $purchase = new Purchase();
        $purchase->invoice_number = $data['invoice_number'];
        $purchase->description = $data['description'];
        $purchase->supplier_id = $data['supplier_id'];

        //Create purchase details for each item
        foreach ($products as $item)
        {
            $this->total += $item->getSubtotal();
            $purchaseDetail = new PurchaseDetail([
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'cost' => $item->getSubtotal(),
            ]);
            $this->details->push($purchaseDetail);

            //Update Average cost of product
            if(! $this->newProductCost($item))
            {
                DB::rollBack();
                throw new Exception('Error saving purchase detail', 400);
            }
        }
        //Save the purchase
        $purchase->total_cost = $this->total;
        $purchase->save();

        //Save the purchase details
        foreach ($this->details as $detail)
        {
                $detail->purchase()->associate($purchase);
                $detail->save();
        }
        if ($purchase->details->count() === $products->count())
        {
            DB::commit();
            return true;
        }
        DB::rollBack();
        return false;
    }

    private function newProductCost(CartItemDTO $item) : bool
    {
            $purchaseCost = $item->getSubtotal();
            $product = Product::find($item->product->id);
            //newAverageCost = (currentInventoryValue + costOfPurchase) / (newStock)
            $newAverageCost = (($product->stock * $product->cost) + ($purchaseCost)) / ($product->stock + $item->quantity);
            $product->stock += $item->quantity;
            $product->cost = $newAverageCost;
            return $product->save();
    }
}
