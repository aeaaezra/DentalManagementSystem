<?php

namespace App\Filament\Resources\StockMovements\Pages;

use App\Filament\Resources\StockMovements\StockMovementsResource;
use App\Models\Products;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateStockMovements extends CreateRecord
{
    protected static string $resource = StockMovementsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $product = Products::findOrFail($data['product_id']);

        $stockBefore = (int) $product->quantity;
        $quantity = (int) $data['quantity'];
        $movementType = $data['movement_type'];

        switch ($movementType) {
            case 'in':
            case 'returned':
                $stockAfter = $stockBefore + $quantity;
                break;

            case 'out':
            case 'damaged':
            case 'expired':
                $stockAfter = max(0, $stockBefore - $quantity);
                break;

            case 'adjustment':
                $stockAfter = $quantity;
                break;

            default:
                $stockAfter = $stockBefore;
                break;
        }

        $data['stock_before'] = $stockBefore;
        $data['stock_after'] = $stockAfter;
        $data['movement_date'] = $data['movement_date'] ?? now();
        $data['created_by'] = Auth::id();

        return $data;
    }

    protected function afterCreate(): void
    {
        $movement = $this->record;

        $product = Products::findOrFail($movement->product_id);

        $product->quantity = $movement->stock_after;
        $product->save();
    }
}
