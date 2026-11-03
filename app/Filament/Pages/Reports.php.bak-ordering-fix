<?php

namespace App\Filament\Pages;

use App\Models\Appointments;
use App\Models\Orders;
use App\Models\PatientRecords;
use App\Models\PosSales;
use App\Models\Products;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;

class Reports extends Page
{
    protected string $view = 'filament.pages.reports';

    public string $reportType = 'appointments';

    public string $dateFrom;

    public string $dateTo;

    public array $reportData = [];

    public function mount(): void
    {
        $this->dateFrom = Carbon::now()
            ->startOfMonth()
            ->format('Y-m-d');

        $this->dateTo = Carbon::now()
            ->format('Y-m-d');

        $this->generateReport();
    }

    public function selectReport(string $type): void
    {
        $allowedTypes = [
            'appointments',
            'inventory',
            'pos',
            'ordering',
            'patients',
        ];

        if (! in_array($type, $allowedTypes, true)) {
            return;
        }

        $this->reportType = $type;

        $this->generateReport();
    }

    public function generateReport(): void
    {
        if ($this->dateFrom > $this->dateTo) {
            [$this->dateFrom, $this->dateTo] = [
                $this->dateTo,
                $this->dateFrom,
            ];
        }

        switch ($this->reportType) {
            case 'appointments':
                $this->generateAppointmentReport();
                break;

            case 'inventory':
                $this->generateInventoryReport();
                break;

            case 'pos':
                $this->generatePosReport();
                break;

            case 'ordering':
                $this->generateOrderingReport();
                break;

            case 'patients':
                $this->generatePatientReport();
                break;
        }
    }

    protected function generateAppointmentReport(): void
    {
        $appointments = Appointments::query()
            ->with(['patient', 'service'])
            ->whereBetween('appointment_date', [
                $this->dateFrom,
                $this->dateTo,
            ])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        $this->reportData = [
            'total' => $appointments->count(),

            'pending' => $appointments
                ->where('status', 'pending')
                ->count(),

            'approved' => $appointments
                ->whereIn('status', ['approved', 'confirmed'])
                ->count(),

            'completed' => $appointments
                ->where('status', 'completed')
                ->count(),

            'cancelled' => $appointments
                ->where('status', 'cancelled')
                ->count(),

            'total_paid' => (float) $appointments->sum('amount_paid'),

            'appointments' => $appointments,
        ];
    }

    protected function generateInventoryReport(): void
    {
        $products = Products::query()
            ->with('supplier')
            ->orderBy('product_name')
            ->get();

        $this->reportData = [
            'total_products' => $products->count(),

            'active_products' => $products
                ->where('is_active', true)
                ->count(),

            'low_stock' => $products
                ->filter(
                    fn ($product) =>
                        (int) $product->quantity <= (int) $product->reorder_level
                )
                ->count(),

            'out_of_stock' => $products
                ->where('quantity', 0)
                ->count(),

            'expired' => $products
                ->filter(
                    fn ($product) =>
                        $product->expiration_date &&
                        Carbon::parse($product->expiration_date)->isPast()
                )
                ->count(),

            'inventory_value' => (float) $products->sum(
                fn ($product) =>
                    (float) $product->cost_price *
                    (int) $product->quantity
            ),

            'products' => $products,
        ];
    }

    protected function generatePosReport(): void
    {
        $sales = PosSales::query()
            ->with('items')
            ->whereBetween('created_at', [
                Carbon::parse($this->dateFrom)->startOfDay(),
                Carbon::parse($this->dateTo)->endOfDay(),
            ])
            ->latest()
            ->get();

        $this->reportData = [
            'total_sales' => $sales->count(),

            'gross_sales' => (float) $sales->sum('total'),

            'total_discount' => (float) $sales->sum('discount'),

            'total_tax' => (float) $sales->sum('tax'),

            'amount_paid' => (float) $sales->sum('amount_paid'),

            'sales' => $sales,
        ];
    }

    protected function generateOrderingReport(): void
    {
        $orders = Orders::query()
            ->with('items')
            ->whereBetween('created_at', [
                Carbon::parse($this->dateFrom)->startOfDay(),
                Carbon::parse($this->dateTo)->endOfDay(),
            ])
            ->latest()
            ->get();

        $this->reportData = [
            'total_orders' => $orders->count(),

            'total_amount' => (float) $orders->sum('total_amount'),

            'pending' => $orders
                ->where('status', 'pending')
                ->count(),

            'processing' => $orders
                ->where('status', 'processing')
                ->count(),

            'completed' => $orders
                ->where('status', 'completed')
                ->count(),

            'cancelled' => $orders
                ->where('status', 'cancelled')
                ->count(),

            'orders' => $orders,
        ];
    }

    protected function generatePatientReport(): void
    {
        $patients = PatientRecords::query()
            ->with('user')
            ->orderBy('patient_name')
            ->get();

        $this->reportData = [
            'total_patients' => $patients->count(),

            'male' => $patients
                ->filter(
                    fn ($patient) =>
                        strtolower((string) $patient->sex) === 'male'
                )
                ->count(),

            'female' => $patients
                ->filter(
                    fn ($patient) =>
                        strtolower((string) $patient->sex) === 'female'
                )
                ->count(),

            'patients' => $patients,
        ];
    }
}
