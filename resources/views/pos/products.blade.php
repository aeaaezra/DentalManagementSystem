
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Shine &amp; Smile POS</title>
<link rel="stylesheet"
      href="{{ asset('css/pos/pos_homepage.css') }}?v={{ time() }}">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link rel="stylesheet"
      href="{{ asset('css/pos/products.css') }}?v={{ time() }}">

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
            <button
                type="button"
                class="cashier"
                id="productsCashierDropdownBtn"
                aria-label="Open cashier menu"
                aria-expanded="false"
            >
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

                <a href="{{ route('pos.profile') }}" class="cashier-dropdown-item">
                    <i class="fa-regular fa-user"></i>
                    <span>My Profile</span>
                </a>

                <a href="{{ route('pos.settings') }}" class="cashier-dropdown-item">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </a>

                <div class="cashier-dropdown-divider"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="cashier-dropdown-item logout-item">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Log Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

        <section class="sh-products-card">
            <form method="GET" action="{{ route('pos.products') }}"
                  class="sh-products-filters">
                <input type="search" name="search"
                       value="{{ request('search') }}"
                       placeholder="Search name, SKU, barcode or brand">

                <select name="category">
                    <option value="">All categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}"
                            @selected(request('category') === $category)>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="sh-btn sh-btn-primary">Search</button>
                <a href="{{ route('pos.products') }}" class="sh-btn sh-btn-light">Reset</a>
            </form>

            <div class="sh-products-table-wrap">
                <table class="sh-products-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Barcode</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    <strong>{{ $product->product_name }}</strong>
                                    <small>{{ $product->brand_name }}</small>
                                </td>
                                <td>{{ $product->sku ?: '—' }}</td>
                                <td>{{ $product->barcode ?: '—' }}</td>
                                <td>{{ $product->category ?: 'Uncategorized' }}</td>
                                <td>{{ $product->unit ?: '—' }}</td>
                                <td>₱{{ number_format((float) $product->selling_price, 2) }}</td>
                                <td>{{ (int) $product->quantity }} {{ $product->unit ?: 'units' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="sh-products-empty">
                                    No products found. Try resetting your filters.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            <div class="sh-products-pagination">
                {{ $products->links() }}
            </div>
        </section>
        </main>
    </div>
</div>
<script src="{{ asset('js/pos/products.js') }}" defer></script>
</body>
</html>

