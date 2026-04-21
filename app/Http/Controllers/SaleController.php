<?php

namespace App\Http\Controllers;

use App\Models\Costumer;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $costumers = Costumer::orderBy('name')->get();
        $sales = Sale::orderBy('created_at', 'desc')
            ->with('costumer')
            ->withCount('details');
        if ($request->supplier)
            $sales->where('costumer_id', '=', $request->costumer );

        return view('sales.index',[
            'sales' => $sales->paginate(10),
            'costumers' => $costumers
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
