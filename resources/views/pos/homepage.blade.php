<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shine and Smile POS System</title>


    <script src="https://cdn.tailwindcss.com"></script>


    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/pos_homepage.css') }}">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#E91E63',
                        secondary: '#F8BBD0',
                        highlight: '#EC4899',
                        bgLight: '#FFF1F5',
                        darkBg: '#181216',
                        darkCard: '#251C22'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        };
    </script>

</head>

<body
    class="h-full bg-[#FFF1F5] dark:bg-[#181216]
           text-gray-800 dark:text-gray-100
           font-sans transition-colors duration-200
           overflow-hidden"
>

<div id="app" class="flex flex-col h-full w-full">

    <header
        class="h-16 bg-white dark:bg-[#251C22]
               border-b border-pink-100 dark:border-pink-900/30
               px-4 md:px-6
               flex items-center justify-between
               shrink-0 shadow-sm z-[100]"
    >


        <div class="flex items-center space-x-3">

            <div
                class="bg-gradient-to-tr from-primary to-highlight
                       text-white p-2.5 rounded-xl shadow-md
                       shadow-pink-500/20
                       flex items-center justify-center"
            >
                <i class="fa-solid fa-cash-register text-lg"></i>
            </div>

            <div>
                <h1
                    class="font-bold text-lg tracking-tight
                           bg-gradient-to-r from-primary to-highlight
                           bg-clip-text text-transparent"
                >
                    Shine and Smile POS
                </h1>

                <p
                    class="text-xs text-gray-400 dark:text-gray-500
                           hidden sm:block"
                >
                    Retail & Clinic Checkout Station
                </p>
            </div>

        </div>



        <div class="hidden md:flex items-center space-x-6 text-sm">

            <div
                class="flex items-center space-x-2
                       bg-pink-50 dark:bg-pink-950/40
                       px-3 py-1.5 rounded-full
                       border border-pink-100 dark:border-pink-900/30"
            >

                <span
                    class="w-2.5 h-2.5 rounded-full
                           bg-emerald-500 animate-pulse"
                ></span>

                <span
                    class="text-gray-600 dark:text-gray-300
                           font-medium text-xs"
                >
                    Register #04 - Online
                </span>

            </div>

            <div class="text-gray-500 dark:text-gray-400 text-xs">

                <i class="fa-regular fa-calendar-days mr-1 text-primary"></i>

                <span id="current-date">--</span>

                <i class="fa-regular fa-clock ml-3 mr-1 text-primary"></i>

                <span id="current-time">--:--</span>

            </div>

        </div>




        <div class="flex items-center space-x-3">



            <button
                type="button"
                onclick="toggleDarkMode()"
                class="p-2 rounded-xl
                       bg-pink-50 dark:bg-pink-950/40
                       text-primary
                       hover:bg-pink-100 dark:hover:bg-pink-900/50
                       transition"
                title="Toggle Dark/Light Mode"
            >
                <i id="theme-icon" class="fa-solid fa-moon"></i>
            </button>


            <!-- LOGGED USER -->
