<!DOCTYPE html>
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
        Shine & Smile | My Orders
    </title>


    {{-- =========================================================
         PRODUCT CSS
    ========================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/customer/product.css') }}"
    >


    {{-- =========================================================
         ORDERS CSS
    ========================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/customer/orders.css') }}"
    >

</head>


<body>


    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <header class="customer-header">


        {{-- BRAND --}}

        <div class="brand">

            <div class="brand-icon">
                🦷
            </div>


            <div>

                <h1>
                    Shine & Smile
                </h1>

                <span>
                    Dental Clinic
                </span>

            </div>

        </div>



        {{-- NAVIGATION --}}

        <nav class="customer-nav">

            <a
                href="{{ route('customer.products') }}"
                class="nav-link"
            >
                Products
            </a>


            <a
                href="{{ route('customer.orders') }}"
                class="nav-link active"
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

                🛒

                <span id="headerCartCount">
                    0
                </span>

            </a>



            {{-- PROFILE --}}

            <div class="customer-profile">

                <div class="profile-avatar">

                    {{
                        strtoupper(
                            substr(
                                auth()->user()->name ?? 'C',
                                0,
                                1
                            )
                        )
                    }}

                </div>


                <div class="profile-info">

                    <strong>

                        {{
                            auth()->user()->name
                            ?? 'Customer'
                        }}

                    </strong>


                    <small>
                        Customer
                    </small>

                </div>

            </div>

        </div>

    </header>



    {{-- =========================================================
         MAIN
    ========================================================== --}}

    <main class="orders-page">


        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <section class="orders-heading">


            <div>

                <span class="orders-label">
                    SHINE & SMILE DENTAL CLINIC
                </span>


                <h2>
                    My Orders
                </h2>


                <p>
                    View and track your dental product orders.
                </p>

            </div>


            <a
                href="{{ route('customer.products') }}"
                class="shop-products-button"
            >
                🛍 Shop Products
            </a>

        </section>



        {{-- =====================================================
             ORDER SUMMARY CARDS
        ====================================================== --}}

        <section class="order-statistics">


            <div class="order-stat-card">

                <div class="stat-icon all">
                    📦
                </div>


                <div>

                    <span>
                        Total Orders
                    </span>

                    <strong id="totalOrders">
                        0
                    </strong>

                </div>

            </div>



            <div class="order-stat-card">

                <div class="stat-icon pending">
                    ⏳
                </div>


                <div>

                    <span>
                        Pending
                    </span>

                    <strong id="pendingOrders">
                        0
                    </strong>

                </div>

            </div>



            <div class="order-stat-card">

                <div class="stat-icon processing">
                    🔄
                </div>


                <div>

                    <span>
                        Processing
                    </span>

                    <strong id="processingOrders">
                        0
                    </strong>

                </div>

            </div>



            <div class="order-stat-card">

                <div class="stat-icon completed">
                    ✓
                </div>


                <div>

                    <span>
                        Completed
                    </span>

                    <strong id="completedOrders">
                        0
                    </strong>

                </div>

            </div>

        </section>



        {{-- =====================================================
             FILTER BAR
        ====================================================== --}}

        <section class="orders-section">


            <div class="orders-toolbar">


                <div class="order-tabs">


                    <button
                        type="button"
                        class="order-tab active"
                        data-status="all"
                    >
                        All
                    </button>


                    <button
                        type="button"
                        class="order-tab"
                        data-status="pending"
                    >
                        Pending
                    </button>


                    <button
                        type="button"
                        class="order-tab"
                        data-status="processing"
                    >
                        Processing
                    </button>


                    <button
                        type="button"
                        class="order-tab"
                        data-status="completed"
                    >
                        Completed
                    </button>


                    <button
                        type="button"
                        class="order-tab"
                        data-status="cancelled"
                    >
                        Cancelled
                    </button>

                </div>



                <div class="order-search">

                    <span>
                        🔍
                    </span>


                    <input
                        type="search"
                        id="orderSearch"
                        placeholder="Search order number..."
                    >

                </div>

            </div>



            {{-- =================================================
                 ORDERS LIST
            ================================================== --}}

            <div
                class="orders-list"
                id="ordersList"
            >

                {{-- Orders will be rendered here --}}

            </div>



            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

            <div
                class="orders-empty"
                id="ordersEmpty"
                style="display: none;"
            >

                <div class="empty-orders-icon">
                    📦
                </div>


                <h3>
                    No Orders Found
                </h3>


                <p>
                    You don't have any orders in this category.
                </p>


                <a
                    href="{{ route('customer.products') }}"
                    class="shop-products-button"
                >
                    Browse Products
                </a>

            </div>

        </section>

    </main>



    {{-- =========================================================
         ORDER DETAILS MODAL
    ========================================================== --}}

    <div
        class="order-modal-overlay"
        id="orderModal"
    >

        <div class="order-modal">


            <div class="order-modal-header">

                <div>

                    <span>
                        ORDER DETAILS
                    </span>

                    <h2 id="modalOrderNumber">
                        ORD-000000
                    </h2>

                </div>


                <button
                    type="button"
                    id="closeOrderModal"
                    class="modal-close"
                >
                    ×
                </button>

            </div>



            {{-- STATUS --}}

            <div class="modal-status-row">

                <span>
                    Order Status
                </span>


                <strong id="modalOrderStatus">
                    Pending
                </strong>

            </div>



            {{-- TRACKER --}}

            <div class="order-tracker">


                <div class="tracker-step active">

                    <div class="tracker-circle">
                        ✓
                    </div>

                    <span>
                        Ordered
                    </span>

                </div>


                <div class="tracker-line"></div>


                <div class="tracker-step">

                    <div class="tracker-circle">
                        2
                    </div>

                    <span>
                        Processing
                    </span>

                </div>


                <div class="tracker-line"></div>


                <div class="tracker-step">

                    <div class="tracker-circle">
                        3
                    </div>

                    <span>
                        Completed
                    </span>

                </div>

            </div>



            {{-- ITEMS --}}

            <div class="modal-items">

                <h3>
                    Order Items
                </h3>


                <div id="modalOrderItems">

                </div>

            </div>



            {{-- TOTAL --}}

            <div class="modal-total">

                <span>
                    Total
                </span>


                <strong id="modalOrderTotal">
                    ₱0.00
                </strong>

            </div>



            {{-- INFO --}}

            <div class="modal-information">


                <div>

                    <span>
                        Order Date
                    </span>

                    <strong id="modalOrderDate">
                        -
                    </strong>

                </div>


                <div>

                    <span>
                        Payment Method
                    </span>

                    <strong id="modalPaymentMethod">
                        -
                    </strong>

                </div>


                <div>

                    <span>
                        Delivery
                    </span>

                    <strong id="modalDelivery">
                        -
                    </strong>

                </div>

            </div>


        </div>

    </div>



    {{-- =========================================================
         TOAST
    ========================================================== --}}

    <div
        class="toast"
        id="toast"
    ></div>



    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}

    <script src="{{ asset('js/customer/orders.js') }}"></script>

</body>

</html>
