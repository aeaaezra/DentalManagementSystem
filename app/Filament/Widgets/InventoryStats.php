<?php

namespace App\Filament\Widgets;

use App\Models\Products;
use App\Models\Suppliers;
use App\Models\StockMovements;
use App\Models\PurchaseOrder;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InventoryStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = now()->toDateString();
        $next30Days = now()->addDays(30)->toDateString();

        $totalProducts = Products::count();

        $lowStockCount = Products::whereColumn('quantity', '<=', 'reorder_level')->count();

        $expiredProducts = Products::whereDate('expiration_date', '<', $today)
            ->where('quantity', '>', 0)
            ->count();

        $nearExpiry = Products::whereBetween('expiration_date', [$today, $next30Days])
            ->where('quantity', '>', 0)
            ->count();

        $totalSuppliers = Suppliers::count();

        $stockMovementsToday = StockMovements::whereDate('created_at', $today)->count();

        $purchaseOrdersThisMonth = PurchaseOrder::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        return [
            Stat::make('Total Products', $totalProducts)
                ->description('All registered dental supplies')
                ->icon('heroicon-o-archive-box')
                ->color('primary'),

            Stat::make('Low Stock Items', $lowStockCount)
                ->description('Items below reorder level')
                ->icon('heroicon-o-exclamation-triangle')
                ->color('warning'),

            Stat::make('Expired Products', $expiredProducts)
                ->description('Expired items with stock')
                ->icon('heroicon-o-x-circle')
                ->color('danger'),

            Stat::make('Near Expiry', $nearExpiry)
                ->description('Expiring within 30 days')
                ->icon('heroicon-o-clock')
                ->color('info'),

            Stat::make('Suppliers', $totalSuppliers)
                ->description('Total suppliers')
                ->icon('heroicon-o-truck')
                ->color('success'),

            Stat::make('Stock Movements Today', $stockMovementsToday)
                ->description('Today activity')
                ->icon('heroicon-o-arrow-path')
                ->color('secondary'),

            Stat::make('Purchase Orders This Month', $purchaseOrdersThisMonth)
                ->description('Monthly orders')
                ->icon('heroicon-o-shopping-cart')
                ->color('primary'),
        ];
    }
}
