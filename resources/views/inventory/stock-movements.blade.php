
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stock Movements | Shine &amp; Smile POS</title>

    <link rel="stylesheet"
          href="{{ asset('css/pos/pos_homepage.css') }}?v={{ time() }}">

    <link rel="stylesheet"
          href="{{ asset('css/pos/products.css') }}?v={{ time() }}">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        .stock-page {
            padding: 20px 24px 32px;
            color: #17233e;
        }

        .stock-heading {
            margin: 0 0 20px;
        }

        .stock-heading h1 {
            margin: 0 0 6px;
            font-size: 27px;
            font-weight: 750;
        }

        .stock-muted {
            color: #68758f;
            font-size: 13px;
        }

        .stock-cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 22px;
        }

        .stock-stat,
        .stock-panel {
            background: #fff;
            border: 1px solid #f2dce7;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(31, 41, 55, .035);
        }

        .stock-stat {
            padding: 22px;
        }

        .stock-stat strong {
            display: block;
            margin-top: 12px;
            font-size: 29px;
            color: #17233e;
        }

        .stock-panel {
            padding: 22px;
        }

        .stock-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .stock-filters input,
        .stock-filters select {
            min-height: 44px;
            padding: 10px 13px;
            border: 1px solid #eadce4;
            border-radius: 10px;
            background: #fff;
            color: #17233e;
            font: inherit;
        }

        .stock-filters input[name="search"] {
            flex: 1;
            min-width: 200px;
        }

        .stock-filters input:focus,
        .stock-filters select:focus {
            outline: 2px solid #fce1ed;
            border-color: #ec1674;
        }

        .stock-filter-button {
            min-height: 44px;
            padding: 10px 18px;
            border: 1px solid #ec1674;
            border-radius: 10px;
            background: #ec1674;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        .stock-filter-button:hover {
            background: #d90f65;
        }

        .stock-reset {
            display: inline-flex;
            align-items: center;
            padding: 10px;
            color: #d90f65;
            text-decoration: none;
        }

        .stock-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .stock-table {
            width: 100%;
            min-width: 1050px;
            border-collapse: collapse;
        }

        .stock-table th,
        .stock-table td {
            padding: 15px 12px;
            text-align: left;
            white-space: nowrap;
            border-bottom: 1px solid #f4e8ee;
            font-size: 13px;
        }

        .stock-table th {
            background: #fff5f9;
            color: #596780;
            font-size: 11px;
            font-weight: 750;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .stock-table tbody tr:hover {
            background: #fffafd;
        }

        .stock-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #f1f2f6;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .stock-badge.in,
        .stock-badge.return {
            background: #e3f8eb;
            color: #187743;
        }

        .stock-badge.out,
        .stock-badge.expired,
        .stock-badge.damaged {
            background: #ffe8ed;
            color: #b42345;
        }

        .stock-badge.adjustment {
            background: #fff0d6;
            color: #8c5b00;
        }

        .stock-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 20px;
        }

        .stock-pagination nav a,
        .stock-pagination nav span {
            display: inline-block;
            padding: 8px 11px;
            margin: 2px;
            border: 1px solid #f2dce7;
            border-radius: 8px;
            color: #d90f65;
            text-decoration: none;
        }

        .stock-empty {
            padding: 35px !important;
            text-align: center !important;
            color: #68758f;
        }

        @media (max-width: 1000px) {
            .stock-cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 600px) {
            .stock-page {
                padding: 16px 12px 24px;
            }

            .stock-panel {
                padding: 14px;
            }

            .stock-cards {
                gap: 10px;
            }

            .stock-stat {
                padding: 14px;
            }

            .stock-stat strong {
                font-size: 24px;
            }

            .stock-filters > * {
                width: 100%;
            }

            .stock-filters input[name="search"] {
                min-width: 0;
            }
        }
/* Stock Movements POS layout */
.app-shell {
    grid-template-columns: 252px minmax(0, 1fr) !important;
    min-height: 100vh;
}

.workspace {
    min-width: 0;
    width: 100%;
}

.sh-products-page {
    width: 100%;
    min-width: 0;
}

.stock-page {
    width: 100%;
    max-width: none;
}

.stock-table-wrap {
    overflow-x: auto;
}

.stock-table {
    width: 100%;
    min-width: 1050px;
    border-collapse: collapse;
}

.stock-table th {
    background: #fff5f9;
    color: #596780;
}

