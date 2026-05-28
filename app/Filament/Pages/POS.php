<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\PosSales;
use App\Models\PosSaleItems;

class POSController extends Controller
{
    // Changed from index() to pos() to match your Route error
    public function pos()
    {
        return view('pos.pos', [
            'products' => Products::all()
        ]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'cart' => 'required|array',
            'total' => 'required|numeric',
            'cash_received' => 'required|numeric',
        ]);

        if ($request->cash_received < $request->total) {
            return response()->json(['error' => 'Insufficient payment'], 400);
        }

        DB::beginTransaction();

        try {
            $sale = PosSales::create([
                'invoice_no' => 'INV-' . now()->format('YmdHis'),
                'total_amount' => $request->total,
                'cash_received' => $request->cash_received,
                'change_amount' => $request->cash_received - $request->total,
                'payment_method' => $request->payment_method ?? 'cash',
                'status' => 'completed',
            ]);

            foreach ($request->cart as $item) {
                $product = Products::findOrFail($item['id']);

                if ($product->stock < $item['qty']) {
                    throw new \Exception("Not enough stock for {$product->name}");
                }

                PosSaleItems::create([
                    'pos_sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $item['qty'],
                    'price' => $product->price,
                    'subtotal' => $item['qty'] * $product->price,
                ]);

                // Reduce the stock in the database
                $product->decrement('stock', $item['qty']);
            }

            DB::commit();
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
