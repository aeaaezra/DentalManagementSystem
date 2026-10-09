<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shine & Smile | Dental Supply POS</title>
        <link
        rel="stylesheet"
        href="{{ asset('css/pos/pos_homepage.css') }}"
    >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar" id="sidebar">
            <div class="brand">
                <div class="brand-mark"><i class="fa-solid fa-tooth"></i></div>
                <div>
                    <h1>Shine & Smile</h1>
                    <p>Dental Supply POS</p>
                </div>
            </div>

            <div class="brand-tagline">Today, Healthier Smiles Tomorrow</div>

            <nav class="main-nav">
                <a class="nav-item active" href="#" data-section="POS">
                    <i class="fa-solid fa-cart-shopping"></i><span>POS</span>
                </a>
                <a class="nav-item" href="#" data-section="Sales History">
                    <i class="fa-regular fa-clipboard"></i><span>Sales History</span>
                </a>
                <a class="nav-item" href="#" data-section="Products">
                    <i class="fa-solid fa-box-open"></i><span>Products</span>
                </a>
                <a class="nav-item" href="#" data-section="Inventory">
                    <i class="fa-solid fa-boxes-stacked"></i><span>Inventory</span>
                </a>
                <a class="nav-item" href="#" data-section="Customers">
                    <i class="fa-solid fa-users"></i><span>Customers</span>
                </a>
                <a class="nav-item" href="#" data-section="Reports">
                    <i class="fa-solid fa-chart-column"></i><span>Reports</span>
                </a>
                <a class="nav-item" href="#" data-section="Settings">
                    <i class="fa-solid fa-gear"></i><span>Settings</span>
                </a>
            </nav>

            <div class="sidebar-bottom">
                <div class="quality-card">
                    <div class="quality-icon"><i class="fa-solid fa-tooth"></i></div>
                    <h3>Quality Supplies<br>Brighter Smiles</h3>
                    <p>Together for a healthier<br>happier smile.</p>
                    <div class="wave wave-one"></div>
                    <div class="wave wave-two"></div>
                </div>

                <div class="support">
                    <div class="support-icon"><i class="fa-solid fa-headset"></i></div>
                    <div>
                        <strong>Need Help?</strong>
                        <p>Contact support for assistance.</p>
                    </div>
                </div>

                <button class="support-button">
                    <i class="fa-regular fa-comment"></i>
                    Contact Support
                </button>

                <div class="version">© 2026 Shine & Smile Dental Supply POS<br>v1.0.0</div>
            </div>
        </aside>

        <main class="workspace">
            <header class="topbar">
                <button class="mobile-menu" id="mobileMenu"><i class="fa-solid fa-bars"></i></button>

                <div class="search-wrap">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input id="searchInput" type="search" placeholder="Search products by name, SKU, or barcode...">
                    <button class="barcode-btn" id="barcodeBtn" title="Scan barcode">
                        <i class="fa-solid fa-barcode"></i>
                    </button>
                </div>

                <div class="top-actions">
                    <button class="icon-button" id="themeToggle" title="Toggle theme">
                        <i class="fa-regular fa-sun"></i>
                    </button>
                    <button class="icon-button dark-button" id="themeIcon" title="Dark mode">
                        <i class="fa-solid fa-moon"></i>
                    </button>
                    <button class="icon-button notification" title="Notifications">
                        <i class="fa-regular fa-bell"></i><span>3</span>
                    </button>

                    <div class="register">
                        <span>Register #04</span>
                        <strong><i class="fa-solid fa-circle"></i> Online</strong>
                    </div>

                    <div class="cashier">
                        <div class="avatar">CA</div>
                        <div>
                            <strong>Mark Andrew</strong>
                            <span>Cashier</span>
                        </div>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <section class="content">
                <div class="category-row" id="categoryRow"></div>

                <div class="filters">
                    <select id="brandFilter">
                        <option value="all">All Brands</option>
                        <option value="DentalPro">DentalPro</option>
                        <option value="MedCare">MedCare</option>
                        <option value="OralTech">OralTech</option>
                    </select>

                    <select id="sortFilter">
                        <option value="name">Sort by: Name A-Z</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="stock">Stock: High to Low</option>
                    </select>

                    <div class="view-switch">
                        <button class="active" id="gridView"><i class="fa-solid fa-grip"></i> Grid</button>
                        <button id="listView"><i class="fa-solid fa-list"></i> List</button>
                    </div>
                </div>

                <div class="product-grid" id="productGrid"></div>
            </section>
        </main>

        <aside class="order-panel">
            <div class="order-header">
                <div class="order-title">
                    <div class="order-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                    <div>
                        <h2>Current Order <span id="cartCount">0</span></h2>
                        <p id="selectedText">0 items selected</p>
                    </div>
                </div>
                <button class="clear-btn" id="clearCart"><i class="fa-regular fa-trash-can"></i> Clear All</button>
            </div>

            <div class="cart-list" id="cartList">
                <div class="empty-cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <h3>Your cart is empty</h3>
                    <p>Select a product to begin.</p>
                </div>
            </div>

            <div class="checkout-box">
                <div class="discount-row">
                    <div><i class="fa-solid fa-tag"></i></div>
                    <input id="discountCode" placeholder="Enter discount code">
                    <button id="applyDiscount">Apply</button>
                </div>

                <div class="summary">
                    <div><span>Subtotal</span><strong id="subtotal">₱0.00</strong></div>
                    <div><span>Discount (0%)</span><strong class="discount-value" id="discount">-₱0.00</strong></div>
                    <div><span>Tax (VAT 8%)</span><strong id="tax">₱0.00</strong></div>
                    <div class="total-row"><span>Total Amount</span><strong id="total">₱0.00</strong></div>
                </div>

                <div class="payment-title">Select Payment Method</div>
                <div class="payment-methods">
                    <button class="payment active" data-payment="Cash"><i class="fa-solid fa-money-bill-wave"></i> Cash</button>
                    <button class="payment" data-payment="GCash / QR"><i class="fa-solid fa-mobile-screen-button"></i> GCash / QR</button>
                    <button class="payment" data-payment="Card"><i class="fa-solid fa-credit-card"></i> Card</button>
                </div>

                <label class="amount-label">Amount Received</label>
                <div class="amount-input">
                    <span>₱</span>
                    <input id="amountReceived" type="number" min="0" step="0.01" value="0.00">
                </div>

                <div class="change-row">
                    <span>Change</span>
                    <strong id="change">₱0.00</strong>
                </div>

                <button class="process-button" id="processPayment">
                    Process Payment <span id="paymentTotal">₱0.00</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <div class="smile-message">
                <i class="fa-solid fa-tooth"></i>
                <span>A portion of every purchase<br>helps create healthier smiles!</span>
                <i class="fa-solid fa-heart"></i>
            </div>
        </aside>
    </div>

    <div class="toast" id="toast"></div>
    <div class="modal-backdrop" id="paymentModal">
        <div class="payment-modal">
            <button class="modal-close" id="closePaymentModal"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-icon"><i class="fa-solid fa-circle-check"></i></div>
            <h2>Payment Completed</h2>
            <p>Transaction processed successfully.</p>
            <div class="receipt">
                <div><span>Invoice</span><strong id="receiptInvoice">INV-000000</strong></div>
                <div><span>Total</span><strong id="receiptTotal">₱0.00</strong></div>
                <div><span>Payment</span><strong id="receiptMethod">Cash</strong></div>
                <div><span>Change</span><strong id="receiptChange">₱0.00</strong></div>
            </div>
            <button class="modal-primary" id="newSale">Start New Sale</button>
        </div>
    </div>

<script src="{{ asset('js/pos/pos_homepage.js') }}"></script>
</body>
</html>

