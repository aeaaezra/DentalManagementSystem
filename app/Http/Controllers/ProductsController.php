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
     * Display customer shop.
     */
    public function shop(Request $request)
    {
        $query = Products::query()
            ->where('is_active', true);


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('product_name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('brand_name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Category
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('category') &&
            $request->category !== 'All Items'
        ) {

            $query->where(
                'category',
                $request->category
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Stock Filter
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('in_stock')) {

            $query->where(
                'quantity',
                '>',
                0
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Price Filter
        |--------------------------------------------------------------------------
        */

        switch ($request->price) {

            case 'under500':

                $query->where(
                    'selling_price',
                    '<',
                    500
                );

                break;


            case '500to2000':

                $query->whereBetween(
                    'selling_price',
                    [500, 2000]
                );

                break;


            case 'above2000':

                $query->where(
                    'selling_price',
                    '>',
                    2000
                );

                break;
        }


        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        switch ($request->sort) {

            case 'low':

                $query->orderBy(
                    'selling_price',
                    'asc'
                );

                break;


            case 'high':

                $query->orderBy(
                    'selling_price',
                    'desc'
                );

                break;


            case 'name':

                $query->orderBy(
                    'product_name',
                    'asc'
                );

                break;


            default:

                $query->orderBy(
                    'id',
                    'desc'
                );

                break;
        }


        /*
        |--------------------------------------------------------------------------
        | Get Products
        |--------------------------------------------------------------------------
        */

        $products = $query
            ->paginate(12)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Get Categories
        |--------------------------------------------------------------------------
        */

        $categories = Products::query()
            ->where('is_active', true)
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');


        /*
        |--------------------------------------------------------------------------
        | Customer Products Blade
        |--------------------------------------------------------------------------
        */

        return view(
            'customer.products',
            compact(
                'products',
                'categories'
            )
        );
    }


    /**
     * Get products for POS AJAX/API.
     */
    public function products(Request $request)
    {
        $query = Products::query()
            ->where('is_active', true);


        // Search by product name, SKU, or brand

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'product_name',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'sku',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'brand_name',
                    'like',
                    "%{$search}%"
                );

            });
        }


        // Category

        if (
            $request->filled('category') &&
            $request->category !== 'All'
        ) {

            $query->where(
                'category',
                $request->category
            );
        }


        // Get products

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
