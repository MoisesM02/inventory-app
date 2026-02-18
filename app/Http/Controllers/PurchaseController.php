<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Services\CartService;
use App\Services\PurchaseService;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::orderBy('created_at', 'desc')->with('supplier')->withCount('details')->paginate(10);
        return view('purchases.index',[
            'purchases' => $purchases
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CartService $cartService, PurchaseService $purchaseService)
    {
        $validatedData = $request->validate([
            'supplier_id' => ['required','integer', 'exists:suppliers,id'],
            'invoice_number' => ['required', 'string', 'max:32', 'unique:purchases,invoice_number'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $products = $cartService->getCartContents();

        if ($products->isEmpty()) {
            return redirect('/');
        }
        $processed = $purchaseService->process($products, $validatedData);
        $cartService->clear();
        return redirect(route('cart.index'))->with('success', 'Purchase stored successfully!' );
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        $details = $purchase->details()->with('product')->get();
        return view('purchases.show', [
            'purchase' => $purchase,
            'details' => $details
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
