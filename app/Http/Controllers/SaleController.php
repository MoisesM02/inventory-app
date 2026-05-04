<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customer = Customer::orderBy('name')->get();
        $sales = Sale::orderBy('created_at', 'desc')
            ->with('customer')
            ->withCount('details');
        if ($request->supplier)
            $sales->where('customer_id', '=', $request->customer );

        return view('sales.index',[
            'sales' => $sales->paginate(10),
            'customers' => $customer
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $details = $sale->details()->with('product')->get();
        return view('sales.show', [
            'sale' => $sale,
            'details' => $details
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function outward(Sale $sale)
    {
        dd($sale);
    }
}
