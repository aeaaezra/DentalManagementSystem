<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class StockAdjustment extends ChartWidget
{
    protected ?string $heading = 'Stock Adjustment';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
