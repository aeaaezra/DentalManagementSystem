<?php

namespace App\Filament\Widgets;

use App\Models\StockMovements;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class StockAdjustment extends ChartWidget
{
    protected ?string $heading = 'Stock Adjustment';
    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $startDate = Carbon::now()
            ->subMonths(5)
            ->startOfMonth();

        $movements = StockMovements::query()
            ->where('movement_date', '>=', $startDate)
            ->get()
            ->groupBy(function ($movement) {
                return Carbon::parse($movement->movement_date)
                    ->format('Y-m');
            });

        $labels = [];
        $stockIn = [];
        $stockOut = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('Y-m');

            $labels[] = $date->format('M Y');

            $monthlyMovements = $movements->get($monthKey, collect());

            $increase = 0;
            $decrease = 0;

            foreach ($monthlyMovements as $movement) {
                $before = (int) ($movement->stock_before ?? 0);
                $after = (int) ($movement->stock_after ?? 0);

                if ($after > $before) {
                    $increase += $after - $before;
                } elseif ($after < $before) {
                    $decrease += $before - $after;
                }
            }

            $stockIn[] = $increase;
            $stockOut[] = $decrease;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Stock Increased',
                    'data' => $stockIn,
                ],
                [
                    'label' => 'Stock Decreased',
                    'data' => $stockOut,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
