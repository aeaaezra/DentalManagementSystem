<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PinkCart — Ordering System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/orders/products.css') }}"
    >
</head>

<body>

<div class="app-shell">

    {{-- =========================================================
        DESKTOP SIDEBAR
    ========================================================== --}}
    <aside class="sidebar">

        {{-- BRAND --}}
        <div class="brand">

            <div class="brand-mark">
                P
            </div>

            <div>
                <strong>PinkCart</strong>
                <span>Ordering System</span>
            </div>

        </div>


        {{-- NAVIGATION --}}
        <nav class="side-nav">

            {{-- HOME --}}
            <button
                type="button"
                class="nav-item active"
                data-view="home"
            >
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 10.5L12 3l9 7.5"></path>
                        <path d="M5 9.5V21h14V9.5"></path>
                        <path d="M9 21v-6h6v6"></path>
                    </svg>
                </span>

                <span>Home</span>
            </button>


            {{-- PRODUCTS --}}
            <button
                type="button"
                class="nav-item"
                data-view="products"
            >
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                        <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                        <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                        <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                    </svg>
                </span>

                <span>Products</span>
            </button>


            {{-- ORDERS --}}
            <button
                type="button"
                class="nav-item"
                data-view="orders"
            >
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 7v5l3 2"></path>
                    </svg>
                </span>

                <span>My Orders</span>
            </button>


            {{-- FAVORITES --}}
            <button
                type="button"
                class="nav-item"
                data-view="favorites"
            >
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M20.8 8.7c0 5.5-8.8 10.3-8.8 10.3S3.2 14.2 3.2 8.7A4.7 4.7 0 0 1 12 6.1a4.7 4.7 0 0 1 8.8 2.6Z"></path>
                    </svg>
                </span>

                <span>Favorites</span>
            </button>

        </nav>


        {{-- CART SIDEBAR CARD --}}
        <div class="sidebar-card">

            <span class="mini-label">
                YOUR CART
            </span>

            <div class="side-cart-row">

                <div class="cart-icon">

                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 4h2l2.1 11.1a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"></path>
                        <circle cx="9" cy="20" r="1"></circle>
                        <circle cx="18" cy="20" r="1"></circle>
                    </svg>

                </div>

                <div>

                    <strong id="sideCartCount">
                        0 items
                    </strong>

                    <span id="sideCartTotal">
                        ₱0.00
                    </span>

                </div>

            </div>

            <button
                type="button"
                class="pink-btn full"
                id="sideCheckoutBtn"
            >
                View Cart
            </button>

        </div>


        {{-- USER --}}
        <div class="sidebar-user">

            <div class="avatar">
                MA
            </div>

            <div>
                <strong>My Account</strong>
                <span>Customer</span>
            </div>

            <button
                type="button"
                aria-label="Settings"
            >

                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.7 1.7-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.5v.2h-2.4v-.2a1.7 1.7 0 0 0-1-1.5 1.7 1.7 0 0 0-1.9.3l-.1.1L7 17l.1-.1A1.7 1.7 0 0 0 7.4 15a1.7 1.7 0 0 0-1.5-1H5.7v-2.4h.2a1.7 1.7 0 0 0 1.5-1A1.7 1.7 0 0 0 7.1 9L7 8.9l1.7-1.7.1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.5v-.2h2.4v.2a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.9-.3l.1-.1L19.8 9l-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 1.5 1h.2v2.4h-.2a1.7 1.7 0 0 0-1.5.6Z"></path>
                </svg>

            </button>

        </div>

    </aside>


    {{-- =========================================================
        MAIN
    ========================================================== --}}
    <main class="main">


        {{-- =====================================================
            TOP HEADER
        ====================================================== --}}
        <header class="topbar">

            {{-- MOBILE BRAND --}}
            <div class="mobile-brand">

                <div class="brand-mark">
                    P
                </div>

                <strong>
                    PinkCart
                </strong>

            </div>


            {{-- LOCATION --}}
            <div class="location">

                <span>
                    Deliver to
                </span>

                <strong>
                    Home · General Santos City
                </strong>

            </div>


            {{-- HEADER ACTIONS --}}
            <div class="header-actions">

                {{-- SEARCH --}}
                <button
                    type="button"
                    class="icon-btn"
                    id="searchToggle"
                    aria-label="Search"
                >

                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m20 20-4-4"></path>
                    </svg>

                </button>


                {{-- CART --}}
                <button
                    type="button"
                    class="icon-btn cart-button"
                    id="cartBtn"
                    aria-label="Cart"
                >

                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 4h2l2.1 11.1a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"></path>
                        <circle cx="9" cy="20" r="1"></circle>
                        <circle cx="18" cy="20" r="1"></circle>
                    </svg>

                    <b id="cartBadge">
                        0
                    </b>

                </button>


                {{-- AVATAR --}}
                <button
                    type="button"
                    class="avatar small"
                >
                    MA
                </button>

            </div>

        </header>



