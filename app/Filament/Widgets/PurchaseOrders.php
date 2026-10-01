<?php

namespace App\Filament\Widgets;
use App\Models\PurchaseOrder;
use Filament\Widgets\ChartWidget;

class PurchaseOrders extends ChartWidget
{
    protected ?string $heading = 'Purchase Orders';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Purchase Orders',
                    'data' => [
                        PurchaseOrder::count(),
                        PurchaseOrder::where('status', 'pending')->count(),
                        PurchaseOrder::where('status', 'approved')->count(),
                        PurchaseOrder::where('status', 'completed')->count(),
                        PurchaseOrder::where('status', 'cancelled')->count(),
                    ],
                ],
            ],
            'labels' => [
                'Total',
                'Pending',
                'Approved',
                'Completed',
                'Cancelled',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}


/*<?php

namespace App\Filament\Widgets;

use App\Models\PurchaseOrder;
use Filament\Widgets\ChartWidget;

class PurchaseOrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Purchase Orders Overview';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Purchase Orders',
                    'data' => [
                        PurchaseOrder::count(),
                        PurchaseOrder::where('status', 'pending')->count(),
                        PurchaseOrder::where('status', 'approved')->count(),
                        PurchaseOrder::where('status', 'completed')->count(),
                        PurchaseOrder::where('status', 'cancelled')->count(),
                    ],
                ],
            ],
            'labels' => [
                'Total',
                'Pending',
                'Approved',
                'Completed',
                'Cancelled',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}*/
