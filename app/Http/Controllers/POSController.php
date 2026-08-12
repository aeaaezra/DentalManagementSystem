<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\PosSales;
use App\Models\PosSaleItems;

class POSController extends Controller
{
    // ✅ This should match your route: /pos/homepage
    public function homepage()
    {
        return view('pos.homepage', [
            'products' => Products::all()
        ]);
    }

    // ✅ Optional: if you still want a POS page
    public function index()
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

        // ✅ Prevent underpayment
        if ($request->cash_received < $request->total) {
            return response()->json([
                'error' => 'Insufficient payment'
            ], 400);
        }

        try {
            DB::beginTransaction();

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

                // ✅ Check stock
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

                // ✅ Reduce stock
                $product->decrement('stock', $item['qty']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sale completed successfully'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