.stock-table th,
.stock-table td {
    padding: 15px 12px;
    border-bottom: 1px solid #f4e8ee;
    text-align: left;
    white-space: nowrap;
    font-size: 13px;
}

.stock-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}

.stock-filters input[name="search"] {
    flex: 1 1 240px;
    min-width: 180px;
}

.stock-filter-button {
    background: #ec1674;
    color: #fff;
    border-color: #ec1674;
}

.stock-stat,
.stock-panel {
    background: #fff;
    border: 1px solid #f2dce7;
    border-radius: 15px;
}

@media (max-width: 850px) {
    .app-shell {
        grid-template-columns: 1fr !important;
    }

    .stock-page {
        padding: 16px 12px 24px;
    }

    .stock-cards {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

/* Stock Movements — refined POS styling */
.stock-page {
    padding: 24px 28px 32px;
    color: #172b4d;
    box-sizing: border-box;
}

.stock-heading {
    margin-bottom: 24px;
}

.stock-heading h1 {
    font-size: 30px;
    font-weight: 750;
    color: #10294a;
    margin: 0 0 5px;
}

.stock-heading p {
    color: #64748b;
    margin: 0;
}

.stock-cards {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 22px;
}

.stock-stat {
    padding: 22px;
    border: 1px solid #f2dce7;
    border-radius: 15px;
    background: #fff;
}

.stock-panel {
    padding: 22px;
    background: #fff;
    border: 1px solid #f2dce7;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(60, 20, 40, .035);
}

.stock-filters {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}

.stock-filters input,
.stock-filters select {
    box-sizing: border-box;
    min-height: 46px;
    padding: 0 13px;
    border: 1px solid #eadce4;
    border-radius: 10px;
    background: #fff;
    color: #172b4d;
    font: inherit;
    outline: none;
}

.stock-filters input:focus,
.stock-filters select:focus {
    border-color: #ec1674;
    box-shadow: 0 0 0 3px rgba(236, 22, 116, .09);
}

.stock-filters input[name="search"] {
    flex: 1 1 300px;
    min-width: 200px;
}

.stock-filter-button {
    min-height: 46px;
    padding: 0 20px;
    border: 1px solid #ec1674;
    border-radius: 10px;
    background: #ec1674;
    color: #fff;
    font-weight: 650;
    cursor: pointer;
}

.stock-filter-button:hover {
    background: #d90e66;
}

.stock-filters .reset {
    padding: 12px 8px;
    color: #d90e66;
    text-decoration: none;
    font-weight: 600;
}

.stock-table-wrap {
    width: 100%;
    overflow-x: auto;
    border-radius: 10px;
}

.stock-table {
    width: 100%;
    min-width: 1050px;
    border-collapse: separate;
    border-spacing: 0;
}

.stock-table thead th {
    padding: 15px 12px;
    background: #fff3f8;
    color: #596780;
    font-size: 11px;
    font-weight: 750;
    letter-spacing: .045em;
    text-transform: uppercase;
    text-align: left;
    border-bottom: 1px solid #f2dce7;
}

.stock-table tbody td {
    padding: 16px 12px;
    color: #243750;
    font-size: 13px;
    border-bottom: 1px solid #f4e8ee;
    vertical-align: middle;
}

.stock-table tbody tr:hover {
    background: #fff9fc;
}

.stock-badge {
    display: inline-flex;
    align-items: center;
    padding: 5px 10px;
    border-radius: 999px;
    background: #fff0f6;
    color: #c91564;
    font-size: 11px;
    font-weight: 700;
}

.stock-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    padding-top: 18px;
}

.stock-muted {
    color: #718096;
    font-size: 13px;
}

.stock-empty {
    padding: 30px !important;
    text-align: center;
    color: #718096 !important;
}

@media (max-width: 1100px) {
    .stock-cards {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 600px) {
    .stock-page {
        padding: 18px 12px;
    }

    .stock-heading h1 {
        font-size: 25px;
    }

    .stock-cards {
        grid-template-columns: 1fr;
    }

    .stock-panel {
        padding: 12px;
    }

    .stock-filters {
        align-items: stretch;
    }

    .stock-filters input,
    .stock-filters select,
    .stock-filter-button {
        width: 100%;
        min-width: 0;
    }
}


    </style>

</head>

<body>
<div class="app-shell">
    @include('pos.partials.sidebar')

    <main class="workspace">
        <div class="sh-products-page">

            <header class="topbar products-topbar">
                <div class="products-topbar-spacer"></div>

                <div class="top-actions">
                    <div class="register">
                        <span>Register #04</span>
                        <strong><i class="fa-solid fa-circle"></i> Online</strong>
                    </div>

                    <div class="cashier-menu">
                        <button type="button"
                                class="cashier"
                                id="productsCashierDropdownBtn"
                                aria-label="Open cashier menu"
                                aria-expanded="false">
                            <div class="avatar">CA</div>
                            <div class="cashier-info">
                                <strong>{{ auth()->user()->name ?? 'Cashier' }}</strong>
                                <span>Cashier</span>
                            </div>
                            <i class="fa-solid fa-chevron-down cashier-chevron"></i>
                        </button>

                        <div class="cashier-dropdown" id="productsCashierDropdown">
                            <div class="cashier-dropdown-user">
                                <div class="cashier-dropdown-avatar">CA</div>
                                <div>
                                    <strong>{{ auth()->user()->name ?? 'Cashier' }}</strong>
                                    <span>Cashier</span>
                                </div>
                            </div>

                            <div class="cashier-dropdown-divider"></div>

                            <a href="{{ route('pos.profile') }}"
                               class="cashier-dropdown-item">
                                <i class="fa-regular fa-user"></i>
                                <span>My Profile</span>
                            </a>

                            <a href="{{ route('pos.settings') }}"
                               class="cashier-dropdown-item">
                                <i class="fa-solid fa-gear"></i>
                                <span>Settings</span>
                            </a>

                            <div class="cashier-dropdown-divider"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="cashier-dropdown-item logout-item">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="stock-page">
                <div class="stock-heading">
                    <h1>Stock Movements</h1>
                    <div class="stock-muted">
                        Shine &amp; Smile · Inventory history
                    </div>
                </div>

    </section>

    <section class="panel">
        <form method="GET"
              action="{{ route('pos.inventory.stock-movements') }}"
              class="filters">
            <input
                type="search"
                name="search"
                placeholder="Search product, SKU, reference, user..."
                value="{{ request('search') }}"
            >

            <select name="type">
                <option value="">All movement types</option>
                @foreach (['in', 'out', 'adjustment', 'return', 'expired', 'damaged'] as $type)
                    <option value="{{ $type }}"
                        @selected(request('type') === $type)>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="from" aria-label="From date"
                   value="{{ request('from') }}">
            <input type="date" name="to" aria-label="To date"
                   value="{{ request('to') }}">

		<button type="submit" class="stock-filter-button">Filter</button>
<a class="reset" href="{{ route('pos.inventory.stock-movements') }}">Reset</a>
        </form>

        <div class="table-wrap">
		<table class="stock-table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Movement</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Stock before</th>
                    <th>Stock after</th>
                    <th>Reference</th>
                    <th>Recorded by</th>
                    <th>Notes</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($movements as $movement)
                    <tr>
                        <td>
                            {{ $movement->movement_date?->format('M d, Y H:i') ?? '—' }}
                        </td>
                        <td>
                            <strong>{{ $movement->product?->product_name ?? 'Deleted product' }}</strong>
                            <div class="muted">
                                {{ $movement->product?->sku ?? 'No SKU' }}
                            </div>
                        </td>
                        <td>
                            <span class="badge {{ $movement->movement_type }}">
                                {{ ucfirst($movement->movement_type) }}
                            </span>
                        </td>
                        <td>{{ number_format($movement->quantity) }}</td>
                        <td>{{ $movement->product?->unit ?? '—' }}</td>
                        <td>{{ number_format($movement->stock_before) }}</td>
                        <td>{{ number_format($movement->stock_after) }}</td>
                        <td>
                            {{ $movement->reference_type ?: '—' }}
                            @if ($movement->reference_id)
                                #{{ $movement->reference_id }}
                            @endif
                        </td>
                        <td>{{ $movement->creator?->name ?? 'System / Unknown' }}</td>
                        <td>
                            {{ \Illuminate\Support\Str::limit($movement->notes ?? '—', 55) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="empty">
                            No stock movements match your filters.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <span class="muted">
                Showing {{ $movements->firstItem() ?? 0 }}
                – {{ $movements->lastItem() ?? 0 }}
                of {{ $movements->total() }} movements
            </span>
            {{ $movements->links() }}
        </div>
    </section>
            </main>
        </div>
    </main>
</div>

<script src="{{ asset('js/pos/products.js') }}" defer></script>
</body>
</html>
