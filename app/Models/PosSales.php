<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use DB;
class PosSales extends Model
{
    protected $table = 'pos_sales';

    protected $fillable = [
        'invoice_no',
        'total_amount',
        'cash_received',
        'change_amount',
        'payment_method',
        'status',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'cash_received' => 'decimal:2',
        'change_amount' => 'decimal:2',
    ];

    /**
     * Get the items for the sale.
     */
    public function items(): HasMany
    {
        return $this->hasMany(PosSaleItems::class, 'pos_sale_id');
    }

    public function store(Request $request)
{
    DB::transaction(function () use ($request) {

        $sale = Sale::create([
            'total' => $request->total
        ]);

        foreach ($request->items as $item) {

            $product = Product::findOrFail($item['id']);

            // 🚨 prevent negative stock
            if ($product->stock < $item['qty']) {
                throw new \Exception("Not enough stock for {$product->name}");
            }

            // save item
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);

            // deduct stock
            $product->decrement('stock', $item['qty']);
        }
    });

    return response()->json(['success' => true]);
}
}
