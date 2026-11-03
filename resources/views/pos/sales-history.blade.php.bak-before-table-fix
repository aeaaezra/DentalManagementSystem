
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sales History | Shine & Smile POS</title>

    <link rel="stylesheet" href="{{ asset('css/pos/pos-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pos/sales-history.css') }}">
</head>
<body>
    <main class="sh-sales-page">
        <header class="sh-sales-header">
            <div>
                <p class="sh-eyebrow">SHINE & SMILE · POINT OF SALE</p>
                <h1>Sales History</h1>
                <p class="sh-muted">Review your previous transactions and receipts.</p>
            </div>

            <a href="{{ route('pos.homepage') }}" class="sh-btn sh-btn-primary">
                ← Back to POS
            </a>
        </header>

        <section class="sh-sales-card">
            <form method="GET" action="{{ route('pos.sales-history') }}"
                  class="sh-sales-filters">
                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search invoice or status..."
                    aria-label="Search sales"
                >

                <select name="status" aria-label="Filter by sale status">
                    <option value="">All statuses</option>
                    <option value="completed" @selected(request('status') === 'completed')>
                        Completed
                    </option>
                    <option value="pending" @selected(request('status') === 'pending')>
                        Pending
                    </option>
                    <option value="cancelled" @selected(request('status') === 'cancelled')>
                        Cancelled
                    </option>
                </select>

                <button type="submit" class="sh-btn sh-btn-primary">Search</button>
                <a href="{{ route('pos.sales-history') }}" class="sh-btn sh-btn-light">
                    Reset
                </a>
            </form>

            <div class="sh-table-wrap">
                <table class="sh-sales-table">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>Change</th>
                            <th>Payment</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sales as $sale)
                            <tr>
                                <td data-label="Invoice">
                                    <strong>{{ $sale->invoice_no }}</strong>
                                </td>
                                <td data-label="Date">
                                    {{ $sale->created_at?->format('M d, Y h:i A') ?? '—' }}
                                </td>
                                <td data-label="Items">
                                    {{ $sale->items->sum('quantity') }}
                                </td>
                                <td data-label="Total">
                                    ₱{{ number_format((float) $sale->total, 2) }}
                                </td>
                                <td data-label="Paid">
                                    ₱{{ number_format((float) $sale->amount_paid, 2) }}
                                </td>
                                <td data-label="Change">
                                    ₱{{ number_format((float) $sale->change_amount, 2) }}
                                </td>
                                <td data-label="Payment">
                                    {{ ucfirst($sale->payment_status ?? '—') }}
                                </td>
                                <td data-label="Status">
                                    <span class="sh-status sh-status-{{ strtolower($sale->status ?? 'unknown') }}">
                                        {{ ucfirst($sale->status ?? 'Unknown') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="sh-empty">
                                    <strong>No sales found</strong>
                                    <p>Transactions will appear here after they are recorded.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="sh-pagination">
                {{ $sales->links() }}
            </div>
        </section>
    </main>

    <script src="{{ asset('js/pos/sales-history.js') }}" defer></script>
</body>
</html>