<div class="search-wrap" id="searchWrap">

    <form
        method="GET"
        action="{{ route('customer.products') }}"
    >

        <div class="search-input-wrapper">

            <svg
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <circle
                    cx="11"
                    cy="11"
                    r="7"
                ></circle>

                <path
                    d="m20 20-4-4"
                ></path>
            </svg>

            <input
                id="searchInput"
                name="search"
                type="search"
                value="{{ request('search') }}"
                placeholder="Search products, categories..."
                autocomplete="off"
            >

        </div>

    </form>

</div>


        {{-- =====================================================
            HOME VIEW
        ====================================================== --}}
        <section
            class="view active"
            id="homeView"
        >


            {{-- HERO --}}
            <section class="hero">

                <div class="hero-copy">

                    <span class="eyebrow">
                        NEW COLLECTION
                    </span>

                    <h1>
                        Everything you love,
                        <br>
                        <em>delivered.</em>
                    </h1>

                    <p>
                        Discover popular products, fresh deals,
                        and everyday essentials in one place.
                    </p>

                    <button
                        type="button"
                        class="pink-btn"
                        data-view="products"
                    >
                        Shop Now

                        <span>
                            →
                        </span>
                    </button>

                </div>


                <div class="hero-art">

                    <div class="hero-circle"></div>

                    <div class="hero-product">

                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 3v18M3 12h18"></path>
                        </svg>

                    </div>

                    <span class="float-tag tag-one">
                        20% OFF
                    </span>

                    <span class="float-tag tag-two">
                        BEST SELLER
                    </span>

                </div>

            </section>


            {{-- QUICK SERVICES --}}
            <section class="quick-services">


                {{-- DELIVERY --}}
                <div>

                    <span>

                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M3 6h11v10H3z"></path>
                            <path d="M14 9h4l3 3v4h-7z"></path>
                            <circle cx="7" cy="18" r="2"></circle>
                            <circle cx="18" cy="18" r="2"></circle>
                        </svg>

                    </span>

                    <div>
                        <strong>
                            Fast Delivery
                        </strong>

                        <small>
                            Same-day available
                        </small>
                    </div>

                </div>


                {{-- RETURNS --}}
                <div>

                    <span>

                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M9 7H5v4"></path>
                            <path d="M5 11a7 7 0 1 0 2-5"></path>
                            <path d="M5 7l4 0"></path>
                        </svg>

                    </span>

                    <div>
                        <strong>
                            Easy Returns
                        </strong>

                        <small>
                            7-day return policy
                        </small>
                    </div>

                </div>


                {{-- SECURITY --}}
                <div>

                    <span>

                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="5" y="10" width="14" height="10" rx="2"></rect>
                            <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                        </svg>

                    </span>

                    <div>
                        <strong>
                            Secure Payment
                        </strong>

                        <small>
                            100% protected
                        </small>
                    </div>

                </div>


                {{-- SUPPORT --}}
                <div>

                    <span>

                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M5 6h14v10H8l-4 4V6z"></path>
                            <path d="M8 10h8M8 13h5"></path>
                        </svg>

                    </span>

                    <div>
                        <strong>
                            24/7 Support
                        </strong>

                        <small>
                            We're here to help
                        </small>
                    </div>

                </div>

            </section>


            {{-- =================================================
                CATEGORIES
            ================================================== --}}
            <section class="section-block">

                <div class="section-heading">

                    <div>

                        <span class="eyebrow">
                            EXPLORE
                        </span>

                        <h2>
                            Shop by Category
                        </h2>

                    </div>

                    <button
                        type="button"
                        class="text-btn"
                        data-view="products"
                    >
                        View all →
                    </button>

                </div>


                <div
                    class="categories"
                    id="categoryList"
                >

                    {{-- ALL --}}
                    <a
                        href="{{ route('customer.products') }}"
                        class="category-card"
                    >

                        <div class="category-icon">

                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                <path d="M8 9h8M8 13h8M8 17h5"></path>
                            </svg>

                        </div>

                        <strong>
                            All Items
                        </strong>

                    </a>


                    {{-- DATABASE CATEGORIES --}}
                    @foreach($categories as $category)

                        <a
                            href="{{ route('customer.products', ['category' => $category]) }}"
                            class="category-card"
                        >

                            <div class="category-icon">

                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M4 7h16"></path>
                                    <path d="M6 7v12h12V7"></path>
                                    <path d="M9 7V5h6v2"></path>
                                </svg>

                            </div>

                            <strong>
                                {{ $category }}
                            </strong>

                        </a>

                    @endforeach

                </div>

            </section>


            {{-- =================================================
                BEST SELLERS
            ================================================== --}}
            <section class="section-block">

                <div class="section-heading">

                    <div>

                        <span class="eyebrow">
                            TRENDING NOW
                        </span>

                        <h2>
                            Best Sellers
                        </h2>

                    </div>

                    <button
                        type="button"
                        class="text-btn"
                        data-view="products"
                    >
                        See all →
                    </button>

                </div>


                <div
                    class="product-grid"
                    id="bestSellerGrid"
                >

                    @forelse($products->take(4) as $product)

                        <article
                            class="product-card"
                            data-product-id="{{ $product->id }}"
                        >

                            {{-- IMAGE --}}
                            <div class="product-image">

                                @if($product->image)

                                    <img
                                        src="{{ asset($product->image) }}"
                                        alt="{{ $product->product_name }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="product-placeholder">

                                        <svg viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M4 5h16v14H4z"></path>
                                            <circle cx="9" cy="10" r="2"></circle>
                                            <path d="m4 17 5-5 3 3 2-2 6 6"></path>
                                        </svg>

                                    </div>

                                @endif


                                {{-- STOCK --}}
                                @if($product->quantity <= 0)

                                    <span class="stock-badge out">
                                        Out of Stock
                                    </span>

                                @elseif(
                                    $product->reorder_level > 0 &&
                                    $product->quantity <= $product->reorder_level
                                )

                                    <span class="stock-badge low">
                                        Only {{ $product->quantity }} left
                                    </span>

                                @else

                                    <span class="stock-badge">
                                        In Stock
                                    </span>

                                @endif

                            </div>


                            {{-- INFO --}}
                            <div class="product-info">

                                <span class="product-category">
                                    {{ $product->category ?? 'Dental Supply' }}
                                </span>

                                <h3>
                                    {{ $product->product_name }}
                                </h3>

                                @if($product->brand_name)

                                    <span class="product-brand">
                                        {{ $product->brand_name }}
                                    </span>

                                @endif

                                @if($product->description)

                                    <p>
                                        {{ Str::limit($product->description, 80) }}
                                    </p>

                                @endif


                                <div class="product-bottom">

                                    <strong class="product-price">
                                        ₱{{ number_format($product->selling_price, 2) }}
                                    </strong>


                                    @if($product->quantity > 0)

                                        <button
                                            type="button"
                                            class="add-cart-btn"
                                            data-product-id="{{ $product->id }}"
                                            data-product-name="{{ $product->product_name }}"
                                            data-product-price="{{ $product->selling_price }}"
                                            data-product-stock="{{ $product->quantity }}"
                                        >

                                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M3 4h2l2.1 11.1a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"></path>
                                                <circle cx="9" cy="20" r="1"></circle>
                                                <circle cx="18" cy="20" r="1"></circle>
                                            </svg>

                                            Add

                                        </button>

                                    @else

                                        <button
                                            type="button"
                                            class="add-cart-btn disabled"
                                            disabled
                                        >
                                            Out of Stock
                                        </button>

                                    @endif

                                </div>

                            </div>

                        </article>

                    @empty

                        <div class="empty-products">

                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="11" cy="11" r="7"></circle>
                                <path d="m20 20-4-4"></path>
                            </svg>

                            <h3>
                                No products found
                            </h3>

                            <p>
                                There are currently no available products.
                            </p>

                        </div>

                    @endforelse

                </div>

            </section>

        </section>


        {{-- =====================================================
            PRODUCTS VIEW
        ====================================================== --}}
        <section
            class="view"
            id="productsView"
        >

            <div class="page-heading">

                <div>

                    <span class="eyebrow">
                        CATALOG
                    </span>

                    <h1>
                        All Products
                    </h1>

                    <p>
                        Find something you'll love.
                    </p>

                </div>

            </div>


            {{-- FILTER FORM --}}
            <form
                method="GET"
                action="{{ route('customer.products') }}"
                class="filter-row"
                id="filterRow"
            >

                {{-- SEARCH --}}
                <div class="filter-control">

                    <label for="catalogSearch">
                        Search
                    </label>

                    <input
                        type="search"
                        id="catalogSearch"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products..."
                    >

                </div>


                {{-- CATEGORY --}}
                <div class="filter-control">

                    <label for="category">
                        Category
                    </label>

                    <select
                        id="category"
                        name="category"
                    >

                        <option value="All Items">
                            All Items
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category }}"
                                @selected(request('category') === $category)
                            >
                                {{ $category }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- PRICE --}}
                <div class="filter-control">

                    <label for="price">
                        Price
                    </label>

                    <select
                        id="price"
                        name="price"
                    >

                        <option value="">
                            Any Price
                        </option>

                        <option
                            value="under500"
                            @selected(request('price') === 'under500')
                        >
                            Under ₱500
                        </option>

                        <option
                            value="500to2000"
                            @selected(request('price') === '500to2000')
                        >
                            ₱500 – ₱2,000
                        </option>

                        <option
                            value="above2000"
                            @selected(request('price') === 'above2000')
                        >
                            Above ₱2,000
                        </option>

                    </select>

                </div>


                {{-- SORT --}}
                <div class="filter-control">

                    <label for="sort">
                        Sort
                    </label>

                    <select
                        id="sort"
                        name="sort"
                    >

                        <option value="">
                            Latest
                        </option>

                        <option
                            value="low"
                            @selected(request('sort') === 'low')
                        >
                            Price: Low to High
                        </option>

                        <option
                            value="high"
                            @selected(request('sort') === 'high')
                        >
                            Price: High to Low
                        </option>

                        <option
                            value="name"
                            @selected(request('sort') === 'name')
                        >
                            Name: A–Z
                        </option>

                    </select>

                </div>


                {{-- STOCK --}}
                <label class="stock-filter">

                    <input
                        type="checkbox"
                        name="in_stock"
                        value="1"
                        @checked(request('in_stock'))
                    >

                    <span>
                        In Stock Only
                    </span>

                </label>


                {{-- SUBMIT --}}
                <button
                    type="submit"
                    class="pink-btn"
                >
                    Apply Filters
                </button>


                {{-- RESET --}}
                <a
                    href="{{ route('customer.products') }}"
                    class="text-btn"
                >
                    Reset
                </a>

            </form>


            {{-- PRODUCT GRID --}}
            <div
                class="product-grid large"
                id="productGrid"
            >

                @forelse($products as $product)

                    <article
                        class="product-card"
                        data-product-id="{{ $product->id }}"
                    >

                        {{-- PRODUCT IMAGE --}}
                        <div class="product-image">

                            @if($product->image)

                                <img
                                    src="{{ asset($product->image) }}"
                                    alt="{{ $product->product_name }}"
                                    loading="lazy"
                                >

                            @else

                                <div class="product-placeholder">

                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M4 5h16v14H4z"></path>
                                        <circle cx="9" cy="10" r="2"></circle>
                                        <path d="m4 17 5-5 3 3 2-2 6 6"></path>
                                    </svg>

                                </div>

                            @endif


                            {{-- STOCK STATUS --}}
                            @if($product->quantity <= 0)

                                <span class="stock-badge out">
                                    Out of Stock
                                </span>

                            @elseif(
                                $product->reorder_level > 0 &&
                                $product->quantity <= $product->reorder_level
                            )

                                <span class="stock-badge low">
                                    Only {{ $product->quantity }} left
                                </span>

                            @else

                                <span class="stock-badge">
                                    In Stock
                                </span>

                            @endif


                            {{-- FAVORITE --}}
                            <button
                                type="button"
                                class="favorite-btn"
                                data-product-id="{{ $product->id }}"
                                aria-label="Add to favorites"
                            >

                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M20.8 8.7c0 5.5-8.8 10.3-8.8 10.3S3.2 14.2 3.2 8.7A4.7 4.7 0 0 1 12 6.1a4.7 4.7 0 0 1 8.8 2.6Z"></path>
                                </svg>

                            </button>

                        </div>


                        {{-- PRODUCT INFORMATION --}}
                        <div class="product-info">

                            <span class="product-category">
                                {{ $product->category ?? 'Dental Supply' }}
                            </span>

                            <h3>
                                {{ $product->product_name }}
                            </h3>


                            @if($product->brand_name)

                                <span class="product-brand">
                                    {{ $product->brand_name }}
                                </span>

                            @endif


                            @if($product->description)

                                <p>
                                    {{ Str::limit($product->description, 90) }}
                                </p>

                            @endif


                            {{-- SKU --}}
                            @if($product->sku)

                                <small class="product-sku">
                                    SKU: {{ $product->sku }}
                                </small>

                            @endif


                            <div class="product-bottom">

                                <strong class="product-price">
                                    ₱{{ number_format($product->selling_price, 2) }}
                                </strong>


                                @if($product->quantity > 0)

                                    <button
                                        type="button"
                                        class="add-cart-btn"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->product_name }}"
                                        data-product-price="{{ $product->selling_price }}"
                                        data-product-stock="{{ $product->quantity }}"
                                    >

                                        <svg viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M3 4h2l2.1 11.1a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"></path>
                                            <circle cx="9" cy="20" r="1"></circle>
                                            <circle cx="18" cy="20" r="1"></circle>
                                        </svg>

                                        Add

                                    </button>

                                @else

                                    <button
                                        type="button"
                                        class="add-cart-btn disabled"
                                        disabled
                                    >
                                        Out of Stock
                                    </button>

                                @endif

                            </div>

                        </div>

                    </article>

                @empty

                    <div class="empty-products">

                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="11" cy="11" r="7"></circle>
                            <path d="m20 20-4-4"></path>
                        </svg>

                        <h3>
                            No products found
                        </h3>

                        <p>
                            Try another search, category, or price range.
                        </p>

                        <a href="{{ route('customer.products') }}">
                            View All Products
                        </a>

                    </div>

                @endforelse

            </div>


            {{-- PAGINATION --}}
            @if($products->hasPages())

                <div class="pagination-wrapper">

                    {{ $products->links() }}

                </div>

            @endif

        </section>


        {{-- =====================================================
            ORDERS VIEW
        ====================================================== --}}
        <section
            class="view"
            id="ordersView"
        >

            <div class="page-heading">

                <div>

                    <span class="eyebrow">
                        ACCOUNT
                    </span>

                    <h1>
                        My Orders
                    </h1>

                    <p>
                        Track your recent purchases.
                    </p>

                </div>

            </div>


            <div
                class="orders-list"
                id="ordersList"
            >

                <a
                    href="{{ route('customer.orders') }}"
                    class="pink-btn"
                >
                    View My Orders
                </a>

            </div>

        </section>


        {{-- =====================================================
            FAVORITES VIEW
        ====================================================== --}}
        <section
            class="view"
            id="favoritesView"
        >

            <div class="page-heading">

                <div>

                    <span class="eyebrow">
                        SAVED FOR LATER
                    </span>

                    <h1>
                        Favorites
                    </h1>

                    <p>
                        Your favorite products in one place.
                    </p>

                </div>

            </div>


            <div
                class="product-grid large"
                id="favoriteGrid"
            >

                <div class="empty-products">

                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M20.8 8.7c0 5.5-8.8 10.3-8.8 10.3S3.2 14.2 3.2 8.7A4.7 4.7 0 0 1 12 6.1a4.7 4.7 0 0 1 8.8 2.6Z"></path>
                    </svg>

                    <h3>
                        No favorites yet
                    </h3>

                    <p>
                        Save products you want to find quickly later.
                    </p>

                </div>

            </div>

        </section>

    </main>

