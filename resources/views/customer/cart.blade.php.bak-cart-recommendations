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
        Shine & Smile | Shopping Cart
    </title>


    <link
        rel="stylesheet"
        href="{{ asset('css/customer/product.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/customer/cart.css') }}"
    >

</head>


<body>


    <!-- =========================================================
         HEADER
    ========================================================== -->

    <header class="customer-header">

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


        <nav class="customer-nav">

            <a
                href="{{ route('customer.products') }}"
                class="nav-link"
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


        <div class="header-actions">

            <a
                href="{{ route('customer.cart') }}"
                class="cart-button active-cart"
            >

                🛒

                <span id="headerCartCount">
                    0
                </span>

            </a>


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
                        {{ auth()->user()->name ?? 'Customer' }}
                    </strong>

                    <small>
                        Customer
                    </small>

                </div>

            </div>

        </div>

    </header>



    <!-- =========================================================
         MAIN
    ========================================================== -->

    <main class="cart-page">


        <!-- PAGE HEADER -->

        <div class="cart-page-header">

            <div>

                <span class="cart-label">
                    YOUR SHOPPING CART
                </span>

                <h2>
                    Shopping Cart
                </h2>

                <p>
                    Review your selected dental products
                    before checkout.
                </p>

            </div>


            <a
                href="{{ route('customer.products') }}"
                class="continue-shopping"
            >
                ← Continue Shopping
            </a>

        </div>



        <!-- =====================================================
             CART LAYOUT
        ====================================================== -->

        <div class="cart-layout">


            <!-- =================================================
                 CART ITEMS
            ================================================== -->

            <section class="cart-items-section">


                <div class="cart-section-header">

                    <div>

                        <h3>
                            Your Items
                        </h3>

                        <span id="cartItemCount">
                            0 items
                        </span>

                    </div>


                    <button
                        type="button"
                        id="clearCart"
                        class="clear-cart-button"
                    >
                        Clear Cart
                    </button>

                </div>


                <div
                    id="cartItems"
                    class="cart-items"
                >

                    <!-- Javascript will insert items here -->

                </div>


                <!-- EMPTY CART -->

                <div
                    id="emptyCart"
                    class="empty-cart"
                    style="display: none;"
                >

                    <div class="empty-cart-icon">
                        🛒
                    </div>


                    <h3>
                        Your cart is empty
                    </h3>


                    <p>
                        You haven't added any dental products yet.
                    </p>


                    <a
                        href="{{ route('customer.products') }}"
                        class="browse-products-button"
                    >
                        Browse Products
                    </a>

                </div>

            </section>



            <!-- =================================================
                 ORDER SUMMARY
            ================================================== -->

            <aside class="order-summary">


                <div class="summary-header">

                    <h3>
                        Order Summary
                    </h3>

                </div>


                <div class="summary-body">


                    <div class="summary-row">

                        <span>
                            Subtotal
                        </span>

                        <strong id="subtotal">
                            ₱0.00
                        </strong>

                    </div>


                    <div class="summary-row">

                        <span>
                            Delivery
                        </span>

                        <strong id="delivery">
                            ₱0.00
                        </strong>

                    </div>


                    <div class="summary-divider"></div>


                    <div class="summary-row total-row">

                        <span>
                            Total
                        </span>

                        <strong id="total">
                            ₱0.00
                        </strong>

                    </div>


                    <!-- DELIVERY -->

                    <div class="delivery-box">

                        <div class="delivery-icon">
                            🚚
                        </div>

                        <div>

                            <strong>
                                Delivery Information
                            </strong>

                            <p>
                                Delivery fee will be calculated
                                during checkout.
                            </p>

                        </div>

                    </div>


                    <button
                        type="button"
                        id="checkoutButton"
                        class="checkout-button"
                        disabled
                    >
                        Proceed to Checkout
                    </button>


                    <a
                        href="{{ route('customer.products') }}"
                        class="continue-link"
                    >
                        Continue Shopping
                    </a>

                </div>

            </aside>

        </div>

    </main>



    <!-- =========================================================
         TOAST
    ========================================================== -->

    <div
        id="toast"
        class="toast"
    ></div>


    <script src="{{ asset('js/customer/cart.js') }}"></script>

</body>

</html>
