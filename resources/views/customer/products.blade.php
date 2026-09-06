
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        Shine & Smile | Products
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/customer/product.css') }}"
    >


<style>
/* =========================================================
   SHINE & SMILE — PROFESSIONAL CUSTOMER SHOP OVERRIDES
   Keeps the existing Blade/JS hooks intact.
   ========================================================= */
:root{
    --ss-pink:#e91e63;
    --ss-pink-dark:#c2185b;
    --ss-pink-soft:#fff0f6;
    --ss-pink-soft-2:#ffe3ef;
    --ss-text:#241923;
    --ss-muted:#756874;
    --ss-border:#f0dfe8;
    --ss-white:#fff;
    --ss-shadow:0 14px 40px rgba(76,28,54,.08);
    --ss-radius:22px;
}

html{scroll-behavior:smooth}
body{
    background:
        radial-gradient(circle at 8% 0%, rgba(233,30,99,.08), transparent 28rem),
        linear-gradient(180deg,#fff 0%,#fff8fb 100%);
    color:var(--ss-text);
}
.customer-header{
    position:sticky;
    top:0;
    z-index:1000;
    min-height:76px;
    background:rgba(255,255,255,.94);
    border-bottom:1px solid rgba(233,30,99,.10);
    box-shadow:0 6px 24px rgba(76,28,54,.06);
    backdrop-filter:blur(16px);
}
.brand{transition:transform .2s ease}
.brand:hover{transform:translateY(-1px)}
.brand-icon{
    background:linear-gradient(135deg,var(--ss-pink),#f06292);
    box-shadow:0 8px 20px rgba(233,30,99,.24);
}
.brand-text h1{letter-spacing:-.03em}
.customer-nav .nav-link{
    position:relative;
    font-weight:700;
    transition:color .2s ease,background .2s ease;
}
.customer-nav .nav-link.active{
    color:var(--ss-pink);
}
.customer-nav .nav-link.active::after{
    content:"";
    position:absolute;
    left:18px;
    right:18px;
    bottom:-9px;
    height:3px;
    border-radius:99px;
    background:linear-gradient(90deg,var(--ss-pink),#f06292);
}
.cart-button{
    position:relative;
    transition:transform .2s ease,box-shadow .2s ease;
}
.cart-button:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 24px rgba(233,30,99,.15);
}
#cartCount{
    min-width:20px;
    height:20px;
    padding:0 6px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:999px;
    background:var(--ss-pink);
    color:#fff;
    font-size:11px;
    font-weight:800;
}
.shop-hero{
    position:relative;
    overflow:hidden;
    border:1px solid rgba(233,30,99,.10);
    background:
        radial-gradient(circle at 85% 30%,rgba(255,255,255,.95),transparent 13rem),
        linear-gradient(135deg,#fff1f6 0%,#ffe4ef 52%,#fff 100%);
    box-shadow:var(--ss-shadow);
}
.shop-hero::before,
.shop-hero::after{
    content:"";
    position:absolute;
    border-radius:50%;
    pointer-events:none;
}
.shop-hero::before{
    width:240px;height:240px;
    right:-100px;top:-120px;
    background:rgba(233,30,99,.09);
}
.shop-hero::after{
    width:130px;height:130px;
    left:42%;bottom:-90px;
    background:rgba(255,255,255,.75);
}
.hero-label,.section-label{
    color:var(--ss-pink);
    font-weight:800;
    letter-spacing:.13em;
}
.shop-hero h2{
    font-size:clamp(2rem,4vw,3.6rem);
    line-height:1.02;
    letter-spacing:-.045em;
    max-width:680px;
}
.shop-hero p{
    color:var(--ss-muted);
    font-size:1.05rem;
    max-width:600px;
}
.shop-now-button,
.checkout-button,
.modal-add-button,
.add-cart-button{
    background:linear-gradient(135deg,var(--ss-pink),#f06292);
    border:0;
    box-shadow:0 10px 22px rgba(233,30,99,.22);
    transition:transform .2s ease,box-shadow .2s ease,filter .2s ease;
}
.shop-now-button:hover,
.checkout-button:hover:not(:disabled),
.modal-add-button:hover,
.add-cart-button:hover{
    transform:translateY(-2px);
    filter:saturate(1.06);
    box-shadow:0 14px 28px rgba(233,30,99,.28);
}
.hero-tooth{
    filter:drop-shadow(0 18px 24px rgba(233,30,99,.16));
}
.shop-section{
    padding-top:48px;
}
.section-heading h2{
    letter-spacing:-.035em;
}
#productCount{
    color:var(--ss-pink);
    background:var(--ss-pink-soft);
    border:1px solid var(--ss-pink-soft-2);
    border-radius:999px;
    padding:9px 14px;
    font-size:.85rem;
    font-weight:800;
}
.shop-toolbar{
    gap:14px;
}
.search-container,
.category-select-wrapper{
    background:#fff;
    border:1px solid var(--ss-border);
    box-shadow:0 7px 22px rgba(76,28,54,.05);
    transition:border-color .2s ease,box-shadow .2s ease;
}
.search-container:focus-within,
.category-select-wrapper:focus-within{
    border-color:rgba(233,30,99,.48);
    box-shadow:0 0 0 4px rgba(233,30,99,.08);
}
.search-container input{
    font-size:.96rem;
}
.categories{
    display:flex;
    flex-wrap:wrap;
    gap:9px;
    margin:20px 0 26px;
}
.category{
    border:1px solid var(--ss-border);
    background:#fff;
    color:#5f4d59;
    border-radius:999px;
    padding:10px 16px;
    font-weight:700;
    transition:all .2s ease;
}
.category:hover{
    border-color:#f2a2bf;
    color:var(--ss-pink-dark);
    transform:translateY(-1px);
}
.category.active{
    color:#fff;
    border-color:transparent;
    background:linear-gradient(135deg,var(--ss-pink),#f06292);
    box-shadow:0 7px 18px rgba(233,30,99,.20);
}
.product-grid{
    gap:22px;
}
.product-card{
    position:relative;
    overflow:hidden;
    border:1px solid var(--ss-border);
    border-radius:var(--ss-radius);
    background:#fff;
    box-shadow:0 8px 28px rgba(76,28,54,.055);
    transition:transform .25s ease,box-shadow .25s ease,border-color .25s ease;
}
.product-card:hover{
    transform:translateY(-6px);
    border-color:#f5bfd2;
    box-shadow:0 18px 42px rgba(76,28,54,.11);
}
.product-image{
    position:relative;
    background:linear-gradient(145deg,#fff6fa,#ffeef5);
}
.product-image img{
    transition:transform .35s ease;
}
.product-card:hover .product-image img{
    transform:scale(1.04);
}
.stock-badge{
    background:rgba(255,255,255,.94);
    color:var(--ss-pink-dark);
    border:1px solid rgba(233,30,99,.13);
    box-shadow:0 5px 15px rgba(76,28,54,.08);
    backdrop-filter:blur(8px);
}
.product-category{
    color:var(--ss-pink);
    font-weight:800;
    text-transform:uppercase;
    letter-spacing:.07em;
    font-size:.72rem;
}
.product-name{
    color:var(--ss-text);
    letter-spacing:-.02em;
}
.product-description{
    color:var(--ss-muted);
    line-height:1.6;
}
.product-price{
    color:var(--ss-pink-dark);
    font-size:1.2rem;
}
.view-product-button{
    border:1px solid #f2cfdd;
    background:#fff;
    color:var(--ss-pink-dark);
    font-weight:750;
    transition:all .2s ease;
}
.view-product-button:hover{
    background:var(--ss-pink-soft);
    border-color:#ef9fbc;
}
.empty-products,
.empty-cart{
    border:1px dashed #edbfd0;
    background:linear-gradient(145deg,#fff,#fff5f9);
}
.cart-overlay,
.modal-overlay{
    backdrop-filter:blur(5px);
}
.cart-drawer,
.product-modal{
    box-shadow:-20px 0 60px rgba(40,18,30,.18);
}
.cart-header{
    border-bottom:1px solid var(--ss-border);
}
.cart-label{
    color:var(--ss-pink);
    letter-spacing:.12em;
    font-weight:800;
}
.cart-total{
    border-top:1px solid var(--ss-border);
}
#cartTotal,
.modal-price{
    color:var(--ss-pink-dark);
}
.quantity-selector{
    border:1px solid var(--ss-border);
    border-radius:14px;
    overflow:hidden;
    background:#fff;
}
.quantity-selector button{
    transition:background .2s ease,color .2s ease;
}
.quantity-selector button:hover{
    background:var(--ss-pink-soft);
    color:var(--ss-pink-dark);
}
.toast{
    box-shadow:0 14px 36px rgba(40,18,30,.16);
    border:1px solid rgba(233,30,99,.12);
}

/* Mobile polish */
@media (max-width: 760px){
    .customer-header{min-height:68px}
    .profile-info{display:none}
    .customer-nav{gap:4px}
    .customer-nav .nav-link{padding-inline:8px}
    .customer-nav .nav-link.active::after{left:8px;right:8px}
    .shop-hero{border-radius:20px}
    .shop-hero h2{font-size:2.25rem}
    .categories{
        flex-wrap:nowrap;
        overflow-x:auto;
        padding-bottom:7px;
        scrollbar-width:thin;
    }
    .category{white-space:nowrap}
    .product-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
}
@media (max-width: 520px){
    .product-grid{grid-template-columns:1fr}
    .shop-toolbar{grid-template-columns:1fr}
    .shop-hero{padding:28px 22px}
}
</style>


</head>


<body>


{{-- ============================================================
     HEADER
============================================================ --}}

<header class="customer-header">


    {{-- BRAND --}}

    <a
        href="{{ route('customer.products') }}"
        class="brand"
    >

        <div class="brand-icon">

            <svg
                viewBox="0 0 24 24"
                aria-hidden="true"
            >

                <path
                    d="M8.5 3.5
                    C6.2 3.5 4.5 5.2 4.5 7.8
                    C4.5 11.2 5.8 14.3 6.4 17.4
                    C6.8 19.5 7.7 21 9 21
                    C10.3 21 10.5 18.2 12 18.2
                    C13.5 18.2 13.7 21 15 21
                    C16.3 21 17.2 19.5 17.6 17.4
                    C18.2 14.3 19.5 11.2 19.5 7.8
                    C19.5 5.2 17.8 3.5 15.5 3.5
                    C14 3.5 13 4.3 12 4.3
                    C11 4.3 10 3.5 8.5 3.5Z"
                />

            </svg>

        </div>


        <div class="brand-text">

            <h1>
                Shine & Smile
            </h1>

            <span>
                Dental Clinic
            </span>

        </div>

    </a>



    {{-- NAVIGATION --}}

    <nav class="customer-nav">

        <a
            href="{{ route('customer.products') }}"
            class="nav-link active"
        >
            Products
        </a>


        <a
            href="{{ route('customer.orders') }}"
            class="nav-link"
        >
            My Orders
        </a>

    </nav>



    {{-- HEADER ACTIONS --}}

    <div class="header-actions">


        {{-- CART --}}

        <a
            href="{{ route('customer.cart') }}"
            class="cart-button"
            aria-label="Shopping Cart"
        >

            <svg
                viewBox="0 0 24 24"
                aria-hidden="true"
            >

                <path
                    d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"
                />

                <circle
                    cx="10"
                    cy="20"
                    r="1.2"
                />

                <circle
                    cx="18"
                    cy="20"
                    r="1.2"
                />

            </svg>


            <span id="cartCount">
                0
            </span>

        </a>



        {{-- PROFILE --}}

        <div class="customer-profile-wrapper">

            <button
                type="button"
                class="customer-profile"
                id="profileDropdownButton"
                aria-expanded="false"
            >

                <div class="profile-avatar">

                    {{ strtoupper(
                        substr(
                            auth()->user()->name ?? 'C',
                            0,
                            1
                        )
                    ) }}

                </div>


                <div class="profile-info">

                    <strong>
                        {{ auth()->user()->name ?? 'Customer' }}
                    </strong>

                    <small>
                        Customer
                    </small>

                </div>


                <span class="profile-chevron">

                    <svg viewBox="0 0 24 24">

                        <path
                            d="m6 9 6 6 6-6"
                        />

                    </svg>

                </span>

            </button>



            {{-- PROFILE DROPDOWN --}}

            <div
                class="profile-dropdown"
                id="profileDropdown"
            >

                <div class="dropdown-user">

                    <div class="dropdown-avatar">

                        {{ strtoupper(
                            substr(
                                auth()->user()->name ?? 'C',
                                0,
                                1
                            )
                        ) }}

                    </div>


                    <div class="dropdown-user-info">

                        <strong>
                            {{ auth()->user()->name ?? 'Customer' }}
                        </strong>

                        <span>
                            {{ auth()->user()->email ?? '' }}
                        </span>

                    </div>

                </div>


                <div class="dropdown-divider"></div>


                <a
                    href="{{ route('customer.profile') }}"
                    class="dropdown-item"
                >

                    <span>
                        My Profile
                    </span>

                </a>


                <a
                    href="{{ route('customer.settings') }}"
                    class="dropdown-item"
                >

                    <span>
                        Settings
                    </span>

                </a>


                <div class="dropdown-divider"></div>


                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="dropdown-item logout-item"
                    >

                        <span>
                            Logout
                        </span>

                    </button>

                </form>

            </div>

        </div>

    </div>

</header>



{{-- ============================================================
     MAIN
============================================================ --}}

<main class="customer-container" id="shopTop">


    {{-- ========================================================
         HERO
    ========================================================= --}}

    <section class="shop-hero">

        <div class="hero-content">

            <span class="hero-label">
                SHINE & SMILE DENTAL CLINIC
            </span>


            <h2>
                Take care of your smile.
            </h2>


            <p>
                Browse our dental products and order
                your essentials conveniently online.
            </p>


            <button
                type="button"
                class="shop-now-button"
                id="shopNowButton"
                aria-label="Browse dental products"
            >

                <span>
                    Shop Now
                </span>

                <svg viewBox="0 0 24 24">

                    <path
                        d="M5 12h14"
                    />

                    <path
                        d="m13 6 6 6-6 6"
                    />

                </svg>

            </button>

        </div>


        <div class="hero-tooth">

            <svg
                viewBox="0 0 24 24"
                aria-hidden="true"
            >

                <path
                    d="M8.5 3.5
                    C6.2 3.5 4.5 5.2 4.5 7.8
                    C4.5 11.2 5.8 14.3 6.4 17.4
                    C6.8 19.5 7.7 21 9 21
                    C10.3 21 10.5 18.2 12 18.2
                    C13.5 18.2 13.7 21 15 21
                    C16.3 21 17.2 19.5 17.6 17.4
                    C18.2 14.3 19.5 11.2 19.5 7.8
                    C19.5 5.2 17.8 3.5 15.5 3.5
                    C14 3.5 13 4.3 12 4.3
                    C11 4.3 10 3.5 8.5 3.5Z"
                />

            </svg>

        </div>

    </section>



    {{-- ========================================================
         PRODUCTS
    ========================================================= --}}

    <section
        class="shop-section"
        id="productsSection"
    >


        <div class="section-heading">

            <div>

                <span class="section-label">
                    SHOP
                </span>

                <h2>
                    Dental Products
                </h2>

                <p>
                    Choose from our available dental products.
                </p>

            </div>


            <span id="productCount">
                {{ $products->count() }}
                {{ $products->count() === 1 ? 'product' : 'products' }}
            </span>

        </div>



        {{-- ====================================================
             SEARCH
        ===================================================== --}}

        <div class="shop-toolbar">


            <div class="search-container">

                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >

                    <circle
                        cx="11"
                        cy="11"
                        r="7"
                    />

                    <path
                        d="m20 20-4-4"
                    />

                </svg>


                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search products..."
                    autocomplete="off"
                >

            </div>



            {{-- CATEGORY SELECT --}}

            <div class="category-select-wrapper">

                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >

                    <path
                        d="M4 6h16"
                    />

                    <path
                        d="M7 12h10"
                    />

                    <path
                        d="M10 18h4"
                    />

                </svg>


                <select id="categoryFilter">

                    <option value="all">
                        All Categories
                    </option>

                    <option value="instruments">
                        Instruments
                    </option>

                    <option value="consumables">
                        Consumables
                    </option>

                    <option value="restorative">
                        Restorative
                    </option>

                    <option value="endodontics">
                        Endodontics
                    </option>

                    <option value="orthodontics">
                        Orthodontics
                    </option>

                    <option value="prosthodontics">
                        Prosthodontics
                    </option>

                    <option value="surgical">
                        Surgical
                    </option>

                    <option value="infection control">
                        Infection Control
                    </option>

                    <option value="equipment">
                        Equipment
                    </option>

                    <option value="oral care">
                        Oral Care
                    </option>

                </select>

            </div>

        </div>



        {{-- ====================================================
             CATEGORY BUTTONS
        ===================================================== --}}

        <div class="categories">

            <button
                type="button"
                class="category active"
                data-category="all"
            >
                All
            </button>


            <button
                type="button"
                class="category"
                data-category="instruments"
            >
                Instruments
            </button>


            <button
                type="button"
                class="category"
                data-category="consumables"
            >
                Consumables
            </button>


            <button
                type="button"
                class="category"
                data-category="restorative"
            >
                Restorative
            </button>


            <button
                type="button"
                class="category"
                data-category="endodontics"
            >
                Endodontics
            </button>


            <button
                type="button"
                class="category"
                data-category="orthodontics"
            >
                Orthodontics
            </button>


            <button
                type="button"
                class="category"
                data-category="prosthodontics"
            >
                Prosthodontics
            </button>


            <button
                type="button"
                class="category"
                data-category="surgical"
            >
                Surgical
            </button>


            <button
                type="button"
                class="category"
                data-category="infection control"
            >
                Infection Control
            </button>


            <button
                type="button"
                class="category"
                data-category="equipment"
            >
                Equipment
            </button>


            <button
                type="button"
                class="category"
                data-category="oral care"
            >
                Oral Care
            </button>

        </div>



        {{-- ====================================================
             PRODUCT GRID
        ===================================================== --}}

        <div
            class="product-grid"
            id="productGrid"
            aria-live="polite"
        >


            @forelse($products as $product)

                @php
                    $category = $product->category ?? 'Dental Supply';

                    $description = $product->description
                        ?? 'Quality dental product from Shine & Smile Dental Clinic.';

                    $image = $product->image ?? null;
                @endphp


                <article
                    class="product-card"
                    data-id="{{ $product->id }}"
                    data-name="{{ strtolower($product->product_name) }}"
                    data-category="{{ strtolower($category) }}"
                >


                    {{-- PRODUCT IMAGE --}}

                    <div class="product-image">

                        @if($image)

                            <img
                                src="{{ asset('storage/' . $image) }}"
                                alt="{{ $product->product_name }}"
                                loading="lazy"
                            >

                        @else

                            <div class="product-placeholder">

                                <svg
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >

                                    <path
                                        d="M8.5 3.5
                                        C6.2 3.5 4.5 5.2 4.5 7.8
                                        C4.5 11.2 5.8 14.3 6.4 17.4
                                        C6.8 19.5 7.7 21 9 21
                                        C10.3 21 10.5 18.2 12 18.2
                                        C13.5 18.2 13.7 21 15 21
                                        C16.3 21 17.2 19.5 17.6 17.4
                                        C18.2 14.3 19.5 11.2 19.5 7.8
                                        C19.5 5.2 17.8 3.5 15.5 3.5
                                        C14 3.5 13 4.3 12 4.3
                                        C11 4.3 10 3.5 8.5 3.5Z"
                                    />

                                </svg>

                            </div>

                        @endif


                        <span class="stock-badge">

                            {{ $product->quantity }}
                            in stock

                        </span>

                    </div>



                    {{-- PRODUCT INFORMATION --}}

                    <div class="product-info">


                        <span class="product-category">

                            {{ $category }}

                        </span>


                        <h3 class="product-name">

                            {{ $product->product_name }}

                        </h3>


                        <p class="product-description">

                            {{ $description }}

                        </p>


                        <div class="product-price-row">

                            <strong class="product-price">

                                ₱{{ number_format(
                                    (float) $product->selling_price,
                                    2
                                ) }}

                            </strong>

                        </div>


                        <div class="product-actions">


                            {{-- VIEW DETAILS --}}

                            <button
                                type="button"
                                class="view-product-button"
                                data-product-id="{{ $product->id }}"
                            >

                                View Details

                            </button>



                            {{-- ADD TO CART --}}

                            <button
                                type="button"
                                class="add-cart-button"
                                data-product-id="{{ $product->id }}"
                                data-product-name="{{ $product->product_name }}"
                                data-product-price="{{ $product->selling_price }}"
                                data-product-stock="{{ $product->quantity }}"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >

                                    <path
                                        d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"
                                    />

                                    <circle
                                        cx="10"
                                        cy="20"
                                        r="1.2"
                                    />

                                    <circle
                                        cx="18"
                                        cy="20"
                                        r="1.2"
                                    />

                                </svg>

                                Add to Cart

                            </button>

                        </div>

                    </div>

                </article>


            @empty


                <div class="empty-products">

                    <div class="empty-cart-icon">

                        <svg viewBox="0 0 24 24">

                            <path
                                d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"
                            />

                            <circle
                                cx="10"
                                cy="20"
                                r="1.2"
                            />

                            <circle
                                cx="18"
                                cy="20"
                                r="1.2"
                            />

                        </svg>

                    </div>


                    <strong>
                        No products available
                    </strong>


                    <p>
                        There are currently no products
                        available for ordering.
                    </p>

                </div>

            @endforelse


        </div>



        {{-- NO SEARCH RESULTS --}}

        <div
            class="no-results"
            id="noResults"
            style="display: none;"
        >

            <strong>
                No products found
            </strong>

            <p>
                Try another search term or category.
            </p>

        </div>


    </section>

</main>



{{-- ============================================================
     CART OVERLAY
============================================================ --}}

<div
    class="cart-overlay"
    id="cartOverlay"
></div>



{{-- ============================================================
     CART DRAWER
============================================================ --}}

<aside
    class="cart-drawer"
    id="cartDrawer"
>


    <div class="cart-header">

        <div>

            <span class="cart-label">
                SHOPPING CART
            </span>

            <h2>
                Your Cart
            </h2>

            <span id="cartItemsText">
                0 items
            </span>

        </div>


        <button
            type="button"
            id="closeCart"
            class="close-button"
            aria-label="Close cart"
        >

            <svg viewBox="0 0 24 24">

                <path
                    d="M6 6l12 12"
                />

                <path
                    d="M18 6 6 18"
                />

            </svg>

        </button>

    </div>



    <div
        class="cart-content"
        id="cartContent"
    >

        <div class="empty-cart">

            <div class="empty-cart-icon">

                <svg viewBox="0 0 24 24">

                    <path
                        d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"
                    />

                    <circle
                        cx="10"
                        cy="20"
                        r="1.2"
                    />

                    <circle
                        cx="18"
                        cy="20"
                        r="1.2"
                    />

                </svg>

            </div>


            <strong>
                Your cart is empty
            </strong>


            <p>
                Add some dental products to get started.
            </p>

        </div>

    </div>



    <div class="cart-footer">

        <div class="cart-total">

            <span>
                Total
            </span>


            <strong id="cartTotal">
                ₱0.00
            </strong>

        </div>


        <button
            type="button"
            class="checkout-button"
            id="checkoutButton"
            disabled
        >

            Proceed to Checkout

            <svg viewBox="0 0 24 24">

                <path
                    d="M5 12h14"
                />

                <path
                    d="m13 6 6 6-6 6"
                />

            </svg>

        </button>

    </div>

</aside>



{{-- ============================================================
     PRODUCT MODAL
============================================================ --}}

<div
    class="modal-overlay"
    id="productModal"
>

    <div class="product-modal">


        <button
            type="button"
            class="modal-close"
            id="closeProductModal"
            aria-label="Close product"
        >

            <svg viewBox="0 0 24 24">

                <path
                    d="M6 6l12 12"
                />

                <path
                    d="M18 6 6 18"
                />

            </svg>

        </button>



        <div
            class="modal-product-icon"
            id="modalProductIcon"
        >

            <svg viewBox="0 0 24 24">

                <path
                    d="M8.5 3.5
                    C6.2 3.5 4.5 5.2 4.5 7.8
                    C4.5 11.2 5.8 14.3 6.4 17.4
                    C6.8 19.5 7.7 21 9 21
                    C10.3 21 10.5 18.2 12 18.2
                    C13.5 18.2 13.7 21 15 21
                    C16.3 21 17.2 19.5 17.6 17.4
                    C18.2 14.3 19.5 11.2 19.5 7.8
                    C19.5 5.2 17.8 3.5 15.5 3.5
                    C14 3.5 13 4.3 12 4.3
                    C11 4.3 10 3.5 8.5 3.5Z"
                />

            </svg>

        </div>



        <div class="modal-product-details">


            <span
                id="modalProductCategory"
                class="modal-category"
            >
                Dental Supply
            </span>


            <h2 id="modalProductName">
                Product Name
            </h2>


            <p id="modalProductDescription">
                Product description.
            </p>


            <strong
                id="modalProductPrice"
                class="modal-price"
            >
                ₱0.00
            </strong>


            <div class="modal-stock">

                <span>
                    Stock:
                </span>

                <strong id="modalProductStock">
                    0
                </strong>

            </div>



            <div class="quantity-selector">


                <button
                    type="button"
                    id="modalMinus"
                    aria-label="Decrease quantity"
                >

                    −

                </button>


                <span id="modalQuantity">
                    1
                </span>


                <button
                    type="button"
                    id="modalPlus"
                    aria-label="Increase quantity"
                >

                    +

                </button>

            </div>



            <button
                type="button"
                class="modal-add-button"
                id="modalAddButton"
            >

                Add to Cart

            </button>

        </div>

    </div>

</div>



{{-- ============================================================
     TOAST
============================================================ --}}

<div
    class="toast"
    id="toast"
    role="status"
    aria-live="polite"
></div>



{{-- ============================================================
     JAVASCRIPT
============================================================ --}}

<script>

    window.customerCheckoutUrl =
        "{{ route('customer.checkout') }}";

    window.customerCartUrl =
        "{{ route('customer.cart') }}";

</script>


<script
    src="{{ asset('js/customer/product.js') }}"
></script>


</body>

</html>