</div>


{{-- =============================================================
    MOBILE BOTTOM NAVIGATION
============================================================== --}}
<nav class="bottom-nav">


    {{-- HOME --}}
    <button
        type="button"
        class="nav-item active"
        data-view="home"
    >

        <span>

            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M3 10.5L12 3l9 7.5"></path>
                <path d="M5 9.5V21h14V9.5"></path>
                <path d="M9 21v-6h6v6"></path>
            </svg>

        </span>

        <small>
            Home
        </small>

    </button>


    {{-- SHOP --}}
    <button
        type="button"
        class="nav-item"
        data-view="products"
    >

        <span>

            <svg viewBox="0 0 24 24" aria-hidden="true">
                <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                <rect x="14" y="14" width="6" height="6" rx="1"></rect>
            </svg>

        </span>

        <small>
            Shop
        </small>

    </button>


    {{-- ORDERS --}}
    <button
        type="button"
        class="nav-item"
        data-view="orders"
    >

        <span>

            <svg viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="12" r="9"></circle>
                <path d="M12 7v5l3 2"></path>
            </svg>

        </span>

        <small>
            Orders
        </small>

    </button>


    {{-- FAVORITES --}}
    <button
        type="button"
        class="nav-item"
        data-view="favorites"
    >

        <span>

            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M20.8 8.7c0 5.5-8.8 10.3-8.8 10.3S3.2 14.2 3.2 8.7A4.7 4.7 0 0 1 12 6.1a4.7 4.7 0 0 1 8.8 2.6Z"></path>
            </svg>

        </span>

        <small>
            Saved
        </small>

    </button>


    {{-- CART --}}
    <button
        type="button"
        class="nav-item"
        id="mobileCart"
    >

        <span class="mobile-cart-icon">

            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M3 4h2l2.1 11.1a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"></path>
                <circle cx="9" cy="20" r="1"></circle>
                <circle cx="18" cy="20" r="1"></circle>
            </svg>

            <b id="mobileCartBadge">
                0
            </b>

        </span>

        <small>
            Cart
        </small>

    </button>

