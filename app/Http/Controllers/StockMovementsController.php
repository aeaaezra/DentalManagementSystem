<?php

namespace App\Http\Controllers;

use App\Models\StockMovements;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StockMovementsController extends Controller
{
    public function index(Request $request): View
    {
        $query = StockMovements::query()
            ->with(['product', 'creator']);

        if ($search = trim((string) $request->query('search', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('notes', 'like', "%{$search}%")
                    ->orWhere('reference_type', 'like', "%{$search}%")
                    ->orWhere('reference_id', 'like', "%{$search}%")
                    ->orWhereHas('product', function ($product) use ($search) {
                        $product->where('product_name', 'like', "%{$search}%")
                            ->orWhere('sku', 'like', "%{$search}%")
                            ->orWhere('barcode', 'like', "%{$search}%");
                    })
                    ->orWhereHas('creator', function ($creator) use ($search) {
                        $creator->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $types = [
            'in',
            'out',
            'adjustment',
            'return',
            'expired',
            'damaged',
        ];

        if (in_array($request->query('type'), $types, true)) {
            $query->where('movement_type', $request->query('type'));
        }

        $from = $request->query('from');
        if (is_string($from) &&
            preg_match('/^\d{4}-\d{2}-\d{2}$/', $from) &&
            strtotime($from) !== false) {
            $query->where('movement_date', '>=', $from . ' 00:00:00');
        }

        $to = $request->query('to');
        if (is_string($to) &&
            preg_match('/^\d{4}-\d{2}-\d{2}$/', $to) &&
            strtotime($to) !== false) {
            $query->where('movement_date', '<=', $to . ' 23:59:59');
        }

        $movements = $query
            ->orderByDesc('movement_date')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        $summary = [
            'total' => StockMovements::count(),
            'in' => StockMovements::where('movement_type', 'in')->count(),
            'out' => StockMovements::where('movement_type', 'out')->count(),
            'adjustments' => StockMovements::where(
                'movement_type',
                'adjustment'
            )->count(),
        ];

        return view('inventory.stock-movements', compact(
            'movements',
            'summary'
        ));
    }
}
