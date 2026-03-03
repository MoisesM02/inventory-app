<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::simplePaginate(10);
        return view('suppliers.index',
        ['suppliers' => $suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supplierAttributes = $request->validate([
           'name' => ['required', 'string', 'max:64'],
           'address' => ['required', 'string', 'max:64'],
           'email' => ['nullable', 'string', 'max:64', 'unique:suppliers,email'],
           'phone' => ['nullable', 'string', 'max:64'],
            'contact_person' => ['nullable', 'string', 'max:64'],
        ]);

        Supplier::create($supplierAttributes);

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', [
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplierAttributes = $request->validate([
            'name' => ['required', 'string', 'max:64'],
            'address' => ['required', 'string', 'max:64'],
            'email' => ['nullable', 'string', 'max:64', Rule::unique('suppliers', 'email')->ignore($supplier->id)],
            'phone' => ['nullable', 'string', 'max:64'],
            'contact_person' => ['nullable', 'string', 'max:64'],
        ]);
        $supplier->update($supplierAttributes);
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier has been deleted');
    }
}
