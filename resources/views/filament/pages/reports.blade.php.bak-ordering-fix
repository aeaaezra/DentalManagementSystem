<x-filament-panels::page>

    {{-- =========================================================
        LOADING OVERLAY
    ========================================================== --}}
    <div
        class="report-loading-overlay no-print"
        wire:loading.flex
        wire:target="generateReport,selectReport"
    >
        <div class="report-loader-card">

            <div class="report-spinner"></div>

            <div class="report-loader-title">
                Loading Report
            </div>

            <div class="report-loader-text">
                Please wait while we prepare your report...
            </div>

        </div>
    </div>


    {{-- =========================================================
        MAIN REPORT PAGE
    ========================================================== --}}
    <div
        class="reports-page"
        id="report-print-area"
    >

        {{-- =====================================================
            SCREEN HEADER
        ====================================================== --}}
        <div class="reports-header no-print">

            <div class="reports-heading">

                <div class="reports-title-icon">
                    📊
                </div>

                <div class="reports-heading-text">

                    <h1>
                        Reports
                    </h1>

                    <p>
                        Generate and review reports from your dental management system.
                    </p>

                </div>

            </div>


            <button
                type="button"
                onclick="window.print()"
                class="print-button"
            >

                <span class="print-button-icon">
                    🖨️
                </span>

                <span>
                    Print / Save as PDF
                </span>

            </button>

        </div>


        {{-- =====================================================
            PRINT HEADER
        ====================================================== --}}
        <div class="print-header">

            <div class="print-logo">
                🦷
            </div>

            <div class="print-clinic-info">

                <h1>
                    SHINE &amp; SMILE DENTAL CLINIC
                </h1>

                <p>
                    Dental Management System
                </p>

            </div>

        </div>


        {{-- =====================================================
            REPORT TYPES
        ====================================================== --}}
        <div class="report-types no-print">

            {{-- APPOINTMENTS --}}
            <button
                type="button"
                wire:click="selectReport('appointments')"
                wire:loading.attr="disabled"
                class="report-type-card {{ $reportType === 'appointments' ? 'active' : '' }}"
            >

                <div class="report-icon">
                    📅
                </div>

                <div class="report-card-content">

                    <h3>
                        Appointments
                    </h3>

                    <p>
                        Appointment statistics
                    </p>

                </div>

            </button>


            {{-- INVENTORY --}}
            <button
                type="button"
                wire:click="selectReport('inventory')"
                wire:loading.attr="disabled"
                class="report-type-card {{ $reportType === 'inventory' ? 'active' : '' }}"
            >

                <div class="report-icon">
                    📦
                </div>

                <div class="report-card-content">

                    <h3>
                        Inventory
                    </h3>

                    <p>
                        Stock and products
                    </p>

                </div>

            </button>


            {{-- POS --}}
            <button
                type="button"
                wire:click="selectReport('pos')"
                wire:loading.attr="disabled"
                class="report-type-card {{ $reportType === 'pos' ? 'active' : '' }}"
            >

                <div class="report-icon">
                    🛒
                </div>

                <div class="report-card-content">

                    <h3>
                        POS
                    </h3>

                    <p>
                        Sales and transactions
                    </p>

                </div>

            </button>


            {{-- ORDERING --}}
            <button
                type="button"
                wire:click="selectReport('ordering')"
                wire:loading.attr="disabled"
                class="report-type-card {{ $reportType === 'ordering' ? 'active' : '' }}"
            >

                <div class="report-icon">
                    📋
                </div>

                <div class="report-card-content">

                    <h3>
                        Ordering
                    </h3>

                    <p>
                        Customer orders
                    </p>

                </div>

            </button>


            {{-- PATIENTS --}}
            <button
                type="button"
                wire:click="selectReport('patients')"
                wire:loading.attr="disabled"
                class="report-type-card {{ $reportType === 'patients' ? 'active' : '' }}"
            >

                <div class="report-icon">
                    👤
                </div>

                <div class="report-card-content">

                    <h3>
                        Patient Records
                    </h3>

                    <p>
                        Patient statistics
                    </p>

                </div>

            </button>

        </div>


        {{-- =====================================================
            DATE FILTER
        ====================================================== --}}
        @if(in_array($reportType, ['appointments', 'pos', 'ordering']))

            <div class="filter-card no-print">

                <div class="date-field">

                    <label for="dateFrom">
                        Date From
                    </label>

                    <input
                        type="date"
                        id="dateFrom"
                        wire:model="dateFrom"
                    >

                </div>


                <div class="date-field">

                    <label for="dateTo">
                        Date To
                    </label>

                    <input
                        type="date"
                        id="dateTo"
                        wire:model="dateTo"
                    >

                </div>


                <button
                    type="button"
                    wire:click="generateReport"
                    wire:loading.attr="disabled"
                    class="generate-button"
                >

                    <span
                        class="generate-icon"
                        wire:loading.remove
                        wire:target="generateReport"
                    >
                        ↻
                    </span>

                    <span
                        class="button-spinner"
                        wire:loading.inline-flex
                        wire:target="generateReport"
                    ></span>

                    <span wire:loading.remove wire:target="generateReport">
                        Generate Report
                    </span>

                    <span wire:loading.inline-flex wire:target="generateReport">
                        Generating...
                    </span>

                </button>

            </div>

        @endif


        {{-- =====================================================
            PRINT INFORMATION
        ====================================================== --}}
        <div class="print-report-info">

            <div>

                <strong>

                    @switch($reportType)

                        @case('appointments')
                            Appointments Report
                            @break

                        @case('inventory')
                            Inventory Report
                            @break

                        @case('pos')
                            POS Sales Report
                            @break

                        @case('ordering')
                            Ordering Report
                            @break

                        @case('patients')
                            Patient Records Report
                            @break

                    @endswitch

                </strong>

            </div>


            @if(in_array($reportType, ['appointments', 'pos', 'ordering']))

                <div>
                    Period:
                    {{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }}
                    -
                    {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}
                </div>

            @else

                <div>
                    Generated:
                    {{ now()->format('M d, Y h:i A') }}
                </div>

            @endif

        </div>


        {{-- =====================================================
            REPORT CONTENT
        ====================================================== --}}
        <div class="print-area">


            {{-- =================================================
                APPOINTMENTS REPORT
            ================================================== --}}
            @if($reportType === 'appointments')

                <div class="report-section">

                    <div class="section-header">

                        <div>

                            <h2>
                                Appointment Report
                            </h2>

                            <p>
                                {{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }}
                                -
                                {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}
                            </p>

                        </div>

                    </div>


                    <div class="statistics-grid">

                        <div class="stat-card">

                            <span>
                                Total Appointments
                            </span>

                            <strong>
                                {{ $reportData['total'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card warning">

                            <span>
                                Pending
                            </span>

                            <strong>
                                {{ $reportData['pending'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card info">

                            <span>
                                Approved
                            </span>

                            <strong>
                                {{ $reportData['approved'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card success">

                            <span>
                                Completed
                            </span>

                            <strong>
                                {{ $reportData['completed'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card danger">

                            <span>
                                Cancelled
                            </span>

                            <strong>
                                {{ $reportData['cancelled'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card money">

                            <span>
                                Total Paid
                            </span>

                            <strong>
                                ₱{{ number_format($reportData['total_paid'] ?? 0, 2) }}
                            </strong>

                        </div>

                    </div>


                    <div class="table-card">

                        <div class="table-title">
                            Appointment Details
                        </div>

                        <div class="table-wrapper">

                            <table>

                                <thead>

                                    <tr>

                                        <th>Date</th>
                                        <th>Patient</th>
                                        <th>Doctor</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Amount Paid</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($reportData['appointments'] ?? [] as $appointment)

                                        <tr>

                                            <td>
                                                {{ $appointment->appointment_date?->format('M d, Y') ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $appointment->patient?->patient_name ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $appointment->doctor_name ?? 'N/A' }}
                                            </td>

                                            <td>

                                                <span class="status">
                                                    {{ ucfirst($appointment->status ?? 'N/A') }}
                                                </span>

                                            </td>

                                            <td>
                                                {{ ucfirst($appointment->payment_status ?? 'Pending') }}
                                            </td>

                                            <td>
                                                ₱{{ number_format((float) ($appointment->amount_paid ?? 0), 2) }}
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td
                                                colspan="6"
                                                class="empty"
                                            >
                                                No appointments found for this date range.
                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =================================================
                INVENTORY REPORT
            ================================================== --}}
            @if($reportType === 'inventory')

                <div class="report-section">

                    <div class="section-header">

                        <div>

                            <h2>
                                Inventory Report
                            </h2>

                            <p>
                                Current inventory and stock status
                            </p>

                        </div>

                    </div>


                    <div class="statistics-grid">

                        <div class="stat-card">

                            <span>
                                Total Products
                            </span>

                            <strong>
                                {{ $reportData['total_products'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card success">

                            <span>
                                Active Products
                            </span>

                            <strong>
                                {{ $reportData['active_products'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card warning">

                            <span>
                                Low Stock
                            </span>

                            <strong>
                                {{ $reportData['low_stock'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card danger">

                            <span>
                                Out of Stock
                            </span>

                            <strong>
                                {{ $reportData['out_of_stock'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card danger">

                            <span>
                                Expired
                            </span>

                            <strong>
                                {{ $reportData['expired'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card money">

                            <span>
                                Inventory Value
                            </span>

                            <strong>
                                ₱{{ number_format($reportData['inventory_value'] ?? 0, 2) }}
                            </strong>

                        </div>

                    </div>


                    <div class="table-card">

                        <div class="table-title">
                            Product Inventory
                        </div>

                        <div class="table-wrapper">

                            <table>

                                <thead>

                                    <tr>

                                        <th>SKU</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Reorder Level</th>
                                        <th>Cost Price</th>
                                        <th>Expiration</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($reportData['products'] ?? [] as $product)

                                        <tr>

                                            <td>
                                                {{ $product->sku ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $product->product_name ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $product->category ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $product->quantity ?? 0 }}
                                            </td>

                                            <td>
                                                {{ $product->reorder_level ?? 0 }}
                                            </td>

                                            <td>
                                                ₱{{ number_format((float) ($product->cost_price ?? 0), 2) }}
                                            </td>

                                            <td>
                                                {{ $product->expiration_date?->format('M d, Y') ?? 'N/A' }}
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td
                                                colspan="7"
                                                class="empty"
                                            >
                                                No products found.
                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =================================================
                POS REPORT
            ================================================== --}}
            @if($reportType === 'pos')

                <div class="report-section">

                    <div class="section-header">

                        <div>

                            <h2>
                                POS Sales Report
                            </h2>

                            <p>
                                {{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }}
                                -
                                {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}
                            </p>

                        </div>

                    </div>


                    <div class="statistics-grid">

                        <div class="stat-card">

                            <span>
                                Total Transactions
                            </span>

                            <strong>
                                {{ $reportData['total_sales'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card money">

                            <span>
                                Gross Sales
                            </span>

                            <strong>
                                ₱{{ number_format($reportData['gross_sales'] ?? 0, 2) }}
                            </strong>

                        </div>


                        <div class="stat-card warning">

                            <span>
                                Total Discount
                            </span>

                            <strong>
                                ₱{{ number_format($reportData['total_discount'] ?? 0, 2) }}
                            </strong>

                        </div>


                        <div class="stat-card info">

                            <span>
                                Total Tax
                            </span>

                            <strong>
                                ₱{{ number_format($reportData['total_tax'] ?? 0, 2) }}
                            </strong>

                        </div>


                        <div class="stat-card success">

                            <span>
                                Amount Paid
                            </span>

                            <strong>
                                ₱{{ number_format($reportData['amount_paid'] ?? 0, 2) }}
                            </strong>

                        </div>

                    </div>


                    <div class="table-card">

                        <div class="table-title">
                            POS Transactions
                        </div>

                        <div class="table-wrapper">

                            <table>

                                <thead>

                                    <tr>

                                        <th>Invoice</th>
                                        <th>Subtotal</th>
                                        <th>Discount</th>
                                        <th>Tax</th>
                                        <th>Total</th>
                                        <th>Payment Status</th>
                                        <th>Date</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($reportData['sales'] ?? [] as $sale)

                                        <tr>

                                            <td>
                                                {{ $sale->invoice_no ?? 'N/A' }}
                                            </td>

                                            <td>
                                                ₱{{ number_format((float) ($sale->subtotal ?? 0), 2) }}
                                            </td>

                                            <td>
                                                ₱{{ number_format((float) ($sale->discount ?? 0), 2) }}
                                            </td>

                                            <td>
                                                ₱{{ number_format((float) ($sale->tax ?? 0), 2) }}
                                            </td>

                                            <td>
                                                ₱{{ number_format((float) ($sale->total ?? 0), 2) }}
                                            </td>

                                            <td>
                                                {{ ucfirst($sale->payment_status ?? 'N/A') }}
                                            </td>

                                            <td>
                                                {{ $sale->created_at?->format('M d, Y h:i A') ?? 'N/A' }}
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td
                                                colspan="7"
                                                class="empty"
                                            >
                                                No POS transactions found.
                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =================================================
                ORDERING REPORT
            ================================================== --}}
            @if($reportType === 'ordering')

                <div class="report-section">

                    <div class="section-header">

                        <div>

                            <h2>
                                Ordering Report
                            </h2>

                            <p>
                                {{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }}
                                -
                                {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}
                            </p>

                        </div>

                    </div>


                    <div class="statistics-grid">

                        <div class="stat-card">

                            <span>
                                Total Orders
                            </span>

                            <strong>
                                {{ $reportData['total_orders'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card money">

                            <span>
                                Total Amount
                            </span>

                            <strong>
                                ₱{{ number_format($reportData['total_amount'] ?? 0, 2) }}
                            </strong>

                        </div>


                        <div class="stat-card warning">

                            <span>
                                Pending
                            </span>

                            <strong>
                                {{ $reportData['pending'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card info">

                            <span>
                                Processing
                            </span>

                            <strong>
                                {{ $reportData['processing'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card success">

                            <span>
                                Completed
                            </span>

                            <strong>
                                {{ $reportData['completed'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card danger">

                            <span>
                                Cancelled
                            </span>

                            <strong>
                                {{ $reportData['cancelled'] ?? 0 }}
                            </strong>

                        </div>

                    </div>


                    <div class="table-card">

                        <div class="table-title">
                            Customer Orders
                        </div>

                        <div class="table-wrapper">

                            <table>

                                <thead>

                                    <tr>

                                        <th>Order No.</th>
                                        <th>Customer</th>
                                        <th>Contact</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Date</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($reportData['orders'] ?? [] as $order)

                                        <tr>

                                            <td>
                                                {{ $order->order_no ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $order->customer_name ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $order->contact_number ?? 'N/A' }}
                                            </td>

                                            <td>
                                                ₱{{ number_format((float) ($order->total_amount ?? 0), 2) }}
                                            </td>

                                            <td>
                                                {{ ucfirst($order->payment_status ?? 'N/A') }}
                                            </td>

                                            <td>

                                                <span class="status">
                                                    {{ ucfirst($order->status ?? 'N/A') }}
                                                </span>

                                            </td>

                                            <td>
                                                {{ $order->created_at?->format('M d, Y h:i A') ?? 'N/A' }}
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td
                                                colspan="7"
                                                class="empty"
                                            >
                                                No orders found.
                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =================================================
                PATIENT REPORT
            ================================================== --}}
            @if($reportType === 'patients')

                <div class="report-section">

                    <div class="section-header">

                        <div>

                            <h2>
                                Patient Records Report
                            </h2>

                            <p>
                                Patient statistics and records
                            </p>

                        </div>

                    </div>


                    <div class="statistics-grid">

                        <div class="stat-card">

                            <span>
                                Total Patients
                            </span>

                            <strong>
                                {{ $reportData['total_patients'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card info">

                            <span>
                                Male
                            </span>

                            <strong>
                                {{ $reportData['male'] ?? 0 }}
                            </strong>

                        </div>


                        <div class="stat-card">

                            <span>
                                Female
                            </span>

                            <strong>
                                {{ $reportData['female'] ?? 0 }}
                            </strong>

                        </div>

                    </div>


                    <div class="table-card">

                        <div class="table-title">
                            Patient Records
                        </div>

                        <div class="table-wrapper">

                            <table>

                                <thead>

                                    <tr>

                                        <th>Patient Name</th>
                                        <th>Age</th>
                                        <th>Sex</th>
                                        <th>Contact</th>
                                        <th>Address</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($reportData['patients'] ?? [] as $patient)

                                        <tr>

                                            <td>
                                                {{ $patient->patient_name ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $patient->age ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $patient->sex ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $patient->tel_no ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $patient->address ?? 'N/A' }}
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td
                                                colspan="5"
                                                class="empty"
                                            >
                                                No patient records found.
                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            @endif

        </div>


        {{-- =====================================================
            PRINT FOOTER
        ====================================================== --}}
        <div class="print-footer">

            <div>
                Shine &amp; Smile Dental Clinic
            </div>

            <div>
                Generated:
                {{ now()->format('M d, Y h:i A') }}
            </div>

        </div>

    </div>


    <style>

        /* =========================================================
           REPORT VARIABLES - LIGHT MODE
        ========================================================== */

        .reports-page {

            --report-primary: #ec4899;
            --report-primary-dark: #db2777;

            --report-bg: #f8fafc;
            --report-card: #ffffff;

            --report-text: #0f172a;
            --report-text-secondary: #64748b;
            --report-text-muted: #94a3b8;

            --report-border: #e2e8f0;

            --report-input-bg: #ffffff;

            --report-table-head: #f8fafc;
            --report-table-row: #ffffff;
            --report-table-border: #e2e8f0;

            --report-shadow:
                0 8px 25px rgba(15, 23, 42, 0.06);

            width: 100%;
            max-width: 1400px;
            margin: 0 auto;

            color: var(--report-text);

        }


        /* =========================================================
           DARK MODE
           FILAMENT USES .dark ON THE HTML ELEMENT
        ========================================================== */

        .dark .reports-page {

            --report-bg: #020617;
            --report-card: #0f172a;

            --report-text: #f8fafc;
            --report-text-secondary: #94a3b8;
            --report-text-muted: #64748b;

            --report-border: #1e293b;

            --report-input-bg: #020617;

            --report-table-head: #0b1220;
            --report-table-row: #0f172a;
            --report-table-border: #1e293b;

            --report-shadow:
                0 10px 30px rgba(0, 0, 0, 0.30);

        }


        /* =========================================================
           PAGE
        ========================================================== */

        .reports-page {

            display: flex;
            flex-direction: column;
            gap: 24px;

        }


        /* =========================================================
           LOADING OVERLAY
        ========================================================== */

        .report-loading-overlay {

            position: fixed;

            inset: 0;

            z-index: 99999;

            display: none;

            align-items: center;
            justify-content: center;

            padding: 20px;

            background:
                rgba(15, 23, 42, 0.55);

            backdrop-filter: blur(5px);

        }


        .dark .report-loading-overlay {

            background:
                rgba(0, 0, 0, 0.70);

        }


        .report-loader-card {

            width: min(380px, 100%);

            padding: 32px 28px;

            border:
                1px solid
                rgba(255, 255, 255, 0.12);

            border-radius: 18px;

            background:
                #ffffff;

            text-align: center;

            box-shadow:
                0 25px 70px rgba(0, 0, 0, 0.25);

        }


        .dark .report-loader-card {

            background: #0f172a;

            border-color: #1e293b;

            color: #ffffff;

        }


        .report-spinner {

            width: 48px;
            height: 48px;

            margin: 0 auto 18px;

            border:
                4px solid
                rgba(236, 72, 153, 0.18);

            border-top-color:
                var(--report-primary);

            border-radius: 50%;

            animation:
                report-spin .8s linear infinite;

        }


        @keyframes report-spin {

            to {
                transform: rotate(360deg);
            }

        }


        .report-loader-title {

            color: #0f172a;

            font-size: 18px;

            font-weight: 800;

        }


        .dark .report-loader-title {

            color: #f8fafc;

        }


        .report-loader-text {

            margin-top: 7px;

            color: #64748b;

            font-size: 13px;

        }


        .dark .report-loader-text {

            color: #94a3b8;

        }


        /* =========================================================
           HEADER
        ========================================================== */

        .reports-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

        }


        .reports-heading {

            display: flex;

            align-items: center;

            gap: 14px;

        }


        .reports-title-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 50px;
            height: 50px;

            flex-shrink: 0;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    rgba(236, 72, 153, .16),
                    rgba(236, 72, 153, .05)
                );

            font-size: 25px;

        }


        .reports-header h1 {

            margin: 0;

            color: var(--report-text);

            font-size: 30px;

            line-height: 1.1;

            font-weight: 800;

            letter-spacing: -0.02em;

        }


        .reports-header p {

            margin: 7px 0 0;

            color: var(--report-text-secondary);

            font-size: 14px;

        }


        /* =========================================================
           PRINT BUTTON
        ========================================================== */

        .print-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            min-height: 44px;

            padding: 0 18px;

            border: 0;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #ec4899,
                    #db2777
                );

            color: #ffffff;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 7px 20px
                rgba(236, 72, 153, .24);

            transition:
                transform .2s ease,
                box-shadow .2s ease;

        }


        .print-button:hover {

            transform: translateY(-2px);

            box-shadow:
                0 10px 25px
                rgba(236, 72, 153, .32);

        }


        .print-button:active {

            transform: translateY(0);

        }


        /* =========================================================
           REPORT TYPE CARDS
        ========================================================== */

        .report-types {

            display: grid;

            grid-template-columns:
                repeat(5, minmax(0, 1fr));

            gap: 14px;

        }


        .report-type-card {

            display: flex;

            align-items: center;

            gap: 13px;

            width: 100%;

            min-height: 86px;

            padding: 16px;

            border:
                1px solid
                var(--report-border);

            border-radius: 14px;

            background:
                var(--report-card);

            color:
                var(--report-text);

            text-align: left;

            cursor: pointer;

            box-shadow:
                var(--report-shadow);

            transition:
                border-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease,
                background .2s ease;

        }


        .report-type-card:hover {

            border-color:
                var(--report-primary);

            transform:
                translateY(-2px);

            box-shadow:
                0 12px 28px
                rgba(236, 72, 153, .12);

        }


        .report-type-card.active {

            border-color:
                var(--report-primary);

            box-shadow:
                0 0 0 1px
                var(--report-primary),
                0 12px 28px
                rgba(236, 72, 153, .12);

        }


        .report-type-card:disabled {

            opacity: .65;

            cursor: wait;

            transform: none;

        }


        .report-icon {

            display: flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            width: 44px;
            height: 44px;

            border-radius: 12px;

            background:
                rgba(236, 72, 153, .10);

            font-size: 22px;

        }


        .report-card-content {

            min-width: 0;

        }


        .report-type-card h3 {

            margin: 0;

            color:
                var(--report-text);

            font-size: 14px;

            font-weight: 800;

        }


        .report-type-card p {

            margin: 5px 0 0;

            color:
                var(--report-text-secondary);

            font-size: 12px;

        }


        /* =========================================================
           FILTER CARD
        ========================================================== */

        .filter-card {

            display: flex;

            align-items: flex-end;

            gap: 16px;

            padding: 20px;

            border:
                1px solid
                var(--report-border);

            border-radius: 16px;

            background:
                var(--report-card);

            box-shadow:
                var(--report-shadow);

        }


        .date-field {

            display: flex;

            flex-direction: column;

            gap: 7px;

        }


        .date-field label {

            color:
                var(--report-text);

            font-size: 13px;

            font-weight: 700;

        }


        .date-field input {

            width: 200px;

            min-height: 44px;

            padding: 9px 12px;

            border:
                1px solid
                var(--report-border);

            border-radius: 9px;

            background:
                var(--report-input-bg);

            color:
                var(--report-text);

            outline: none;

            font-size: 13px;

            color-scheme: light;

            transition:
                border-color .2s ease,
                box-shadow .2s ease;

        }


        .dark .date-field input {

            color-scheme: dark;

        }


        .date-field input:focus {

            border-color:
                var(--report-primary);

            box-shadow:
                0 0 0 3px
                rgba(236, 72, 153, .10);

        }


        /* =========================================================
           GENERATE BUTTON
        ========================================================== */

        .generate-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            min-height: 44px;

            padding: 0 20px;

            border: 0;

            border-radius: 9px;

            background:
                linear-gradient(
                    135deg,
                    #ec4899,
                    #db2777
                );

            color: #ffffff;

            font-size: 13px;

            font-weight: 800;

            cursor: pointer;

            box-shadow:
                0 5px 15px
                rgba(236, 72, 153, .18);

            transition:
                transform .2s ease,
                box-shadow .2s ease;

        }


        .generate-button:hover {

            transform:
                translateY(-1px);

            box-shadow:
                0 8px 20px
                rgba(236, 72, 153, .25);

        }


        .generate-button:disabled {

            opacity: .7;

            cursor: wait;

            transform: none;

        }


        .button-spinner {

            width: 15px;
            height: 15px;

            border:
                2px solid
                rgba(255, 255, 255, .35);

            border-top-color:
                #ffffff;

            border-radius: 50%;

            animation:
                report-spin .7s linear infinite;

        }


        /* =========================================================
           PRINT INFORMATION
        ========================================================== */

        .print-report-info {

            display: none;

        }


        /* =========================================================
           REPORT SECTION
        ========================================================== */

        .report-section {

            display: flex;

            flex-direction: column;

            gap: 18px;

        }


        .section-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

        }


        .section-header h2 {

            margin: 0;

            color:
                var(--report-text);

            font-size: 23px;

            font-weight: 800;

            letter-spacing: -0.02em;

        }


        .section-header p {

            margin: 5px 0 0;

            color:
                var(--report-text-secondary);

            font-size: 13px;

        }


        /* =========================================================
           STATISTICS
        ========================================================== */

        .statistics-grid {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 14px;

        }


        .stat-card {

            min-height: 108px;

            padding: 18px;

            border:
                1px solid
                var(--report-border);

            border-radius: 14px;

            background:
                var(--report-card);

            box-shadow:
                var(--report-shadow);

        }


        .stat-card span {

            display: block;

            margin-bottom: 11px;

            color:
                var(--report-text-secondary);

            font-size: 12px;

            font-weight: 600;

        }


        .stat-card strong {

            display: block;

            color:
                var(--report-text);

            font-size: 27px;

            line-height: 1;

            font-weight: 800;

        }


        .stat-card.warning strong {

            color: #f59e0b;

        }


        .stat-card.info strong {

            color: #0ea5e9;

        }


        .stat-card.success strong {

            color: #22c55e;

        }


        .stat-card.danger strong {

            color: #f43f5e;

        }


        .stat-card.money strong {

            color:
                var(--report-primary);

        }


        /* =========================================================
           TABLE
        ========================================================== */

        .table-card {

            overflow: hidden;

            border:
                1px solid
                var(--report-border);

            border-radius: 14px;

            background:
                var(--report-card);

            box-shadow:
                var(--report-shadow);

        }


        .table-title {

            padding: 16px 18px;

            border-bottom:
                1px solid
                var(--report-border);

            color:
                var(--report-text);

            font-size: 15px;

            font-weight: 800;

        }


        .table-wrapper {

            width: 100%;

            overflow-x: auto;

        }


        .reports-page table {

            width: 100%;

            border-collapse: collapse;

        }


        .reports-page th,
        .reports-page td {

            padding: 13px 15px;

            text-align: left;

            white-space: nowrap;

        }


        .reports-page th {

            background:
                var(--report-table-head);

            color:
                var(--report-text-secondary);

            border-bottom:
                1px solid
                var(--report-table-border);

            font-size: 11px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .04em;

        }


        .reports-page td {

            border-top:
                1px solid
                var(--report-table-border);

            background:
                var(--report-table-row);

            color:
                var(--report-text);

            font-size: 13px;

        }


        .reports-page tbody tr {

            transition:
                background .15s ease;

        }


        .reports-page tbody tr:hover td {

            background:
                rgba(236, 72, 153, .04);

        }


        /* =========================================================
           STATUS
        ========================================================== */

        .status {

            display: inline-flex;

            align-items: center;

            padding: 4px 9px;

            border-radius: 999px;

            background:
                rgba(236, 72, 153, .10);

            color:
                var(--report-primary);

            font-size: 11px;

            font-weight: 700;

        }


        /* =========================================================
           EMPTY
        ========================================================== */

        .reports-page .empty {

            padding: 35px !important;

            text-align: center !important;

            color:
                var(--report-text-muted) !important;

        }


        /* =========================================================
           PRINT HEADER / FOOTER
        ========================================================== */

        .print-header,
        .print-footer {

            display: none;

        }


        /* =========================================================
           LARGE TABLET
        ========================================================== */

        @media (max-width: 1200px) {

            .report-types {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

            }


            .statistics-grid {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));

            }

        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 768px) {

            .reports-header {

                flex-direction: column;

                align-items: stretch;

            }


            .print-button {

                width: 100%;

            }


            .report-types {

                grid-template-columns: 1fr;

            }


            .filter-card {

                flex-direction: column;

                align-items: stretch;

            }


            .date-field input {

                width: 100%;

            }


            .generate-button {

                width: 100%;

            }


            .statistics-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 500px) {

            .reports-header h1 {

                font-size: 25px;

            }


            .reports-heading {

                align-items: flex-start;

            }


            .statistics-grid {

                grid-template-columns: 1fr;

            }


            .table-card {

                border-radius: 10px;

            }


            .report-type-card {

                min-height: 76px;

            }

        }


        /* =========================================================
           PRINT / PDF
        ========================================================== */

        @media print {

            @page {

                size: A4 landscape;

                margin: 10mm;

            }


            html,
            body {

                width: 100% !important;

                margin: 0 !important;

                padding: 0 !important;

                background: #ffffff !important;

                color: #000000 !important;

            }


            body * {

                visibility: hidden !important;

            }


            #report-print-area,
            #report-print-area * {

                visibility: visible !important;

            }


            #report-print-area {

                position: absolute !important;

                top: 0 !important;

                left: 0 !important;

                width: 100% !important;

                max-width: none !important;

                margin: 0 !important;

                padding: 0 !important;

                background: #ffffff !important;

                color: #000000 !important;

                box-shadow: none !important;

            }


            .fi-main,
            .fi-main-ctn,
            .fi-page,
            .fi-page-content {

                width: 100% !important;

                max-width: none !important;

                margin: 0 !important;

                padding: 0 !important;

                background: #ffffff !important;

            }


            #report-print-area .no-print {

                display: none !important;

            }


            /* -----------------------------------------------------
               PRINT HEADER
            ------------------------------------------------------ */

            #report-print-area .print-header {

                display: flex !important;

                align-items: center !important;

                justify-content: center !important;

                gap: 12px !important;

                width: 100% !important;

                margin: 0 0 12px 0 !important;

                padding: 0 0 10px 0 !important;

                border-bottom:
                    2px solid #222222 !important;

                background: #ffffff !important;

                color: #000000 !important;

            }


            #report-print-area .print-logo {

                display: flex !important;

                align-items: center !important;

                justify-content: center !important;

                width: 34px !important;

                height: 34px !important;

                font-size: 25px !important;

            }


            #report-print-area .print-clinic-info h1 {

                margin: 0 !important;

                color: #000000 !important;

                font-size: 19px !important;

                font-weight: 800 !important;

            }


            #report-print-area .print-clinic-info p {

                margin: 2px 0 0 !important;

                color: #555555 !important;

                font-size: 9px !important;

            }


            /* -----------------------------------------------------
               REPORT INFO
            ------------------------------------------------------ */

            #report-print-area .print-report-info {

                display: flex !important;

                align-items: center !important;

                justify-content: space-between !important;

                width: 100% !important;

                margin: 0 0 12px 0 !important;

                padding: 0 0 7px 0 !important;

                border-bottom:
                    1px solid #cccccc !important;

                background: #ffffff !important;

                color: #222222 !important;

                font-size: 9px !important;

            }


            #report-print-area .print-report-info strong {

                color: #000000 !important;

                font-weight: 800 !important;

            }


            /* -----------------------------------------------------
               REPORT AREA
            ------------------------------------------------------ */

            #report-print-area .print-area,
            #report-print-area .report-section {

                width: 100% !important;

                max-width: none !important;

                margin: 0 !important;

                padding: 0 !important;

                background: #ffffff !important;

                color: #000000 !important;

            }


            #report-print-area .section-header {

                display: block !important;

                margin: 0 0 9px 0 !important;

            }


            #report-print-area .section-header h2 {

                margin: 0 !important;

                color: #000000 !important;

                font-size: 16px !important;

                font-weight: 800 !important;

            }


            #report-print-area .section-header p {

                margin: 3px 0 0 !important;

                color: #555555 !important;

                font-size: 9px !important;

            }


            /* -----------------------------------------------------
               STATISTICS
            ------------------------------------------------------ */

            #report-print-area .statistics-grid {

                display: grid !important;

                grid-template-columns:
                    repeat(4, minmax(0, 1fr)) !important;

                gap: 6px !important;

                margin: 0 0 10px 0 !important;

            }


            #report-print-area .stat-card {

                min-height: 0 !important;

                padding: 7px !important;

                border:
                    1px solid #bdbdbd !important;

                border-radius: 4px !important;

                background: #ffffff !important;

                color: #000000 !important;

                box-shadow: none !important;

                break-inside: avoid !important;

                page-break-inside: avoid !important;

            }


            #report-print-area .stat-card span {

                display: block !important;

                margin: 0 0 3px 0 !important;

                color: #555555 !important;

                font-size: 7px !important;

            }


            #report-print-area .stat-card strong {

                display: block !important;

                color: #000000 !important;

                font-size: 13px !important;

                font-weight: 800 !important;

            }


            /* -----------------------------------------------------
               TABLE
            ------------------------------------------------------ */

            #report-print-area .table-card {

                width: 100% !important;

                margin: 0 !important;

                padding: 0 !important;

                overflow: visible !important;

                border:
                    1px solid #aaaaaa !important;

                border-radius: 0 !important;

                background: #ffffff !important;

                color: #000000 !important;

                box-shadow: none !important;

            }


            #report-print-area .table-title {

                padding: 6px 8px !important;

                border-bottom:
                    1px solid #aaaaaa !important;

                background: #f1f1f1 !important;

                color: #000000 !important;

                font-size: 10px !important;

                font-weight: 800 !important;

            }


            #report-print-area .table-wrapper {

                width: 100% !important;

                overflow: visible !important;

            }


            #report-print-area table {

                display: table !important;

                width: 100% !important;

                margin: 0 !important;

                border-collapse: collapse !important;

                background: #ffffff !important;

                color: #000000 !important;

            }


            #report-print-area thead {

                display: table-header-group !important;

            }


            #report-print-area tbody {

                display: table-row-group !important;

            }


            #report-print-area tr {

                display: table-row !important;

                break-inside: avoid !important;

                page-break-inside: avoid !important;

            }


            #report-print-area th,
            #report-print-area td {

                display: table-cell !important;

                padding: 4px 5px !important;

                border:
                    1px solid #cccccc !important;

                background: #ffffff !important;

                color: #000000 !important;

                font-size: 7px !important;

                line-height: 1.25 !important;

                white-space: normal !important;

                word-break: normal !important;

            }


            #report-print-area th {

                background: #f1f1f1 !important;

                color: #000000 !important;

                font-size: 6.5px !important;

                font-weight: 800 !important;

                text-transform: uppercase !important;

            }


            #report-print-area .status {

                display: inline-block !important;

                padding: 2px 4px !important;

                border:
                    1px solid #999999 !important;

                border-radius: 3px !important;

                background: #ffffff !important;

                color: #000000 !important;

                font-size: 6.5px !important;

            }


            #report-print-area .empty {

                display: table-cell !important;

                padding: 12px !important;

                background: #ffffff !important;

                color: #555555 !important;

                text-align: center !important;

            }


            /* -----------------------------------------------------
               FOOTER
            ------------------------------------------------------ */

            #report-print-area .print-footer {

                display: flex !important;

                align-items: center !important;

                justify-content: space-between !important;

                width: 100% !important;

                margin-top: 10px !important;

                padding-top: 6px !important;

                border-top:
                    1px solid #cccccc !important;

                background: #ffffff !important;

                color: #555555 !important;

                font-size: 7px !important;

            }


            /* -----------------------------------------------------
               REMOVE SHADOWS
            ------------------------------------------------------ */

            #report-print-area,
            #report-print-area * {

                box-shadow: none !important;

                text-shadow: none !important;

            }

        }

    </style>

</x-filament-panels::page>