</nav>


{{-- =============================================================
    PRODUCT DETAILS MODAL
============================================================== --}}
<div
    class="modal"
    id="productModal"
    aria-hidden="true"
>

    <div class="modal-backdrop"></div>

    <div class="product-modal">

        <button
            type="button"
            class="close-btn"
            data-close="productModal"
            aria-label="Close"
        >
            ×
        </button>


        <div
            class="detail-image"
            id="detailImage"
        >
        </div>


        <div class="detail-info">

            <div
                class="rating"
                id="detailRating"
            >
            </div>

            <h2 id="detailName"></h2>

            <div
                class="detail-price"
                id="detailPrice"
            >
            </div>

            <p id="detailDescription"></p>


            <div class="option-title">
                Select Quantity
            </div>


            <div class="quantity">

                <button
                    type="button"
                    id="detailMinus"
                >
                    −
                </button>

                <strong id="detailQty">
                    1
                </strong>

                <button
                    type="button"
                    id="detailPlus"
                >
                    +
                </button>

            </div>


            <button
                type="button"
                class="pink-btn full"
                id="detailAdd"
            >
                Add to Cart
            </button>

        </div>

    </div>

</div>


{{-- =============================================================
    CART DRAWER
============================================================== --}}
<div
    class="drawer-overlay"
    id="drawerOverlay"
