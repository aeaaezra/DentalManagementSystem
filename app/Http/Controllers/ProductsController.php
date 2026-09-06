<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class POSController extends Controller
{
    /**
     * Display POS homepage.
     */
    public function homepage()
    {
        return view('pos.homepage');
    }

    /**
     * Get products for POS.
     */
    public function products(Request $request)
    {
        $query = Products::query()
            ->where('is_active', true);

        // Search by product name, SKU, or brand
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('brand_name', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if (
            $request->filled('category') &&
            $request->category !== 'All'
        ) {
            $query->where('category', $request->category);
        }

        $products = $query
            ->orderBy('product_name')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'sku' => $product->sku,
                    'product_name' => $product->product_name,
                    'brand_name' => $product->brand_name,
                    'category' => $product->category,
                    'description' => $product->description,
                    'unit' => $product->unit,
                    'cost_price' => (float) $product->cost_price,
                    'selling_price' => (float) $product->selling_price,
                    'quantity' => $product->quantity,
                    'reorder_level' => $product->reorder_level,
                    'expiration_date' => $product->expiration_date,
                    'image' => $product->image
                        ? asset($product->image)
                        : null,
                ];
            });

        return response()->json([
            'success' => true,
            'products' => $products,
        ]);
    }
}
