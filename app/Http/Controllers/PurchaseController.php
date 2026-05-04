<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Factories\CartFactory;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::orderBy('name')->get();
        $purchases = Purchase::orderBy('created_at', 'desc')
            ->with('supplier')
            ->withCount('details');

        if ($request->supplier) {
            $purchases->where('supplier_id', '=', $request->supplier);
        }

        return view('purchases.index',[
            'purchases' => $purchases->paginate(10),
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the specific purchase header data
        $validatedData = $request->validate([
            'supplier_id'    => ['required','integer', 'exists:suppliers,id'],
            'invoice_number' => ['required', 'string', 'max:32', 'unique:purchases,invoice_number'],
            'description'    => ['nullable', 'string', 'max:255'],
        ]);

        // Instantiate the specific Purchase Cart Service
        $cartService = CartFactory::make('purchase');

        if ($cartService->getItems()->isEmpty()) {
            return redirect()->route('cart.index', ['type' => 'purchase'])
                ->with('error', 'Your purchase cart is empty.');
        }

        // Process the transaction (This handles creating the Purchase, Details, and Stock)
        $processed = $cartService->processTransaction($validatedData);

        if ($processed) {
            return redirect()->route('purchases.index')
                ->with('success', 'Purchase stored successfully!');
        }

        return redirect()->route('cart.index', ['type' => 'purchase'])
            ->with('error', 'There was a problem processing the purchase.');
    }

    public function show(Purchase $purchase)
    {
        // Your existing show method is perfect. It relies on Eloquent,
        // not the cart, which is exactly how it should be.
        $details = $purchase->details()->with('product')->get();
        return view('purchases.show', [
            'purchase' => $purchase,
            'details' => $details
        ]);
    }

    public function outward(Purchase $purchase)
    {
        $details = $purchase->details()->with('product')->get();
        dd($details);
    }
}
