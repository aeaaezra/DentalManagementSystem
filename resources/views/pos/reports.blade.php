<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS Reports | Shine & Smile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pos/pos_homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pos/reports.css') }}">
</head>
<body>
<div class="app-shell">
    @include('pos.partials.sidebar')

    <main class="workspace">
        <section class="report-page">
            <header class="report-heading">
                <div>
                    <span class="report-eyebrow">POINT OF SALE</span>
                    <h1>Reports &amp; Analytics</h1>
                    <p>Track your sales performance and product activity.</p>
                </div>
                <div class="report-date-pill">
                    <i class="fa-regular fa-calendar"></i>
                    {{ \Carbon\Carbon::parse($from)->format('M j, Y') }}
                    @if($from !== $to)
                        – {{ \Carbon\Carbon::parse($to)->format('M j, Y') }}
                    @endif
                </div>
            </header>

            <form class="report-filters" method="GET" action="{{ route('pos.reports') }}">
                <div class="filter-field">
                    <label for="range">Reporting period</label>
                    <select id="range" name="range" onchange="document.getElementById('custom-dates').classList.toggle('is-visible', this.value === 'custom')">
                        <option value="today" {{ $range === 'today' ? 'selected' : '' }}>Today</option>
                        <option value="7days" {{ $range === '7days' ? 'selected' : '' }}>Last 7 days</option>
                        <option value="30days" {{ $range === '30days' ? 'selected' : '' }}>Last 30 days</option>
                        <option value="custom" {{ $range === 'custom' ? 'selected' : '' }}>Custom range</option>
                    </select>
                </div>
                <div id="custom-dates" class="custom-dates {{ $range === 'custom' ? 'is-visible' : '' }}">
                    <div class="filter-field">
                        <label for="from">From</label>
                        <input id="from" type="date" name="from" value="{{ $from }}">
                    </div>
                    <div class="filter-field">
                        <label for="to">To</label>
                        <input id="to" type="date" name="to" value="{{ $to }}">
                    </div>
                </div>
                <button class="report-apply" type="submit"><i class="fa-solid fa-filter"></i> Apply filters</button>
            </form>

            <div class="report-stat-grid">
                <article class="report-stat">
                    <div class="stat-top"><span>Total sales</span><span class="stat-icon pink"><i class="fa-solid fa-peso-sign"></i></span></div>
                    <div class="stat-value">₱{{ number_format((float)$totalSales, 2) }}</div>
                    <div class="stat-caption">Revenue for selected period</div>
                </article>
                <article class="report-stat">
                    <div class="stat-top"><span>Transactions</span><span class="stat-icon purple"><i class="fa-solid fa-receipt"></i></span></div>
                    <div class="stat-value">{{ number_format($transactionCount) }}</div>
                    <div class="stat-caption">Completed sales recorded</div>
                </article>
                <article class="report-stat">
                    <div class="stat-top"><span>Average sale</span><span class="stat-icon blue"><i class="fa-solid fa-chart-line"></i></span></div>
                    <div class="stat-value">₱{{ number_format((float)$averageSale, 2) }}</div>
                    <div class="stat-caption">Average value per transaction</div>
                </article>
                <article class="report-stat">
                    <div class="stat-top"><span>Items sold</span><span class="stat-icon orange"><i class="fa-solid fa-box-open"></i></span></div>
                    <div class="stat-value">{{ number_format((int)$itemsSold) }}</div>
                    <div class="stat-caption">Units included in sales</div>
                </article>
            </div>

            <div class="report-main-grid">
                <section class="report-panel sales-chart-panel">
                    <div class="panel-heading">
                        <div><h2>Sales overview</h2><p>Daily revenue across the selected period</p></div>
                        <span class="panel-tag"><i class="fa-solid fa-circle"></i> Revenue</span>
                    </div>
                    <div class="chart-wrap"><canvas id="sales-chart" aria-label="Daily sales chart"></canvas></div>
                </section>

                <section class="report-panel top-products-panel">
                    <div class="panel-heading">
                        <div><h2>Top-selling products</h2><p>Ranked by units sold</p></div>
                        <span class="panel-heading-icon"><i class="fa-solid fa-trophy"></i></span>
                    </div>
                    @forelse($topProducts as $index => $product)
                        <div class="top-product">
                            <span class="product-rank">{{ $index + 1 }}</span>
                            <div class="top-product-info">
                                <strong>{{ $product->product_name ?: 'Deleted product' }}</strong>
                                <span>{{ number_format((int)$product->quantity_sold) }} units sold</span>
                            </div>
                            <strong class="product-revenue">₱{{ number_format((float)$product->revenue, 2) }}</strong>
                        </div>
                    @empty
                        <div class="report-empty"><i class="fa-solid fa-box-open"></i><p>No product sales found for this period.</p></div>
                    @endforelse
                </section>
            </div>


<section class="report-panel transactions-panel">
    <div class="panel-heading">
        <div>
            <h2>Recent transactions</h2>
            <p>Your latest sales within this reporting period</p>
        </div>
        <a class="view-all-link" href="{{ route('pos.sales-history') }}">
            View sales history →
        </a>
    </div>

    <div class="report-table-wrap">
        <table class="report-table">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Date &amp; time</th>
                    <th>Subtotal</th>
                    <th>Discount</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentSales as $sale)
                    <tr>
                        <td class="invoice-cell">
                            {{ $sale->invoice_no ?: ('SALE-' . $sale->id) }}
                        </td>
                        <td>
                            {{ $sale->created_at ? $sale->created_at->format('M d, Y h:i A') : '—' }}
                        </td>
                        <td>₱{{ number_format((float) $sale->subtotal, 2) }}</td>
                        <td>₱{{ number_format((float) $sale->discount, 2) }}</td>
                        <td class="total-cell">
                            ₱{{ number_format((float) $sale->total, 2) }}
                        </td>
                        <td>
                            <span class="status-pill status-{{ strtolower(preg_replace('/[^a-z0-9]+/i', '-', (string) ($sale->status ?: $sale->payment_status ?: 'pending'))) }}">
                                {{ ucfirst($sale->status ?: $sale->payment_status ?: 'Pending') }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="table-empty">
                            No transactions found for this reporting period.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>


            <footer class="report-footer"><i class="fa-solid fa-shield-halved"></i> Report data is limited to the signed-in cashier's sales.</footer>
        </section>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('sales-chart');
    if (!canvas || typeof Chart === 'undefined') return;

    const labels = @json($chartLabels);
    const sales = @json($chartSales);

    new Chart(canvas, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Sales (₱)',
                data: sales,
                borderColor: '#e75d91',
                backgroundColor: 'rgba(231, 93, 145, 0.12)',
                borderWidth: 3,
                fill: true,
                tension: 0.35,
                pointRadius: 3,
                pointHoverRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: context => ' ₱' + Number(context.raw).toLocaleString('en-PH', {minimumFractionDigits: 2, maximumFractionDigits: 2}) } }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0edf1' }, ticks: { callback: value => '₱' + Number(value).toLocaleString('en-PH') } },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>
</body>
</html>