@auth

    <div class="relative" id="cashier-dropdown">

        <!-- Cashier Button -->
        <button
            type="button"
            id="cashier-button"
            class="flex items-center space-x-2
                   bg-pink-50 dark:bg-pink-950/40
                   px-3 py-1.5 rounded-xl
                   border border-pink-100
                   dark:border-pink-900/30
                   hover:bg-pink-100
                   dark:hover:bg-pink-900/50
                   transition"
        >

            <!-- Profile Picture -->
            <img
                src="{{ auth()->user()->profile_picture
                    ? asset('storage/' . auth()->user()->profile_picture)
                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=E91E63&color=ffffff'
                }}"
                alt="{{ auth()->user()->name }}"
                class="w-8 h-8 rounded-full object-cover"
            >

            <!-- Cashier Information -->
            <div class="text-left hidden sm:block">

                <p class="text-xs font-semibold leading-tight">
                    {{ auth()->user()->name }}
                </p>

                <p class="text-[10px] text-gray-500 dark:text-gray-400">
                    {{ auth()->user()->role ?? 'Cashier' }}
                </p>

            </div>

            <!-- Arrow -->
            <svg
                id="cashier-arrow"
                class="w-4 h-4 text-gray-500 transition-transform duration-200"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7"
                />
            </svg>

        </button>


        <!-- Cashier Dropdown -->
        <div
            id="cashier-menu"
            class="hidden absolute right-0 top-full mt-2
                   w-56
                   bg-white dark:bg-[#251C22]
                   border border-pink-100
                   dark:border-pink-900/40
                   rounded-2xl
                   shadow-2xl
                   overflow-hidden
                   z-[9999]"
        >


            <!-- Settings -->
       <!-- Settings -->
<a
    href="{{ route('pos.settings') }}"
    id="settings-option"
    class="w-full flex items-center gap-3
           px-4 py-3
           border-t border-gray-100
           dark:border-pink-900/30
           text-left
           text-gray-700 dark:text-gray-200
           hover:bg-pink-50
           dark:hover:bg-pink-950/40
           transition"
>

    <!-- Settings Icon -->
    <div
        class="w-9 h-9 rounded-xl
               bg-gray-100
               dark:bg-gray-800
               flex items-center justify-center
               flex-shrink-0"
    >

        <svg
            class="w-5 h-5 text-gray-500 dark:text-gray-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10.325 4.317
                   a1.724 1.724 0 013.35 0
                   1.724 1.724 0 002.573 1.066
                   1.724 1.724 0 012.37 2.37
                   1.724 1.724 0 001.065 2.573
                   1.724 1.724 0 010 3.35
                   1.724 1.724 0 00-1.066 2.573
                   1.724 1.724 0 01-2.37 2.37
                   1.724 1.724 0 00-2.573 1.065
                   1.724 1.724 0 01-3.35 0
                   1.724 1.724 0 00-2.573-1.066
                   1.724 1.724 1.724 0 01-2.37-2.37
                   1.724 1.724 1.724 0 00-1.065-2.573
                   1.724 1.724 1.724 0 010-3.35
                   1.724 1.724 1.724 0 001.066-2.573
                   1.724 1.724 1.724 0 012.37-2.37
                   1.724 1.724 1.724 0 002.573-1.065z"
            />

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 12a3 3 0 11-6 0
                   3 3 0 016 0z"
            />
        </svg>

    </div>


    <!-- Text -->
    <div>

        <p class="text-sm font-semibold">
            Settings
        </p>

        <p class="text-[11px] text-gray-400">
            POS settings
        </p>

    </div>

</a>

        </div>

    </div>

@endauth


            <!-- LOGOUT -->

            @auth

                <button
                    type="button"
                    onclick="openLogoutModal()"
                    class="p-2.5 rounded-xl
                           bg-red-50 dark:bg-red-950/30
                           text-red-500
                           hover:bg-red-100
                           dark:hover:bg-red-900/50
                           transition text-sm"
                    title="Logout"
                >
                    <i class="fa-solid fa-power-off"></i>
                </button>

            @endauth

        </div>

    </header>


    <!-- =========================================================
         MAIN WORKSPACE
    ========================================================== -->

    <div class="flex-1 flex flex-col lg:flex-row overflow-hidden">


        <!-- LEFT SIDE -->

        <main
            class="flex-1 flex flex-col h-full
                   bg-[#FFF1F5]/60 dark:bg-[#181216]
                   p-3 md:p-5 overflow-hidden"
        >

            <!-- SEARCH -->

            <div class="flex flex-col sm:flex-row gap-3 mb-4 shrink-0">

                <div class="relative flex-1">

                    <span
                        class="absolute inset-y-0 left-0
                               flex items-center pl-3.5
                               pointer-events-none text-primary"
                    >
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>

                    <input
                        type="text"
                        id="search-input"
                        placeholder="Search products by name or SKU..."
                        autocomplete="off"
                        class="w-full pl-10 pr-4 py-2.5
                               bg-white dark:bg-[#251C22]
                               border border-pink-200
                               dark:border-pink-900/40
                               rounded-2xl text-sm
                               focus:outline-none
                               focus:ring-2 focus:ring-primary
                               shadow-sm transition"
                    >

                </div>


                <!-- BARCODE -->

                <div class="relative sm:w-72">

                    <span
                        class="absolute inset-y-0 left-0
                               flex items-center pl-3.5
                               pointer-events-none text-primary"
                    >
                        <i class="fa-solid fa-barcode"></i>
                    </span>

                    <input
                        type="text"
                        id="barcode-input"
                        placeholder="Scan barcode..."
                        autocomplete="off"
                        class="w-full pl-10 pr-4 py-2.5
                               bg-white dark:bg-[#251C22]
                               border border-pink-200
                               dark:border-pink-900/40
                               rounded-2xl text-sm
                               focus:outline-none
                               focus:ring-2 focus:ring-primary
                               shadow-sm transition"
                    >

                </div>

            </div>


            <!-- CATEGORY -->

            <div
                id="category-tabs"
                class="flex items-center space-x-2
                       overflow-x-auto pb-2 mb-3
                       shrink-0 no-scrollbar"
            >

                <button
                    type="button"
                    data-category="All"
                    class="category-btn active-category
                           px-4 py-2 rounded-xl
                           text-xs font-semibold
                           whitespace-nowrap
                           bg-primary text-white
                           shadow-md shadow-pink-500/20
                           transition"
                >
                    <i class="fa-solid fa-border-all mr-1.5"></i>
                    All Items
                </button>


                <button
                    type="button"
                    data-category="Instruments"
                    class="category-btn"
                >
                    <i class="fa-solid fa-screwdriver-wrench mr-1.5"></i>
                    Instruments
                </button>


                <button
                    type="button"
                    data-category="Consumables"
                    class="category-btn"
                >
                    <i class="fa-solid fa-box-open mr-1.5"></i>
                    Consumables
                </button>


                <button
                    type="button"
                    data-category="Restorative"
                    class="category-btn"
                >
                    <i class="fa-solid fa-tooth mr-1.5"></i>
                    Restorative
                </button>


                <button
                    type="button"
                    data-category="Endodontics"
                    class="category-btn"
                >
                    <i class="fa-solid fa-teeth mr-1.5"></i>
                    Endodontics
                </button>


                <button
                    type="button"
                    data-category="Orthodontics"
                    class="category-btn"
                >
                    <i class="fa-solid fa-teeth mr-1.5"></i>
                    Orthodontics
                </button>


                <button
                    type="button"
                    data-category="Prosthodontics"
                    class="category-btn"
                >
                    <i class="fa-solid fa-tooth mr-1.5"></i>
                    Prosthodontics
                </button>


                <button
                    type="button"
                    data-category="Surgical"
                    class="category-btn"
                >
                    <i class="fa-solid fa-user-doctor mr-1.5"></i>
                    Surgical
                </button>


                <button
                    type="button"
                    data-category="Infection Control"
                    class="category-btn"
                >
                    <i class="fa-solid fa-shield-virus mr-1.5"></i>
                    Infection Control
                </button>


                <button
                    type="button"
                    data-category="Equipment"
                    class="category-btn"
                >
                    <i class="fa-solid fa-microscope mr-1.5"></i>
                    Equipment
                </button>


                <button
                    type="button"
                    data-category="Oral Care"
                    class="category-btn"
                >
                    <i class="fa-solid fa-toothbrush mr-1.5"></i>
                    Oral Care
                </button>

            </div>


            <!-- PRODUCT GRID -->

            <div class="flex-1 overflow-y-auto pr-1">

                <div
                    id="product-grid"
                    class="grid grid-cols-2 sm:grid-cols-3
                           xl:grid-cols-4
                           gap-3.5 pb-6"
                >
                    <!-- Products loaded by pos_homepage.js -->
                </div>

            </div>

        </main>


        <!-- =====================================================
             RIGHT SIDE - CART
        ====================================================== -->

        <aside
            class="w-full lg:w-[420px]
                   bg-white dark:bg-[#251C22]
                   border-t lg:border-t-0 lg:border-l
                   border-pink-100 dark:border-pink-900/30
                   flex flex-col h-full
                   shadow-lg z-20"
        >

            <!-- CART HEADER -->

            <div
                class="p-4 border-b border-pink-100
                       dark:border-pink-900/30
                       flex items-center
                       justify-between shrink-0"
            >

                <div class="flex items-center space-x-2">

                    <div
                        class="bg-pink-100
                               dark:bg-pink-950/60
                               text-primary p-2 rounded-xl"
                    >
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>

                    <div>

                        <h2 class="font-bold text-sm">
                            Current Order
                        </h2>

                        <p
                            class="text-[11px] text-gray-400"
                            id="cart-item-count"
                        >
                            0 items selected
                        </p>

                    </div>

                </div>


                <div class="flex items-center space-x-2">

                    <button
                        type="button"
                        id="hold-order-btn"
                        class="px-2.5 py-1.5 rounded-xl
                               bg-amber-50
                               dark:bg-amber-950/30
                               text-amber-600
                               text-xs font-semibold
                               hover:bg-amber-100 transition"
                    >
                        <i class="fa-solid fa-pause mr-1"></i>
                        Hold
                    </button>

                    <button
                        type="button"
                        id="clear-cart-btn"
                        class="px-2.5 py-1.5 rounded-xl
                               bg-red-50
                               dark:bg-red-950/30
                               text-red-500
                               text-xs font-semibold
                               hover:bg-red-100 transition"
                    >
                        <i class="fa-solid fa-trash-can mr-1"></i>
                        Clear
                    </button>

                </div>

            </div>


            <!-- CART ITEMS -->

            <div
                id="cart-items-container"
                class="flex-1 overflow-y-auto p-4 space-y-3"
            >
                <!-- Cart items generated by JS -->
            </div>


            <!-- DISCOUNT -->

            <div
                class="px-4 py-2.5
                       bg-pink-50/50
                       dark:bg-pink-950/20
                       border-t border-pink-100
                       dark:border-pink-900/30
                       flex items-center
                       justify-between shrink-0"
            >

                <div
                    class="flex items-center space-x-2
                           text-xs font-medium
                           text-gray-600
                           dark:text-gray-300"
                >

                    <i class="fa-solid fa-tag text-primary"></i>

                    <span>Discount Coupon</span>

                </div>


                <div class="flex items-center space-x-1.5">

                    <input
                        type="text"
                        id="discount-code"
                        placeholder="PROMO"
                        autocomplete="off"
                        class="w-24 px-2.5 py-1
                               bg-white dark:bg-[#181216]
                               border border-pink-200
                               dark:border-pink-900/40
                               rounded-lg text-xs uppercase
                               focus:outline-none
                               focus:ring-1 focus:ring-primary"
                    >

                    <button
                        type="button"
                        id="apply-discount-btn"
                        class="px-3 py-1
                               bg-primary text-white
                               text-xs font-semibold
                               rounded-lg
                               hover:bg-highlight transition"
                    >
                        Apply
                    </button>

                </div>

            </div>


            <!-- TOTALS -->

            <div
                class="p-4 bg-white dark:bg-[#251C22]
                       border-t border-pink-100
                       dark:border-pink-900/30
                       shrink-0 space-y-1.5 text-xs"
            >

                <div class="flex justify-between text-gray-500 dark:text-gray-400">

                    <span>Subtotal</span>

                    <span
                        id="subtotal-amount"
                        class="font-semibold text-gray-700 dark:text-gray-200"
                    >
                        ₱0.00
                    </span>

                </div>


                <div class="flex justify-between text-gray-500 dark:text-gray-400">

                    <span>
                        Discount
                        (<span id="discount-label">0%</span>)
                    </span>

                    <span
                        id="discount-amount"
                        class="font-semibold text-emerald-600"
                    >
                        -₱0.00
                    </span>

                </div>


                <div class="flex justify-between text-gray-500 dark:text-gray-400">

                    <span>Tax (VAT 8%)</span>

                    <span
                        id="tax-amount"
                        class="font-semibold text-gray-700 dark:text-gray-200"
                    >
                        ₱0.00
                    </span>

                </div>


                <div
                    class="pt-2 border-t border-dashed
                           border-pink-200
                           dark:border-pink-900/40
                           flex items-center justify-between"
                >

                    <span
                        class="font-bold text-sm
                               text-gray-800 dark:text-gray-100"
                    >
                        Total Amount
                    </span>

                    <span
                        id="grand-total"
                        class="font-extrabold text-xl text-primary"
                    >
                        ₱0.00
                    </span>

                </div>

            </div>


            <!-- PAYMENT -->

            <div
                class="p-4 bg-pink-50/70
                       dark:bg-pink-950/30
                       border-t border-pink-100
                       dark:border-pink-900/30
                       shrink-0 space-y-3"
            >

                <p
                    class="text-xs font-semibold
                           text-gray-600
                           dark:text-gray-300"
                >
                    Select Payment Method:
                </p>


                <div class="grid grid-cols-3 gap-2">

                    <button
                        type="button"
                        data-payment="Cash"
                        class="payment-method-btn selected"
                    >
                        <i class="fa-solid fa-money-bill-wave text-base"></i>
                        <span>Cash</span>
                    </button>


                    <button
                        type="button"
                        data-payment="E-Wallet"
                        class="payment-method-btn"
                    >
                        <i class="fa-solid fa-mobile-screen-button text-base"></i>
                        <span>GCash / QR</span>
                    </button>


                    <button
                        type="button"
                        data-payment="Card"
                        class="payment-method-btn"
                    >
                        <i class="fa-solid fa-credit-card text-base"></i>
                        <span>Card</span>
                    </button>

                </div>


                <!-- CHECKOUT -->

                <button
                    type="button"
                    id="checkout-btn"
                    disabled
                    class="w-full py-3.5 px-4
                           bg-gradient-to-r
                           from-primary to-highlight
                           text-white font-bold
                           rounded-2xl
                           shadow-lg
                           shadow-pink-500/30
                           hover:opacity-95
                           disabled:opacity-50
                           disabled:cursor-not-allowed
                           transition
                           flex items-center justify-center
                           space-x-2 text-sm"
                >

                    <i class="fa-solid fa-shield-check text-base"></i>

                    <span>
                        Process Payment
                        (₱<span id="btn-total">0.00</span>)
                    </span>

                </button>

            </div>

        </aside>

    </div>

</div>


<!-- =========================================================
     CHECKOUT MODAL
========================================================= -->

<div
    id="checkout-modal"
    class="fixed inset-0 bg-black/50
           backdrop-blur-sm z-50
           flex items-center justify-center
           hidden opacity-0 transition-opacity
           duration-300 p-4"
>

    <div
        class="bg-white dark:bg-[#251C22]
               w-full max-w-md rounded-3xl
               shadow-2xl overflow-hidden
               border border-pink-100
               dark:border-pink-900/40"
    >

        <div
            class="p-5 border-b border-pink-100
                   dark:border-pink-900/30
                   flex items-center justify-between
                   bg-pink-50/50 dark:bg-pink-950/30"
        >

            <div class="flex items-center space-x-2">

                <div class="bg-primary text-white p-2 rounded-xl">
                    <i class="fa-solid fa-cash-register"></i>
                </div>

                <div>

                    <h3 class="font-bold text-base">
                        Complete Checkout
                    </h3>

                    <p class="text-xs text-gray-400">
                        Transaction #
                        <span id="modal-txn-id">000001</span>
                    </p>

                </div>

            </div>


            <button
                type="button"
                id="close-checkout-btn"
                class="w-8 h-8 rounded-full
                       bg-gray-100 dark:bg-gray-800
                       text-gray-500 hover:bg-red-50
                       hover:text-red-500
                       flex items-center justify-center"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>


        <div class="p-6 space-y-4">

            <!-- TOTAL -->

            <div
                class="bg-pink-50 dark:bg-pink-950/40
                       p-4 rounded-2xl
                       border border-pink-100
                       dark:border-pink-900/30
                       flex justify-between items-center"
            >

                <div>

                    <p class="text-xs text-gray-500">
                        Total Due
                    </p>

                    <p
                        id="modal-total"
                        class="text-2xl font-extrabold text-primary"
                    >
                        ₱0.00
                    </p>

                </div>


                <div class="text-right">

                    <p class="text-xs text-gray-500">
                        Method
                    </p>

                    <p
                        id="modal-payment-method"
                        class="text-sm font-bold"
                    >
                        Cash
                    </p>

                </div>

            </div>


            <!-- CASH -->

            <div id="cash-tendered-section" class="space-y-2">

                <label class="block text-xs font-semibold">
                    Amount Tendered:
                </label>

                <div class="relative">

                    <span
                        class="absolute inset-y-0 left-0
                               flex items-center pl-3.5
                               text-gray-400 font-bold"
                    >
                        ₱
                    </span>

                    <input
                        type="number"
                        id="cash-tendered-input"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                        class="w-full pl-8 pr-4 py-3
                               bg-white dark:bg-[#181216]
                               border border-pink-200
                               dark:border-pink-900/40
                               rounded-xl text-lg font-bold
                               focus:outline-none
                               focus:ring-2 focus:ring-primary"
                    >

                </div>


                <div class="grid grid-cols-4 gap-2">

                    <button type="button" class="quick-cash" data-amount="100">
                        ₱100
                    </button>

                    <button type="button" class="quick-cash" data-amount="200">
                        ₱200
                    </button>

                    <button type="button" class="quick-cash" data-amount="500">
                        ₱500
                    </button>

                    <button type="button" class="quick-cash" data-amount="1000">
                        ₱1000
                    </button>

                </div>


                <div class="flex justify-between pt-2">

                    <span class="text-sm">
                        Change
                    </span>

                    <span
                        id="change-amount"
                        class="text-lg font-bold text-emerald-600"
                    >
                        ₱0.00
                    </span>

                </div>

            </div>


            <!-- CONFIRM -->

            <button
                type="button"
                id="confirm-payment-btn"
                class="w-full py-3
                       bg-primary text-white
                       rounded-xl font-bold
                       hover:bg-highlight transition"
            >
                <i class="fa-solid fa-check mr-2"></i>
                Confirm Payment
            </button>

        </div>

    </div>

</div>


<!-- =========================================================
     LOGOUT MODAL
========================================================= -->

<div
    id="logout-modal"
    class="fixed inset-0 bg-black/50
           backdrop-blur-sm z-50
           hidden items-center justify-center p-4"
>

    <div
        class="bg-white dark:bg-[#251C22]
               rounded-3xl p-6 w-full max-w-sm
               shadow-2xl"
    >

        <div class="text-center">

            <div
                class="w-14 h-14 mx-auto mb-4
                       rounded-full bg-red-100
                       dark:bg-red-950/40
                       text-red-500
                       flex items-center justify-center"
            >
                <i class="fa-solid fa-power-off text-xl"></i>
            </div>

            <h3 class="font-bold text-lg">
                Logout?
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Are you sure you want to logout?
            </p>

        </div>


        <div class="grid grid-cols-2 gap-3 mt-6">

            <button
                type="button"
                id="cancel-logout-btn"
                class="py-2.5 rounded-xl
                       bg-gray-100 dark:bg-gray-800
                       font-semibold text-sm"
            >
                Cancel
            </button>


            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="w-full py-2.5 rounded-xl
                           bg-red-500 text-white
                           font-semibold text-sm
                           hover:bg-red-600"
                >
                    Logout
                </button>

            </form>

        </div>

    </div>

</div>

<script>
    window.POS_PRODUCTS = @json($products);
    window.POS_CHECKOUT_URL = "{{ route('pos.checkout') }}";
</script>

<script src="{{ asset('js/pos_homepage.js') }}"></script>

</body>
</html>
