<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\PosSales;
use App\Models\PosSaleItems;

class POSController extends Controller
{
    public function homepage()
    {
        $products = Products::where('is_active', true)
            ->orderBy('product_name')
            ->get();

        return view('pos.homepage', compact('products'));
    }

    public function index()
    {
        $products = Products::where('is_active', true)
            ->orderBy('product_name')
            ->get();

        return view('pos.pos', compact('products'));
    }

    public function checkout(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Checkout
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'cart' => 'required|array|min:1',
            'total' => 'required|numeric|min:0',
            'cash_received' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            /*
            |--------------------------------------------------------------------------
            | Get Payment Information
            |--------------------------------------------------------------------------
            */

            $totalAmount = (float) $request->total;
            $cashReceived = (float) $request->cash_received;

            /*
            |--------------------------------------------------------------------------
            | Check Cash Payment
            |--------------------------------------------------------------------------
            */

            if ($cashReceived < $totalAmount) {
                throw new \Exception(
                    'Insufficient payment. Please enter enough cash.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Calculate Change
            |--------------------------------------------------------------------------
            */

            $changeAmount = $cashReceived - $totalAmount;

            /*
            |--------------------------------------------------------------------------
            | Generate Invoice Number
            |--------------------------------------------------------------------------
            */

            $invoiceNo = 'INV-' . now()->format('YmdHis');

            /*
            |--------------------------------------------------------------------------
            | Calculate Subtotal
            |--------------------------------------------------------------------------
            */

            $subtotal = 0;

            foreach ($request->cart as $item) {

                $product = Products::findOrFail($item['id']);

                $quantity = (int) $item['qty'];

                /*
                |--------------------------------------------------------------------------
                | Validate Quantity
                |--------------------------------------------------------------------------
                */

                if ($quantity <= 0) {
                    throw new \Exception(
                        "Invalid quantity for {$product->product_name}."
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Check Stock
                |--------------------------------------------------------------------------
                */

                if ($product->quantity < $quantity) {
                    throw new \Exception(
                        "Not enough stock for {$product->product_name}. " .
                        "Available stock: {$product->quantity}."
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Product Price
                |--------------------------------------------------------------------------
                */

                $price = (float) $product->selling_price;

                /*
                |--------------------------------------------------------------------------
                | Calculate Item Subtotal
                |--------------------------------------------------------------------------
                */

                $subtotal += $quantity * $price;
            }

            /*
            |--------------------------------------------------------------------------
            | Create POS Sale
            |--------------------------------------------------------------------------
            |
            | These columns match your actual pos_sales table:
            |
            | invoice_no
            | subtotal
            | discount
            | tax
            | total
            | amount_paid
            | change_amount
            | payment_status
            | status
            |
            */

            $sale = PosSales::create([
                'invoice_no' => $invoiceNo,

                'subtotal' => $subtotal,

                'discount' => 0,

                'tax' => 0,

                'total' => $totalAmount,

                'amount_paid' => $cashReceived,

                'change_amount' => $changeAmount,

                'payment_status' => 'paid',

                'status' => 'completed',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Create Sale Items
            |--------------------------------------------------------------------------
            */

            foreach ($request->cart as $item) {

                $product = Products::findOrFail($item['id']);

                $quantity = (int) $item['qty'];

                $price = (float) $product->selling_price;

                $itemSubtotal = $quantity * $price;

                /*
                |--------------------------------------------------------------------------
                | Save Sale Item
                |--------------------------------------------------------------------------
                */

                PosSaleItems::create([
                    'pos_sale_id' => $sale->id,

                    'product_id' => $product->id,

                    'product_name' => $product->product_name,

                    'sku' => $product->sku ?? null,

                    'quantity' => $quantity,

                    'price' => $price,

                    'discount' => 0,

                    'subtotal' => $itemSubtotal,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Reduce Inventory
                |--------------------------------------------------------------------------
                */

                $product->decrement(
                    'quantity',
                    $quantity
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Commit Transaction
            |--------------------------------------------------------------------------
            */

            DB::commit();

            /*
            |--------------------------------------------------------------------------
            | Return Success Response
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => true,

                'message' => 'Sale completed successfully.',

                'invoice_no' => $sale->invoice_no,

                'sale_id' => $sale->id,

                'total_amount' => number_format(
                    $totalAmount,
                    2,
                    '.',
                    ''
                ),

                'cash_received' => number_format(
                    $cashReceived,
                    2,
                    '.',
                    ''
                ),

                'change_amount' => number_format(
                    $changeAmount,
                    2,
                    '.',
                    ''
                ),

                'payment_status' => 'paid',
            ]);

        } catch (\Exception $e) {

            /*
            |--------------------------------------------------------------------------
            | Rollback Transaction
            |--------------------------------------------------------------------------
            */

            DB::rollBack();

            return response()->json([
                'success' => false,

                'error' => $e->getMessage(),

            ], 500);
        }
    }
}