>
</div>


<aside
    class="cart-drawer"
    id="cartDrawer"
>

    <div class="drawer-head">

        <div>

            <span class="eyebrow">
                YOUR BAG
            </span>

            <h2>
                My Cart
            </h2>

        </div>

        <button
            type="button"
            class="close-btn"
            id="closeCart"
            aria-label="Close cart"
        >
            ×
        </button>

    </div>


    <div
        class="cart-items"
        id="cartItems"
    >
    </div>


    {{-- EMPTY CART --}}
    <div
        class="cart-empty"
        id="cartEmpty"
    >

        <div>

            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M3 4h2l2.1 11.1a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"></path>
                <circle cx="9" cy="20" r="1"></circle>
                <circle cx="18" cy="20" r="1"></circle>
            </svg>

        </div>

        <h3>
            Your cart is empty
        </h3>

        <p>
            Add a few products and they'll appear here.
        </p>

    </div>


    {{-- CART FOOTER --}}
    <div class="cart-footer">

        <div>
            <span>
                Subtotal
            </span>

            <strong id="cartSubtotal">
                ₱0.00
            </strong>
        </div>


        <div>
            <span>
                Delivery
            </span>

            <strong id="cartDelivery">
                ₱0.00
            </strong>
        </div>


        <div class="total">

            <span>
                Total
            </span>

            <strong id="cartTotal">
                ₱0.00
            </strong>

        </div>


        <button
            type="button"
            class="pink-btn full"
            id="checkoutBtn"
        >
            Proceed to Checkout
        </button>

    </div>

