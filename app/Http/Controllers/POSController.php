<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\POSSales;
use App\Models\POSSaleItems;

class POSController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('pos.index', compact('products'));
    }

    public function checkout(Request $request)
    {
        $cart = json_decode($request->cart, true);

        $total = 0;

        foreach ($cart as $item) {
            $product = Products::find($item['id']);

            if ($product->stock < $item['quantity']) {
                return back()->with('error', $product->name . ' insufficient stock!');
            }

            $total += $item['price'] * $item['quantity'];
        }

        $sale = POSSales::create([
            'total' => $total
        ]);

        foreach ($cart as $item) {
            $product = Products::find($item['id']);

            $product->stock -= $item['quantity'];
            $product->save();

            POSSaleItems::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        return back()->with('success', 'Sale completed!');
    }
}
