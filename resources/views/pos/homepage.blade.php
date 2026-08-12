<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shine and Smile POS System</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        }
    </script>
    <style>
        /* Custom scrollbar for sleek POS feel */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.03);
        }
        ::-webkit-scrollbar-thumb {
            background: #F8BBD0;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #E91E63;
        }
    </style>
</head>
<body class="h-full bg-[#FFF1F5] dark:bg-[#181216] text-gray-800 dark:text-gray-100 font-sans transition-colors duration-200 overflow-hidden">

    <div id="app" class="flex flex-col h-full w-full">

        <!-- TOP BAR -->
        <header class="h-16 bg-white dark:bg-[#251C22] border-b border-pink-100 dark:border-pink-900/30 px-4 md:px-6 flex items-center justify-between shrink-0 shadow-sm z-10">
            <div class="flex items-center space-x-3">
                <div class="bg-gradient-to-tr from-primary to-highlight text-white p-2.5 rounded-xl shadow-md shadow-pink-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-cash-register text-lg"></i>
                </div>
                <div>
                    <h1 class="font-bold text-lg tracking-tight bg-gradient-to-r from-primary to-highlight bg-clip-text text-transparent">Shine and Smile POS</h1>
                    <p class="text-xs text-gray-400 dark:text-gray-500 hidden sm:block">Retail & Clinic Checkout Station</p>
                </div>
            </div>

            <!-- Central Info / Status -->
            <div class="hidden md:flex items-center space-x-6 text-sm">
                <div class="flex items-center space-x-2 bg-pink-50 dark:bg-pink-950/40 px-3 py-1.5 rounded-full border border-pink-100 dark:border-pink-900/30">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-gray-600 dark:text-gray-300 font-medium text-xs">Register #04 - Online</span>
                </div>
                <div class="text-gray-500 dark:text-gray-400 text-xs">
                    <i class="fa-regular fa-calendar-days mr-1 text-primary"></i> <span id="current-date">--</span>
                    <i class="fa-regular fa-clock ml-3 mr-1 text-primary"></i> <span id="current-time">--:--</span>
                </div>