</aside>


{{-- =============================================================
    CHECKOUT MODAL
============================================================== --}}
<div
    class="modal"
    id="checkoutModal"
    aria-hidden="true"
>

    <div class="modal-backdrop"></div>

    <div class="checkout-modal">

        <button
            type="button"
            class="close-btn"
            data-close="checkoutModal"
            aria-label="Close"
        >
            ×
        </button>


        <div class="checkout-head">

            <span class="eyebrow">
                SECURE CHECKOUT
            </span>

            <h2>
                Complete your order
            </h2>

        </div>


        <div class="checkout-steps">

            <span class="active">
                1. Address
            </span>

            <span>
                2. Payment
            </span>

            <span>
                3. Review
            </span>

        </div>


        <form
            id="checkoutForm"
            method="POST"
            id="checkoutForm"
        >

            @csrf


            {{-- NAME --}}
            <label>

                Full Name

                <input
                    required
                    name="name"
                    value="{{ auth()->user()->name ?? '' }}"
                    placeholder="Your full name"
                >

            </label>


            {{-- ADDRESS --}}
            <label>

                Delivery Address

                <textarea
                    required
                    name="address"
                    placeholder="House number, street, barangay, city"
                ></textarea>

            </label>


            {{-- PHONE --}}
            <label>

                Phone Number

                <input
                    required
                    name="phone"
                    type="tel"
                    placeholder="09XX XXX XXXX"
                >

            </label>


            {{-- PAYMENT --}}
            <label>

                Payment Method

                <select
                    name="payment"
                    required
                >

                    <option value="Cash on Delivery">
                        Cash on Delivery
                    </option>

                    <option value="GCash">
                        GCash
                    </option>

                    <option value="Credit / Debit Card">
                        Credit / Debit Card
                    </option>

                </select>

            </label>


            {{-- ORDER ITEMS
                 JavaScript should populate this before submitting --}}
            <input
                type="hidden"
                name="items"
                id="checkoutItems"
            >


            {{-- TOTAL --}}
            <div class="checkout-summary">

                <span>
                    Order total
                </span>

                <strong id="checkoutTotal">
                    ₱0.00
                </strong>

            </div>


            <button
                class="pink-btn full"
                type="submit"
            >

                Place Order

                <span>
                    →
                </span>

            </button>

        </form>

    </div>

</div>


    class="toast"
    id="toast"
>
</div>




<script src="{{ asset('js/orders/products.js') }}"></script>


</body>
</html>
