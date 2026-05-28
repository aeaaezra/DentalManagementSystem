<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ IMAGE UPLOAD FIX
        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images/products'), $filename);

            $imagePath = 'images/products/' . $filename;
        }

        // ✅ SAVE TO DATABASE
        Products::create([
            'supplier_id' => $request->supplier_id,
            'sku' => $request->sku,
            'product_name' => $request->product_name,
            'brand_name' => $request->brand_name,
            'category' => $request->category,
            'description' => $request->description,
            'cost_price' => $request->cost_price,
            'selling_price' => $request->selling_price,
            'unit' => $request->unit,
            'reorder_level' => $request->reorder_level,
            'expiration_date' => $request->expiration_date,

            // IMPORTANT FIX (this prevents your error)
            'image' => $imagePath,

            'is_active' => 1,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        return view('products.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        return view('products.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        // IMAGE UPDATE
        $imagePath = $products->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images/products'), $filename);

            $imagePath = 'images/products/' . $filename;
        }

        $products->update([
            'supplier_id' => $request->supplier_id,
            'sku' => $request->sku,
            'product_name' => $request->product_name,
            'brand_name' => $request->brand_name,
            'category' => $request->category,
            'description' => $request->description,
            'cost_price' => $request->cost_price,
            'selling_price' => $request->selling_price,
            'unit' => $request->unit,
            'reorder_level' => $request->reorder_level,
            'expiration_date' => $request->expiration_date,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        $products->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