</div>
            <!-- Cashier Profile & Actions -->
            <div class="flex items-center space-x-3">
                <button onclick="toggleDarkMode()" class="p-2 rounded-xl bg-pink-50 dark:bg-pink-950/40 text-primary hover:bg-pink-100 dark:hover:bg-pink-900/50 transition" title="Toggle Dark/Light Mode">
                    <i id="theme-icon" class="fa-solid fa-moon"></i>
                </button>
                <div class="flex items-center space-x-2 bg-pink-50 dark:bg-pink-950/40 px-3 py-1.5 rounded-xl border border-pink-100 dark:border-pink-900/30">
                    <img src="https://placehold.co/32x32/E91E63/ffffff?text=JS" alt="Cashier" class="w-7 h-7 rounded-full object-cover">
                    <div class="text-left hidden sm:block">
                        <p class="text-xs font-semibold leading-tight">Jessica Smith</p>
                        <p class="text-[10px] text-gray-500 dark:text-gray-400">Senior Cashier</p>
                    </div>
                </div>


                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="p-2.5 rounded-xl bg-red-50 dark:bg-red-950/30 text-red-500 hover:bg-red-100 dark:hover:bg-red-900/50 transition text-sm"
                        title="Logout">

                        <i class="fa-solid fa-power-off"></i>
                    </button>
                </form>


            </div>
        </header>

        <!-- MAIN WORKSPACE -->
        <div class="flex-1 flex flex-col lg:flex-row overflow-hidden">

            <!-- LEFT SECTION: Product Selection & Catalog -->
            <main class="flex-1 flex flex-col h-full bg-[#FFF1F5]/60 dark:bg-[#181216] p-3 md:p-5 overflow-hidden">

                <!-- Search & Barcode Input Bar -->
                <div class="flex flex-col sm:flex-row gap-3 mb-4 shrink-0">
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" id="search-input" oninput="filterProducts()" placeholder="Search products by name or SKU..."
                            class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-[#251C22] border border-pink-200 dark:border-pink-900/40 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm transition">
                    </div>
                    <div class="relative sm:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-primary">
                            <i class="fa-solid fa-barcode"></i>
                        </span>
                        <input type="text" id="barcode-input" onkeydown="handleBarcodeScan(event)" placeholder="Scan barcode..."
                            class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-[#251C22] border border-pink-200 dark:border-pink-900/40 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm transition">
                    </div>
                </div>

                <!-- Category Filter Tabs -->
                <div class="flex items-center space-x-2 overflow-x-auto pb-2 mb-3 shrink-0 no-scrollbar" id="category-tabs">
                    <button onclick="selectCategory('All')" class="category-btn px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap bg-primary text-white shadow-md shadow-pink-500/20 transition">
                        <i class="fa-solid fa-border-all mr-1.5"></i> All Items
                    </button>
                    <button onclick="selectCategory('Skincare')" class="category-btn px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap bg-white dark:bg-[#251C22] text-gray-600 dark:text-gray-300 hover:bg-pink-100 dark:hover:bg-pink-900/40 border border-pink-100 dark:border-pink-900/30 transition">
                        <i class="fa-solid fa-spray-can-sparkles mr-1.5"></i> Skincare
                    </button>
                    <button onclick="selectCategory('Cosmetics')" class="category-btn px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap bg-white dark:bg-[#251C22] text-gray-600 dark:text-gray-300 hover:bg-pink-100 dark:hover:bg-pink-900/40 border border-pink-100 dark:border-pink-900/30 transition">
                        <i class="fa-solid fa-wand-magic-sparkles mr-1.5"></i> Cosmetics
                    </button>
                    <button onclick="selectCategory('Supplements')" class="category-btn px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap bg-white dark:bg-[#251C22] text-gray-600 dark:text-gray-300 hover:bg-pink-100 dark:hover:bg-pink-900/40 border border-pink-100 dark:border-pink-900/30 transition">
                        <i class="fa-solid fa-pills mr-1.5"></i> Supplements
                    </button>
                    <button onclick="selectCategory('Wellness')" class="category-btn px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap bg-white dark:bg-[#251C22] text-gray-600 dark:text-gray-300 hover:bg-pink-100 dark:hover:bg-pink-900/40 border border-pink-100 dark:border-pink-900/30 transition">
                        <i class="fa-solid fa-spa mr-1.5"></i> Wellness
                    </button>
                    <button onclick="selectCategory('Accessories')" class="category-btn px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap bg-white dark:bg-[#251C22] text-gray-600 dark:text-gray-300 hover:bg-pink-100 dark:hover:bg-pink-900/40 border border-pink-100 dark:border-pink-900/30 transition">
                        <i class="fa-solid fa-bag-shopping mr-1.5"></i> Accessories
                    </button>
                </div>

                <!-- Product Grid (Scrollable) -->
                <div class="flex-1 overflow-y-auto pr-1">
                    <div id="product-grid" class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-3.5 pb-6">
                        <!-- Products injected via JS -->
                    </div>
                </div>

            </main>

            <!-- RIGHT SECTION: Cart & Checkout Panel -->
            <aside class="w-full lg:w-[420px] bg-white dark:bg-[#251C22] border-t lg:border-t-0 lg:border-l border-pink-100 dark:border-pink-900/30 flex flex-col h-full shadow-lg z-20">

                <!-- Cart Header -->
                <div class="p-4 border-b border-pink-100 dark:border-pink-900/30 flex items-center justify-between shrink-0">
                    <div class="flex items-center space-x-2">
                        <div class="bg-pink-100 dark:bg-pink-950/60 text-primary p-2 rounded-xl">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <div>
                            <h2 class="font-bold text-sm">Current Order</h2>
                            <p class="text-[11px] text-gray-400" id="cart-item-count">0 items selected</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button onclick="holdOrder()" class="px-2.5 py-1.5 rounded-xl bg-amber-50 dark:bg-amber-950/30 text-amber-600 text-xs font-semibold hover:bg-amber-100 transition" title="Hold Order">
                            <i class="fa-solid fa-pause mr-1"></i> Hold
                        </button>
                        <button onclick="clearCart()" class="px-2.5 py-1.5 rounded-xl bg-red-50 dark:bg-red-950/30 text-red-500 text-xs font-semibold hover:bg-red-100 transition" title="Clear Cart">
                            <i class="fa-solid fa-trash-can mr-1"></i> Clear
                        </button>
                    </div>
                </div>

                <!-- Cart Items List (Scrollable) -->
                <div id="cart-items-container" class="flex-1 overflow-y-auto p-4 space-y-3">
                    <div class="h-full flex flex-col items-center justify-center text-center text-gray-400 py-12">
                        <div class="w-16 h-16 bg-pink-50 dark:bg-pink-950/30 rounded-full flex items-center justify-center text-primary text-2xl mb-3 shadow-inner">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                        <p class="font-medium text-sm text-gray-600 dark:text-gray-300">Cart is empty</p>
                        <p class="text-xs text-gray-400 mt-1 max-w-[200px]">Click on products or scan barcode to add items to order.</p>
                    </div>
                </div>

                <!-- Discount & Promo Row -->
                <div class="px-4 py-2.5 bg-pink-50/50 dark:bg-pink-950/20 border-t border-pink-100 dark:border-pink-900/30 flex items-center justify-between shrink-0">
                    <div class="flex items-center space-x-2 text-xs font-medium text-gray-600 dark:text-gray-300">
                        <i class="fa-solid fa-tag text-primary"></i>
                        <span>Discount Coupon</span>
                    </div>
                    <div class="flex items-center space-x-1.5">
                        <input type="text" id="discount-code" placeholder="PROMO" class="w-24 px-2.5 py-1 bg-white dark:bg-[#181216] border border-pink-200 dark:border-pink-900/40 rounded-lg text-xs uppercase focus:outline-none focus:ring-1 focus:ring-primary">
                        <button onclick="applyDiscount()" class="px-3 py-1 bg-primary text-white text-xs font-semibold rounded-lg hover:bg-highlight transition">Apply</button>
                    </div>
                </div>

                <!-- Summary Breakdown & Totals -->
                <div class="p-4 bg-white dark:bg-[#251C22] border-t border-pink-100 dark:border-pink-900/30 shrink-0 space-y-1.5 text-xs">
                    <div class="flex justify-between text-gray-500 dark:text-gray-400">
                        <span>Subtotal</span>
                        <span id="subtotal-amount" class="font-semibold text-gray-700 dark:text-gray-200">$0.00</span>
                    </div>
                    <div class="flex justify-between text-gray-500 dark:text-gray-400">
                        <span>Discount (<span id="discount-label">0%</span>)</span>
                        <span id="discount-amount" class="font-semibold text-emerald-600">-$0.00</span>
                    </div>
                    <div class="flex justify-between text-gray-500 dark:text-gray-400">
                        <span>Tax (VAT 8%)</span>
                        <span id="tax-amount" class="font-semibold text-gray-700 dark:text-gray-200">$0.00</span>
                    </div>
                    <div class="pt-2 border-t border-dashed border-pink-200 dark:border-pink-900/40 flex items-center justify-between">
                        <span class="font-bold text-sm text-gray-800 dark:text-gray-100">Total Amount</span>
                        <span id="grand-total" class="font-extrabold text-xl text-primary">$0.00</span>
                    </div>
                </div>

                <!-- Payment Method Panel & Checkout Button -->
                <div class="p-4 bg-pink-50/70 dark:bg-pink-950/30 border-t border-pink-100 dark:border-pink-900/30 shrink-0 space-y-3">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-300">Select Payment Method:</p>
                    <div class="grid grid-cols-3 gap-2">
                        <button onclick="selectPaymentMethod('Cash')" id="pm-cash" class="payment-method-btn p-2.5 rounded-xl border-2 border-primary bg-white dark:bg-[#251C22] text-primary font-semibold text-xs flex flex-col items-center justify-center space-y-1 shadow-sm transition">
                            <i class="fa-solid fa-money-bill-wave text-base"></i>
                            <span>Cash</span>
                        </button>
                        <button onclick="selectPaymentMethod('E-Wallet')" id="pm-ewallet" class="payment-method-btn p-2.5 rounded-xl border-2 border-pink-200 dark:border-pink-900/40 bg-white dark:bg-[#251C22] text-gray-600 dark:text-gray-300 font-semibold text-xs flex flex-col items-center justify-center space-y-1 hover:border-primary transition">
                            <i class="fa-solid fa-mobile-screen-button text-base"></i>
                            <span>GCash / QR</span>
                        </button>
                        <button onclick="selectPaymentMethod('Card')" id="pm-card" class="payment-method-btn p-2.5 rounded-xl border-2 border-pink-200 dark:border-pink-900/40 bg-white dark:bg-[#251C22] text-gray-600 dark:text-gray-300 font-semibold text-xs flex flex-col items-center justify-center space-y-1 hover:border-primary transition">
                            <i class="fa-solid fa-credit-card text-base"></i>
                            <span>Card</span>
                        </button>
                    </div>

                    <!-- Complete Payment Action Button -->
                    <button onclick="openCheckoutModal()" id="checkout-btn" disabled class="w-full py-3.5 px-4 bg-gradient-to-r from-primary to-highlight text-white font-bold rounded-2xl shadow-lg shadow-pink-500/30 hover:opacity-95 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center justify-center space-x-2 text-sm">
                        <i class="fa-solid fa-shield-check text-base"></i>
                        <span>Process Payment ($<span id="btn-total">0.00</span>)</span>
                    </button>
                </div>

            </aside>

        </div>

    </div>

    <!-- PAYMENT & CHECKOUT MODAL -->
    <div id="checkout-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300 p-4">
        <div class="bg-white dark:bg-[#251C22] w-full max-w-md rounded-3xl shadow-2xl overflow-hidden border border-pink-100 dark:border-pink-900/40 transform scale-95 transition-transform duration-300" id="checkout-modal-content">
            <div class="p-5 border-b border-pink-100 dark:border-pink-900/30 flex items-center justify-between bg-pink-50/50 dark:bg-pink-950/30">
                <div class="flex items-center space-x-2">
                    <div class="bg-primary text-white p-2 rounded-xl">
                        <i class="fa-solid fa-cash-register"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-base">Complete Checkout</h3>
                        <p class="text-xs text-gray-400">Transaction #TXN-<span id="modal-txn-id">84920</span></p>
                    </div>
                </div>
                <button onclick="closeCheckoutModal()" class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 hover:bg-red-50 hover:text-red-500 flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div class="bg-pink-50 dark:bg-pink-950/40 p-4 rounded-2xl border border-pink-100 dark:border-pink-900/30 flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-500">Total Due</p>
                        <p class="text-2xl font-extrabold text-primary" id="modal-total">$0.00</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">Method</p>
                        <p class="text-sm font-bold text-gray-800 dark:text-gray-200" id="modal-payment-method">Cash</p>
                    </div>
                </div>

                <!-- Cash Tendered Section (Conditional) -->
                <div id="cash-tendered-section" class="space-y-2">
                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300">Amount Tendered (Cash):</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 font-bold">$</span>
                        <input type="number" id="cash-tendered-input" oninput="calculateChange()" placeholder="0.00"
                            class="w-full pl-8 pr-4 py-3 bg-white dark:bg-[#181216] border border-pink-200 dark:border-pink-900/40 rounded-xl text-lg font-bold focus:outline-none focus:ring-2 focus:ring-primary shadow-inner">
                    </div>
                    <!-- Quick Cash Buttons -->
                    <div class="grid grid-cols-4 gap-2 pt-1">
                        <button onclick="quickCash(10)" class="py-1.5 bg-pink-50 dark:bg-pink-950/40 hover:bg-pink-100 text-xs font-semibold rounded-lg text-primary transition">$10</button>
                        <button onclick="quickCash(20)" class="py-1.5 bg-pink-50 dark:bg-pink-950/40 hover:bg-pink-100 text-xs font-semibold rounded-lg text-primary transition">$20</button>
                        <button onclick="quickCash(50)" class="py-1.5 bg-pink-50 dark:bg-pink-950/40 hover:bg-pink-100 text-xs font-semibold rounded-lg text-primary transition">$50</button>
                        <button onclick="quickCash(100)" class="py-1.5 bg-pink-50 dark:bg-pink-950/40 hover:bg-pink-100 text-xs font-semibold rounded-lg text-primary transition">$100</button>
                    </div>
                    <div class="flex justify-between items-center pt-2 px-1 text-sm font-medium">
                        <span class="text-gray-500">Change Due:</span>
                        <span id="change-due" class="font-bold text-emerald-600 text-lg">$0.00</span>
                    </div>
                </div>

                <!-- E-Wallet / Card QR Simulation -->
                <div id="digital-payment-section" class="hidden text-center py-4 space-y-3">
                    <div class="w-36 h-36 bg-white p-2 mx-auto rounded-xl border border-gray-200 shadow-sm flex items-center justify-center">
                        <div class="text-center">
                            <i class="fa-solid fa-qrcode text-6xl text-gray-800"></i>
                            <p class="text-[10px] text-gray-500 mt-1">Scan to Pay</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500">Awaiting customer device authorization...</p>
                </div>
            </div>

            <div class="p-4 bg-pink-50/50 dark:bg-pink-950/30 border-t border-pink-100 dark:border-pink-900/30 flex space-x-3">
                <button onclick="closeCheckoutModal()" class="flex-1 py-3 px-4 rounded-xl border border-gray-200 dark:border-gray-700 font-semibold text-xs hover:bg-gray-100 dark:hover:bg-gray-800 transition">Cancel</button>
                <button onclick="completeTransaction()" class="flex-1 py-3 px-4 bg-gradient-to-r from-primary to-highlight text-white font-bold rounded-xl shadow-md shadow-pink-500/20 hover:opacity-95 transition text-xs flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-check"></i>
                    <span>Confirm & Print</span>
                </button>
            </div>
        </div>
    </div>

    <!-- RECEIPT PREVIEW MODAL -->
    <div id="receipt-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300 p-4">
        <div class="bg-white dark:bg-[#251C22] w-full max-w-sm rounded-3xl shadow-2xl overflow-hidden border border-pink-100 dark:border-pink-900/40 transform scale-95 transition-transform duration-300" id="receipt-modal-content">
            <div class="p-6 space-y-4 text-center">
                <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto text-2xl shadow-inner">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div>
                    <h3 class="font-bold text-lg">Payment Successful!</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Transaction completed successfully.</p>
                </div>

                <!-- Thermal Receipt Card -->
                <div class="bg-gray-50 dark:bg-[#181216] p-4 rounded-2xl text-left font-mono text-xs border border-dashed border-gray-300 dark:border-gray-700 space-y-2">
                    <div class="text-center pb-2 border-b border-gray-200 dark:border-gray-800">
                        <p class="font-bold text-primary text-sm">PINKPOS BEAUTY & CLINIC</p>
                        <p class="text-[10px] text-gray-400">123 Blossom Avenue, Suite 4B</p>
                        <p class="text-[10px] text-gray-400">Receipt #<span id="rec-txn-id">84920</span></p>
                    </div>
                    <div id="receipt-items-list" class="space-y-1 py-2 text-[11px] border-b border-gray-200 dark:border-gray-800">
                        <!-- Receipt items injected -->
                    </div>
                    <div class="space-y-1 text-[11px] pt-1">
                        <div class="flex justify-between"><span>Subtotal:</span><span id="rec-subtotal">$0.00</span></div>
                        <div class="flex justify-between"><span>Discount:</span><span id="rec-discount">-$0.00</span></div>
                        <div class="flex justify-between"><span>Tax (8%):</span><span id="rec-tax">$0.00</span></div>
                        <div class="flex justify-between font-bold text-primary pt-1 border-t border-gray-200 dark:border-gray-800 text-xs">
                            <span>TOTAL:</span><span id="rec-total">$0.00</span>
                        </div>
                        <div class="flex justify-between pt-1"><span>Tendered:</span><span id="rec-tendered">$0.00</span></div>
                        <div class="flex justify-between font-bold text-emerald-600"><span>Change:</span><span id="rec-change">$0.00</span></div>
                    </div>
                    <div class="text-center pt-2 border-t border-gray-200 dark:border-gray-800 text-[10px] text-gray-400">
                        <p>Thank you for shopping with us!</p>
                        <p>Please come again ✨</p>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-pink-50/50 dark:bg-pink-950/30 border-t border-pink-100 dark:border-pink-900/30 flex space-x-3">
                <button onclick="printReceipt()" class="flex-1 py-2.5 px-3 rounded-xl bg-white dark:bg-[#181216] border border-gray-200 dark:border-gray-700 font-semibold text-xs hover:bg-gray-100 transition flex items-center justify-center space-x-1.5">
                    <i class="fa-solid fa-print text-primary"></i>
                    <span>Print</span>
                </button>
                <button onclick="finishAndNewSale()" class="flex-1 py-2.5 px-3 bg-gradient-to-r from-primary to-highlight text-white font-bold rounded-xl shadow-md shadow-pink-500/20 hover:opacity-95 transition text-xs flex items-center justify-center space-x-1.5">
                    <i class="fa-solid fa-rotate-right"></i>
                    <span>New Sale</span>
                </button>
            </div>
        </div>
    </div>

    <!-- LOGOUT CONFIRMATION MODAL -->
    <div id="logout-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300 p-4">
        <div class="bg-white dark:bg-[#251C22] w-full max-w-xs rounded-3xl shadow-2xl p-6 text-center space-y-4 border border-pink-100 dark:border-pink-900/40">
            <div class="w-12 h-12 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto text-xl">
                <i class="fa-solid fa-power-off"></i>
            </div>
            <div>
                <h3 class="font-bold text-base">End Shift & Logout?</h3>
                <p class="text-xs text-gray-400 mt-1">Register will be locked for the day.</p>
            </div>
            <div class="flex space-x-2 pt-2">
                <button onclick="closeLogoutModal()" class="flex-1 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 text-xs font-semibold">Cancel</button>
                <button onclick="alert('Session ended. Drawer locked securely.'); closeLogoutModal();" class="flex-1 py-2.5 rounded-xl bg-red-500 text-white text-xs font-semibold shadow-md shadow-red-500/20">Logout</button>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION CONTAINER -->
    <div id="toast-container" class="fixed bottom-6 right-6 z-50 flex flex-col space-y-2 pointer-events-none"></div>

    <script>
        // Product Database
        const products = [
            { id: 1, name: "Rose Glow Serum", category: "Skincare", price: 34.99, stock: 15, sku: "SKU-001", icon: "fa-spray-can-sparkles", color: "from-pink-400 to-rose-500" },
            { id: 2, name: "Velvet Matte Lipstick", category: "Cosmetics", price: 18.50, stock: 24, sku: "SKU-002", icon: "fa-wand-magic-sparkles", color: "from-rose-400 to-pink-600" },
            { id: 3, name: "Collagen Glow Pearls", category: "Supplements", price: 42.00, stock: 8, sku: "SKU-003", icon: "fa-pills", color: "from-pink-300 to-rose-400" },
            { id: 4, name: "Hydrating Facial Mist", category: "Skincare", price: 22.00, stock: 30, sku: "SKU-004", icon: "fa-droplet", color: "from-pink-400 to-pink-500" },
            { id: 5, name: "Sakura Body Butter", category: "Wellness", price: 26.50, stock: 12, sku: "SKU-005", icon: "fa-spa", color: "from-rose-300 to-pink-500" },
            { id: 6, name: "Pro Makeup Brush Set", category: "Accessories", price: 39.99, stock: 5, sku: "SKU-006", icon: "fa-bag-shopping", color: "from-pink-500 to-rose-600" },
            { id: 7, name: "Vitamin C Brightener", category: "Skincare", price: 29.99, stock: 19, sku: "SKU-007", icon: "fa-sun", color: "from-amber-400 to-rose-500" },
            { id: 8, name: "Blush Palette Trio", category: "Cosmetics", price: 24.00, stock: 14, sku: "SKU-008", icon: "fa-palette", color: "from-rose-400 to-pink-500" },
            { id: 9, name: "Biotin Hair Gummies", category: "Supplements", price: 19.99, stock: 22, sku: "SKU-009", icon: "fa-prescription-bottle", color: "from-pink-400 to-rose-400" },
            { id: 10, name: "Jade Face Roller", category: "Wellness", price: 15.00, stock: 40, sku: "SKU-010", icon: "fa-feather", color: "from-emerald-400 to-teal-500" },
            { id: 11, name: "Scented Soy Candle", category: "Wellness", price: 21.50, stock: 11, sku: "SKU-011", icon: "fa-fire-flame-curved", color: "from-orange-400 to-rose-500" },
            { id: 12, name: "Silk Sleep Mask", category: "Accessories", price: 14.50, stock: 28, sku: "SKU-012", icon: "fa-moon", color: "from-purple-400 to-pink-500" }
        ];

        // State variables
        let cart = [];
        let currentCategory = 'All';
        let currentPaymentMethod = 'Cash';
        let discountPercent = 0;
        let activeTxnId = 84920;

        // Initialize App on Window Load
        window.onload = function() {
            updateDateTime();
            setInterval(updateDateTime, 1000);
            renderProducts(products);
            updateCartUI();
        };

        // Real-time Clock
        function updateDateTime() {
            const now = new Date();
            const dateStr = now.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
            const timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
            document.getElementById('current-date').innerText = dateStr;
            document.getElementById('current-time').innerText = timeStr;
        }

        // Render Product Grid
        function renderProducts(itemsToRender) {
            const grid = document.getElementById('product-grid');
            grid.innerHTML = '';

            if (itemsToRender.length === 0) {
                grid.innerHTML = `
                    <div class="col-span-full py-12 text-center text-gray-400">
                        <i class="fa-solid fa-box-open text-3xl mb-2 text-primary/60"></i>
                        <p class="text-sm font-medium">No products found</p>
                    </div>
                `;
                return;
            }

            itemsToRender.forEach(product => {
                const card = document.createElement('div');
                card.className = `bg-white dark:bg-[#251C22] p-3.5 rounded-2xl border border-pink-100 dark:border-pink-900/30 shadow-sm hover:shadow-md hover:border-primary/50 cursor-pointer transition flex flex-col justify-between group relative overflow-hidden`;
                card.onclick = () => addToCart(product.id);

                card.innerHTML = `
                    <div class="absolute top-2 right-2 px-2 py-0.5 bg-pink-50 dark:bg-pink-950/60 text-primary font-bold text-[10px] rounded-lg border border-pink-100 dark:border-pink-900/30">
                        ${product.stock} left
                    </div>
                    <div class="w-full h-24 rounded-xl bg-gradient-to-tr ${product.color} flex items-center justify-center text-white text-2xl shadow-inner mb-3 group-hover:scale-105 transition duration-300">
                        <i class="fa-solid ${product.icon}"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-semibold text-primary uppercase tracking-wider">${product.category}</span>
                        <h4 class="font-bold text-xs text-gray-800 dark:text-gray-100 line-clamp-1 mt-0.5">${product.name}</h4>
                    </div>
                    <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100 dark:border-gray-800">
                        <span class="font-extrabold text-sm text-gray-900 dark:text-white">$${product.price.toFixed(2)}</span>
                        <div class="w-7 h-7 rounded-xl bg-pink-50 dark:bg-pink-950/60 text-primary group-hover:bg-primary group-hover:text-white flex items-center justify-center transition">
                            <i class="fa-solid fa-plus text-xs"></i>
                        </div>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        // Filter Products by Category
        function selectCategory(category) {
            currentCategory = category;

            // Highlight active category tab
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.className = "category-btn px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap bg-white dark:bg-[#251C22] text-gray-600 dark:text-gray-300 hover:bg-pink-100 dark:hover:bg-pink-900/40 border border-pink-100 dark:border-pink-900/30 transition";
            });
            event.currentTarget.className = "category-btn px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap bg-primary text-white shadow-md shadow-pink-500/20 transition";

            filterProducts();
        }

        // Search & Filter
        function filterProducts() {
            const query = document.getElementById('search-input').value.toLowerCase();
            const filtered = products.filter(p => {
                const matchesCategory = currentCategory === 'All' || p.category === currentCategory;
                const matchesQuery = p.name.toLowerCase().includes(query) || p.sku.toLowerCase().includes(query);
                return matchesCategory && matchesQuery;
            });
            renderProducts(filtered);
        }

        // Barcode Scanner Handler
        function handleBarcodeScan(e) {
            if (e.key === 'Enter') {
                const code = e.target.value.trim().toUpperCase();
                const product = products.find(p => p.sku === code || p.id == code);
                if (product) {
                    addToCart(product.id);
                    e.target.value = '';
                    showToast(`Scanned: ${product.name}`, 'success');
                } else {
                    showToast(`Product SKU '${code}' not found`, 'error');
                    e.target.value = '';
                }
            }
        }

        // Add to Cart
        function addToCart(productId) {
            const product = products.find(p => p.id === productId);
            if (!product) return;

            if (product.stock <= 0) {
                showToast(`${product.name} is out of stock!`, 'error');
                return;
            }

            const existingItem = cart.find(item => item.id === productId);
            if (existingItem) {
                if (existingItem.quantity < product.stock) {
                    existingItem.quantity++;
                } else {
                    showToast(`Maximum stock reached for ${product.name}`, 'error');
                    return;
                }
            } else {
                cart.push({ ...product, quantity: 1 });
            }

            updateCartUI();
            showToast(`Added ${product.name}`, 'success');
        }

        // Update Cart Quantity
        function updateQuantity(productId, change) {
            const item = cart.find(i => i.id === productId);
            const product = products.find(p => p.id === productId);
            if (!item) return;

            const newQty = item.quantity + change;
            if (newQty > 0 && newQty <= product.stock) {
                item.quantity = newQty;
            } else if (newQty <= 0) {
                cart = cart.filter(i => i.id !== productId);
            } else {
                showToast(`Cannot exceed available stock (${product.stock})`, 'error');
            }
            updateCartUI();
        }

        // Remove Cart Item
        function removeFromCart(productId) {
            cart = cart.filter(i => i.id !== productId);
            updateCartUI();
        }

        // Clear Cart
        function clearCart() {
            if (cart.length === 0) return;
            cart = [];
            discountPercent = 0;
            document.getElementById('discount-code').value = '';
            updateCartUI();
            showToast('Cart cleared', 'info');
        }

        // Hold Order
        function holdOrder() {
            if (cart.length === 0) {
                showToast('Cart is empty', 'error');
                return;
            }
            showToast('Order placed on hold successfully', 'success');
            cart = [];
            updateCartUI();
        }

        // Apply Discount Coupon
        function applyDiscount() {
            const code = document.getElementById('discount-code').value.trim().toUpperCase();
            if (code === 'PINK10') {
                discountPercent = 10;
                showToast('10% discount applied!', 'success');
            } else if (code === 'VIP20') {
                discountPercent = 20;
                showToast('20% VIP discount applied!', 'success');
            } else if (code === '') {
                discountPercent = 0;
                showToast('Discount removed', 'info');
            } else {
                showToast('Invalid promo code', 'error');
                discountPercent = 0;
            }
            updateCartUI();
        }

        // Calculate Totals & Update UI
        function calculateTotals() {
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const discountAmount = subtotal * (discountPercent / 100);
            const taxable = subtotal - discountAmount;
            const tax = taxable * 0.08;
            const grandTotal = taxable + tax;
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

            return {
                subtotal,
                discountAmount,
                tax,
                grandTotal,
                totalItems
            };
        }

        // Update Cart UI Render
        function updateCartUI() {
            const container = document.getElementById('cart-items-container');
            const totals = calculateTotals();

            document.getElementById('cart-item-count').innerText = `${totals.totalItems} items selected`;
            document.getElementById('subtotal-amount').innerText = `$${totals.subtotal.toFixed(2)}`;
            document.getElementById('discount-label').innerText = `${discountPercent}%`;
            document.getElementById('discount-amount').innerText = `-$${totals.discountAmount.toFixed(2)}`;
            document.getElementById('tax-amount').innerText = `$${totals.tax.toFixed(2)}`;
            document.getElementById('grand-total').innerText = `$${totals.grandTotal.toFixed(2)}`;
            document.getElementById('btn-total').innerText = totals.grandTotal.toFixed(2);

            const checkoutBtn = document.getElementById('checkout-btn');
            if (cart.length > 0) {
                checkoutBtn.removeAttribute('disabled');
            } else {
                checkoutBtn.setAttribute('disabled', 'true');
            }

            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="h-full flex flex-col items-center justify-center text-center text-gray-400 py-12">
                        <div class="w-16 h-16 bg-pink-50 dark:bg-pink-950/30 rounded-full flex items-center justify-center text-primary text-2xl mb-3 shadow-inner">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                        <p class="font-medium text-sm text-gray-600 dark:text-gray-300">Cart is empty</p>
                        <p class="text-xs text-gray-400 mt-1 max-w-[200px]">Click on products or scan barcode to add items to order.</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = '';
            cart.forEach(item => {
                const div = document.createElement('div');
                div.className = "flex items-center justify-between p-3 bg-pink-50/40 dark:bg-pink-950/20 rounded-2xl border border-pink-100 dark:border-pink-900/30";
                div.innerHTML = `
                    <div class="flex items-center space-x-3 flex-1 min-w-0 pr-2">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr ${item.color} flex items-center justify-center text-white shrink-0">
                            <i class="fa-solid ${item.icon} text-sm"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h5 class="font-bold text-xs text-gray-800 dark:text-gray-100 truncate">${item.name}</h5>
                            <p class="text-[11px] text-primary font-semibold">$${item.price.toFixed(2)} each</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 shrink-0">
                        <div class="flex items-center space-x-1 bg-white dark:bg-[#181216] border border-pink-200 dark:border-pink-900/40 rounded-xl px-1.5 py-1">
                            <button onclick="updateQuantity(${item.id}, -1)" class="w-6 h-6 rounded-lg hover:bg-pink-100 dark:hover:bg-pink-900/50 text-gray-600 dark:text-gray-300 flex items-center justify-center text-xs transition">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <span class="w-6 text-center font-bold text-xs">${item.quantity}</span>
                            <button onclick="updateQuantity(${item.id}, 1)" class="w-6 h-6 rounded-lg hover:bg-pink-100 dark:hover:bg-pink-900/50 text-gray-600 dark:text-gray-300 flex items-center justify-center text-xs transition">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <button onclick="removeFromCart(${item.id})" class="w-8 h-8 rounded-xl bg-red-50 dark:bg-red-950/30 text-red-500 hover:bg-red-100 flex items-center justify-center text-xs transition">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                `;
                container.appendChild(div);
            });
        }

        // Payment Method Selection
        function selectPaymentMethod(method) {
            currentPaymentMethod = method;
            document.querySelectorAll('.payment-method-btn').forEach(btn => {
                btn.className = "payment-method-btn p-2.5 rounded-xl border-2 border-pink-200 dark:border-pink-900/40 bg-white dark:bg-[#251C22] text-gray-600 dark:text-gray-300 font-semibold text-xs flex flex-col items-center justify-center space-y-1 hover:border-primary transition";
            });

            if (method === 'Cash') {
                document.getElementById('pm-cash').className = "payment-method-btn p-2.5 rounded-xl border-2 border-primary bg-white dark:bg-[#251C22] text-primary font-semibold text-xs flex flex-col items-center justify-center space-y-1 shadow-sm transition";
            } else if (method === 'E-Wallet') {
                document.getElementById('pm-ewallet').className = "payment-method-btn p-2.5 rounded-xl border-2 border-primary bg-white dark:bg-[#251C22] text-primary font-semibold text-xs flex flex-col items-center justify-center space-y-1 shadow-sm transition";
            } else if (method === 'Card') {
                document.getElementById('pm-card').className = "payment-method-btn p-2.5 rounded-xl border-2 border-primary bg-white dark:bg-[#251C22] text-primary font-semibold text-xs flex flex-col items-center justify-center space-y-1 shadow-sm transition";
            }
        }

        // Checkout Modal Functions
        function openCheckoutModal() {
            const totals = calculateTotals();
            document.getElementById('modal-total').innerText = `$${totals.grandTotal.toFixed(2)}`;
            document.getElementById('modal-payment-method').innerText = currentPaymentMethod;
            document.getElementById('modal-txn-id').innerText = activeTxnId;
            document.getElementById('cash-tendered-input').value = totals.grandTotal.toFixed(2);
            calculateChange();

            const cashSection = document.getElementById('cash-tendered-section');
            const digitalSection = document.getElementById('digital-payment-section');

            if (currentPaymentMethod === 'Cash') {
                cashSection.classList.remove('hidden');
                digitalSection.classList.add('hidden');
            } else {
                cashSection.classList.add('hidden');
                digitalSection.classList.remove('hidden');
            }

            const modal = document.getElementById('checkout-modal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                document.getElementById('checkout-modal-content').classList.remove('scale-95');
                document.getElementById('checkout-modal-content').classList.add('scale-100');
            }, 10);
        }

        function closeCheckoutModal() {
            const modal = document.getElementById('checkout-modal');
            modal.classList.add('opacity-0');
            document.getElementById('checkout-modal-content').classList.remove('scale-100');
            document.getElementById('checkout-modal-content').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function quickCash(amount) {
            document.getElementById('cash-tendered-input').value = amount.toFixed(2);
            calculateChange();
        }

        function calculateChange() {
            const totals = calculateTotals();
            const tendered = parseFloat(document.getElementById('cash-tendered-input').value) || 0;
            const change = tendered - totals.grandTotal;
            document.getElementById('change-due').innerText = `$${change >= 0 ? change.toFixed(2) : '0.00'}`;
        }

        // Complete Transaction & Open Receipt
        function completeTransaction() {
            closeCheckoutModal();

            const totals = calculateTotals();
            const tendered = currentPaymentMethod === 'Cash' ? (parseFloat(document.getElementById('cash-tendered-input').value) || totals.grandTotal) : totals.grandTotal;
            const change = tendered - totals.grandTotal;

            document.getElementById('rec-txn-id').innerText = activeTxnId;
            document.getElementById('rec-subtotal').innerText = `$${totals.subtotal.toFixed(2)}`;
            document.getElementById('rec-discount').innerText = `-$${totals.discountAmount.toFixed(2)}`;
            document.getElementById('rec-tax').innerText = `$${totals.tax.toFixed(2)}`;
            document.getElementById('rec-total').innerText = `$${totals.grandTotal.toFixed(2)}`;
            document.getElementById('rec-tendered').innerText = `$${tendered.toFixed(2)}`;
            document.getElementById('rec-change').innerText = `$${change >= 0 ? change.toFixed(2) : '0.00'}`;

            const recItems = document.getElementById('receipt-items-list');
            recItems.innerHTML = '';
            cart.forEach(item => {
                const row = document.createElement('div');
                row.className = "flex justify-between";
                row.innerHTML = `<span>${item.quantity}x ${item.name}</span><span>$${(item.price * item.quantity).toFixed(2)}</span>`;
                recItems.appendChild(row);
            });

            // Open Receipt Modal
            const receiptModal = document.getElementById('receipt-modal');
            receiptModal.classList.remove('hidden');
            setTimeout(() => {
                receiptModal.classList.remove('opacity-0');
                document.getElementById('receipt-modal-content').classList.remove('scale-95');
                document.getElementById('receipt-modal-content').classList.add('scale-100');
            }, 10);
        }

        function printReceipt() {
            showToast('Printing receipt to thermal printer...', 'success');
        }

        function finishAndNewSale() {
            const receiptModal = document.getElementById('receipt-modal');
            receiptModal.classList.add('opacity-0');
            document.getElementById('receipt-modal-content').classList.remove('scale-100');
            document.getElementById('receipt-modal-content').classList.add('scale-95');
            setTimeout(() => {
                receiptModal.classList.add('hidden');
            }, 300);

            // Reset cart and generate new txn id
            cart = [];
            discountPercent = 0;
            document.getElementById('discount-code').value = '';
            activeTxnId = Math.floor(10000 + Math.random() * 90000);
            updateCartUI();
            showToast('Ready for next transaction', 'info');
        }

        // Logout Modal
        function openLogoutModal() {
            const modal = document.getElementById('logout-modal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
            }, 10);
        }

        function closeLogoutModal() {
            const modal = document.getElementById('logout-modal');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Dark Mode Toggle
        function toggleDarkMode() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            const icon = document.getElementById('theme-icon');
            if (isDark) {
                icon.className = "fa-solid fa-sun text-amber-400";
                showToast('Dark pink mode enabled', 'info');
            } else {
                icon.className = "fa-solid fa-moon text-primary";
                showToast('Light pink mode enabled', 'info');
            }
        }

        // Toast Notification System
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            let bgClass = "bg-white dark:bg-[#251C22] border-pink-100 dark:border-pink-900/40 text-gray-800 dark:text-gray-100";
            let icon = '<i class="fa-solid fa-circle-check text-emerald-500 mr-2 text-sm"></i>';
            if (type === 'error') {
                icon = '<i class="fa-solid fa-circle-exclamation text-red-500 mr-2 text-sm"></i>';
            } else if (type === 'info') {
                icon = '<i class="fa-solid fa-circle-info text-primary mr-2 text-sm"></i>';
            }

            toast.className = `pointer-events-auto px-4 py-3 rounded-2xl shadow-xl border ${bgClass} flex items-center text-xs font-semibold transform translate-y-2 opacity-0 transition-all duration-300`;
            toast.innerHTML = `${icon}<span>${message}</span>`;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('translate-y-2', 'opacity-0');
            }, 10);

            setTimeout(() => {
                toast.classList.add('translate-y-2', 'opacity-0');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 2500);
        }
    </script>
</body>
</html>
