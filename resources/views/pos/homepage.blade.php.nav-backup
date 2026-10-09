
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Shine & Smile | Dental Supply POS</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/pos/pos_homepage.css') }}?v={{ time() }}"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
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

    {{-- POS --}}
    <a
        class="nav-item active"
        href="{{ route('pos.homepage') }}"
    >
        <i class="fa-solid fa-cart-shopping"></i>
        <span>POS</span>
    </a>

    {{-- Sales History --}}
    <a
        class="nav-item"
        href="{{ url('/admin/pos-sales') }}"
    >
        <i class="fa-regular fa-clipboard"></i>
        <span>Sales History</span>
    </a>

    {{-- Products --}}
    <a
        class="nav-item"
        href="{{ url('/admin/products') }}"
    >
        <i class="fa-solid fa-box-open"></i>
        <span>Products</span>
    </a>

    {{-- Inventory --}}
    <a
        class="nav-item"
        href="{{ url('/admin/stock-movements') }}"
    >
        <i class="fa-solid fa-boxes-stacked"></i>
        <span>Inventory</span>
    </a>

    {{-- Customers --}}
    <a
        class="nav-item"
        href="#"
        onclick="return false;"
        title="Customer management page is not available yet"
    >
        <i class="fa-solid fa-users"></i>
        <span>Customers</span>
    </a>

    {{-- Reports --}}
    <a
        class="nav-item"
        href="{{ url('/admin/reports') }}"
    >
        <i class="fa-solid fa-chart-column"></i>
        <span>Reports</span>
    </a>

    {{-- Settings --}}
    <a
        class="nav-item"
        href="{{ route('pos.settings') }}"
    >
        <i class="fa-solid fa-gear"></i>
        <span>Settings</span>
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
		<button
		    class="icon-button"
		    id="themeToggle"
		    type="button"
		    title="Dark mode"
		    aria-label="Switch to dark mode"
		>
		    <i class="fa-solid fa-moon"></i>
		</button>

<div class="notification-wrapper">

    <button
        class="icon-button notification"
        id="notificationBtn"
        type="button"
        title="Notifications"
        aria-label="Notifications"
    >
        <i class="fa-regular fa-bell"></i>
        <span id="notificationBadge">0</span>
    </button>

    <div
        class="notification-dropdown"
        id="notificationDropdown"
    >

        <div class="notification-header">

            <div>
                <strong>Notifications</strong>
                <span id="notificationUnreadText">
                    0 unread
                </span>
            </div>

            <button
                type="button"
                id="markAllNotificationsRead"
            >
                Mark all as read
            </button>

        </div>

        <div
            class="notification-list"
            id="notificationList"
        >
            <div class="notification-loading">
                Loading notifications...
            </div>
        </div>

        <div class="notification-footer">
            <button
                type="button"
                id="clearAllNotifications"
            >
                Clear all
            </button>
        </div>

    </div>

</div>
                    <div class="register">
                        <span>Register #04</span>
                        <strong><i class="fa-solid fa-circle"></i> Online</strong>
                    </div>


<div class="cashier-menu">

    <button
        type="button"
        class="cashier"
        id="cashierDropdownBtn"
        aria-label="Open cashier menu"
        aria-expanded="false"
    >

        <div class="avatar">CA</div>

        <div class="cashier-info">
            <strong>Mark Andrew</strong>
            <span>Cashier</span>
        </div>

        <i
            class="fa-solid fa-chevron-down cashier-chevron"
            id="cashierChevron"
        ></i>

    </button>

    <div
        class="cashier-dropdown"
        id="cashierDropdown"
    >

        <div class="cashier-dropdown-user">

            <div class="cashier-dropdown-avatar">
                CA
            </div>

            <div>
                <strong>Mark Andrew</strong>
                <span>Cashier</span>
            </div>

        </div>

        <div class="cashier-dropdown-divider"></div>

        <a
            href="{{ route('pos.profile') }}"
            class="cashier-dropdown-item"
        >
            <i class="fa-regular fa-user"></i>
            <span>My Profile</span>
        </a>

        <a
            href="{{ route('pos.settings') }}"
            class="cashier-dropdown-item"
        >
            <i class="fa-solid fa-gear"></i>
            <span>Settings</span>
        </a>

        <div class="cashier-dropdown-divider"></div>

        <form
            method="POST"
            action="{{ route('logout') }}"
        >
            @csrf

            <button
                type="submit"
                class="cashier-dropdown-item logout-item"
            >
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>

        </form>

    </div>

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

<div class="discount-row">

    <div class="discount-icon">
        <i class="fa-solid fa-tag"></i>
    </div>

    <input
        type="text"
        id="discountCode"
        placeholder="Enter discount code"
        autocomplete="off"
        maxlength="50"
    >

    <button
        type="button"
        id="applyDiscount"
    >
        Apply
    </button>

</div>
                <div class="summary">
                    <div><span>Subtotal</span><strong id="subtotal">₱0.00</strong></div>
                    <div><span>Discount (0%)</span><strong class="discount-value" id="discount">-₱0.00</strong></div>
		    <div><span>Tax</span><strong id="tax">₱0.00</strong></div>
                    <div class="total-row"><span>Total Amount</span><strong id="total">₱0.00</strong></div>
                </div>

                <div class="payment-title">Select Payment Method</div>
                <div class="payment-methods">
                    <button class="payment active" data-payment="cash"><i class="fa-solid fa-money-bill-wave"></i> Cash</button>
                    <button class="payment" data-payment="gcash"><i class="fa-solid fa-mobile-screen-button"></i> GCash / QR</button>
                    <button class="payment" data-payment="card"><i class="fa-solid fa-credit-card"></i> Card</button>
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
   <div class="modal-backdrop" id="paymentModal" aria-hidden="true">
    <div class="payment-modal">

        <button
            class="modal-close"
            id="closePaymentModal"
            type="button"
            aria-label="Close payment"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="modal-icon">
            <i class="fa-solid fa-credit-card"></i>
        </div>

        <h2 id="paymentModalTitle">Confirm Payment</h2>

        <p id="paymentModalMessage">
            Review the payment before completing this transaction.
        </p>

        <div class="receipt" id="paymentConfirmation">
            <div>
                <span>Invoice</span>
                <strong id="receiptInvoice">Pending</strong>
            </div>

            <div>
                <span>Total</span>
                <strong id="receiptTotal">₱0.00</strong>
            </div>

            <div>
                <span>Payment</span>
                <strong id="receiptMethod">Cash</strong>
            </div>

<div>
    <span>Amount Received</span>
    <div class="modal-amount-input">
        <span>₱</span>
        <input
            id="modalAmountReceived"
            type="number"
            min="0"
            step="0.01"
            value="0"
            placeholder="0.00"
        >
    </div>
</div>

<div>
    <span>Change</span>
    <strong id="receiptChange">₱0.00</strong>
</div>

        </div>



        <div id="paymentModalActions">

            <button
                class="modal-primary"
                id="confirmPayment"
                type="button"
            >
                <i class="fa-solid fa-check"></i>
                Confirm Payment
            </button>

        </div>

        <div
            id="receiptActions"
            style="display:none; gap:10px; margin-top:12px;"
        >
            <button
                class="modal-primary"
                id="printReceipt"
                type="button"
            >
                <i class="fa-solid fa-print"></i>
                Print Receipt
            </button>
            <button
                class="modal-primary"
                id="downloadReceipt"
                type="button"
            >
                <i class="fa-solid fa-download"></i>
                Download Receipt
            </button>
            <button
                class="modal-primary"
                id="newSale"
                type="button"
            >
                <i class="fa-solid fa-plus"></i>
                Start New Sale
            </button>
        </div>
    </div>
</div>

<!-- DISCOUNT SUCCESS MODAL -->
<div id="discountSuccessModal" class="discount-success-modal">

    <div class="discount-success-backdrop"></div>

    <div class="discount-success-card">

        <button
            type="button"
            id="closeDiscountSuccess"
            class="discount-success-close"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="discount-success-icon">
            <i class="fa-solid fa-check"></i>
        </div>

        <h3>Promo Code Applied!</h3>

        <p id="discountSuccessMessage">
            Your promo code has been successfully applied.
        </p>

        <div class="discount-success-amount">
            <span>Discount</span>
            <strong id="discountSuccessAmount">
                -₱0.00
            </strong>
        </div>

        <button
            type="button"
            id="discountSuccessOk"
            class="discount-success-ok"
        >
            OK
        </button>

    </div>

</div>
<style>
/* =========================================================
   DISCOUNT SUCCESS MODAL - INLINE
   ========================================================= */

#discountSuccessModal {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;

    width: 100vw !important;
    height: 100vh !important;

    display: none !important;

    align-items: center !important;
    justify-content: center !important;

    padding: 20px !important;
    margin: 0 !important;

    box-sizing: border-box !important;

    background: rgba(0, 0, 0, 0.55) !important;

    z-index: 999999 !important;

    overflow: hidden !important;
}

#discountSuccessModal.active {
    display: flex !important;
}

#discountSuccessModal .discount-success-backdrop {
    position: absolute !important;

    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;

    width: 100% !important;
    height: 100% !important;

    background: rgba(0, 0, 0, 0.55) !important;

    z-index: 1 !important;
}

#discountSuccessModal .discount-success-card {
    position: relative !important;

    z-index: 2 !important;

    width: 380px !important;
    max-width: calc(100vw - 40px) !important;

    margin: auto !important;
    padding: 30px 26px 26px !important;

    box-sizing: border-box !important;

    background: #ffffff !important;

    border-radius: 20px !important;

    text-align: center !important;

    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.30) !important;

    animation: discountSuccessIn 0.2s ease !important;
}

@keyframes discountSuccessIn {
    from {
        opacity: 0;
        transform: scale(0.94) translateY(10px);
    }

    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

#discountSuccessModal .discount-success-close {
    position: absolute !important;

    top: 12px !important;
    right: 12px !important;

    width: 34px !important;
    height: 34px !important;

    padding: 0 !important;
    margin: 0 !important;

    border: none !important;
    border-radius: 9px !important;

    background: #f4f4f5 !important;

    color: #71717a !important;

    cursor: pointer !important;

    display: flex !important;

    align-items: center !important;
    justify-content: center !important;
}

#discountSuccessModal .discount-success-icon {
    width: 64px !important;
    height: 64px !important;

    margin: 0 auto 17px !important;

    border-radius: 50% !important;

    display: flex !important;

    align-items: center !important;
    justify-content: center !important;

    background: #ec4899 !important;

    color: #ffffff !important;

    font-size: 27px !important;
}

#discountSuccessModal h3 {
    margin: 0 0 8px !important;

    color: #18181b !important;

    font-size: 21px !important;

    font-weight: 750 !important;
}

#discountSuccessModal p {
    margin: 0 0 20px !important;

    color: #71717a !important;

    font-size: 14px !important;

    line-height: 1.5 !important;
}

#discountSuccessModal .discount-success-amount {
    display: flex !important;

    align-items: center !important;
    justify-content: space-between !important;

    width: 100% !important;

    padding: 13px 15px !important;
    margin: 0 0 20px !important;

    box-sizing: border-box !important;

    border-radius: 11px !important;

    background: #fdf2f8 !important;

    border: 1px solid #fbcfe8 !important;
}

#discountSuccessModal .discount-success-amount span {
    color: #71717a !important;

    font-size: 13px !important;
    font-weight: 600 !important;
}

#discountSuccessModal .discount-success-amount strong {
    color: #db2777 !important;

    font-size: 17px !important;
    font-weight: 800 !important;
}

#discountSuccessModal .discount-success-ok {
    width: 100% !important;
    height: 46px !important;

    padding: 0 !important;

    border: none !important;
    border-radius: 11px !important;

    background: linear-gradient(
        135deg,
        #ec4899,
        #db2777
    ) !important;

    color: #ffffff !important;

    font-size: 14px !important;
    font-weight: 700 !important;

    cursor: pointer !important;
}
</style>
<script>
    window.posProducts = @json($posProducts);
</script>
<script src="{{ asset('js/pos/pos_homepage.js') }}?v={{ time() }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const themeToggle =
        document.getElementById("themeToggle");

    function updateThemeButton() {

        const isDark =
            document.documentElement.classList.contains(
                "dark-mode"
            );

        if (!themeToggle) {
            return;
        }

        if (isDark) {

            themeToggle.innerHTML =
                '<i class="fa-regular fa-sun"></i>';

            themeToggle.title =
                "Light mode";

            themeToggle.setAttribute(
                "aria-label",
                "Switch to light mode"
            );

        } else {

            themeToggle.innerHTML =
                '<i class="fa-solid fa-moon"></i>';

            themeToggle.title =
                "Dark mode";

            themeToggle.setAttribute(
                "aria-label",
                "Switch to dark mode"
            );
        }
    }


    function applyPOSTheme() {

        const savedTheme =
            localStorage.getItem(
                "pos-dark-mode"
            );

        if (savedTheme === "true") {

            document.documentElement.classList.add(
                "dark-mode"
            );

        } else {

            document.documentElement.classList.remove(
                "dark-mode"
            );
        }

        updateThemeButton();
    }


    function togglePOSTheme() {

        const isDark =
            document.documentElement.classList.contains(
                "dark-mode"
            );

        if (isDark) {

            document.documentElement.classList.remove(
                "dark-mode"
            );

            localStorage.setItem(
                "pos-dark-mode",
                "false"
            );

        } else {

            document.documentElement.classList.add(
                "dark-mode"
            );

            localStorage.setItem(
                "pos-dark-mode",
                "true"
            );
        }

        updateThemeButton();
    }


    applyPOSTheme();


    if (themeToggle) {

        themeToggle.addEventListener(
            "click",
            togglePOSTheme
        );

    }

});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const notificationBtn =
        document.getElementById("notificationBtn");

    const notificationDropdown =
        document.getElementById("notificationDropdown");

    const notificationList =
        document.getElementById("notificationList");

    const notificationBadge =
        document.getElementById("notificationBadge");

    const notificationUnreadText =
        document.getElementById("notificationUnreadText");

    const markAllButton =
        document.getElementById("markAllNotificationsRead");

    const clearAllButton =
        document.getElementById("clearAllNotifications");


    if (!notificationBtn) {
        return;
    }


    function getCsrfToken() {

        const token =
            document.querySelector(
                'meta[name="csrf-token"]'
            );

        return token
            ? token.getAttribute("content")
            : "";
    }


    function formatNotificationTime(dateString) {

        if (!dateString) {
            return "";
        }

        const date =
            new Date(dateString);

        if (Number.isNaN(date.getTime())) {
            return "";
        }

        const now =
            new Date();

        const seconds =
            Math.floor(
                (now - date) / 1000
            );

        if (seconds < 60) {
            return "Just now";
        }

        const minutes =
            Math.floor(
                seconds / 60
            );

        if (minutes < 60) {
            return `${minutes} minute${minutes === 1 ? "" : "s"} ago`;
        }

        const hours =
            Math.floor(
                minutes / 60
            );

        if (hours < 24) {
            return `${hours} hour${hours === 1 ? "" : "s"} ago`;
        }

        const days =
            Math.floor(
                hours / 24
            );

        return `${days} day${days === 1 ? "" : "s"} ago`;
    }


    function notificationIcon(type) {

        if (
            type &&
            type.toLowerCase().includes(
                "appointment"
            )
        ) {
            return '<i class="fa-regular fa-calendar-check"></i>';
        }

        return '<i class="fa-regular fa-bell"></i>';
    }


    function updateNotificationCount(
        count
    ) {

        const safeCount =
            Number(count) || 0;

        notificationBadge.textContent =
            safeCount > 99
                ? "99+"
                : safeCount;

        notificationUnreadText.textContent =
            `${safeCount} unread`;

        if (safeCount > 0) {

            notificationBadge.style.display =
                "flex";

        } else {

            notificationBadge.style.display =
                "none";
        }
    }


    function renderNotifications(
        notifications
    ) {

        if (
            !Array.isArray(notifications) ||
            notifications.length === 0
        ) {

            notificationList.innerHTML = `
                <div class="notification-empty">
                    <i class="fa-regular fa-bell-slash"></i>
                    <br>
                    No notifications
                </div>
            `;

            return;
        }


        notificationList.innerHTML =
            notifications.map(
                notification => {

                    const data =
                        notification.data || {};

                    const title =
                        notification.title ||
                        data.title ||
                        "Notification";

                    const message =
                        notification.message ||
                        data.message ||
                        "";

                    return `
                        <div
                            class="notification-item ${
                                notification.read
                                    ? ""
                                    : "unread"
                            }"
                            data-notification-id="${notification.id}"
                        >

                            <div class="notification-item-icon">
                                ${notificationIcon(
                                    notification.type
                                )}
                            </div>

                            <div class="notification-item-content">

                                <div class="notification-item-title">
                                    ${title}
                                </div>

                                <div class="notification-item-message">
                                    ${message}
                                </div>

                                <div class="notification-item-time">
                                    ${formatNotificationTime(
                                        notification.created_at
                                    )}
                                </div>

                            </div>

                        </div>
                    `;
                }
            ).join("");
    }


    async function loadNotifications() {

        notificationList.innerHTML = `
            <div class="notification-loading">
                Loading notifications...
            </div>
        `;

        try {

            const response =
                await fetch(
                    "{{ route('notifications.data') }}",
                    {
                        method: "GET",
                        headers: {
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        credentials: "same-origin"
                    }
                );

            if (!response.ok) {
                throw new Error(
                    `HTTP ${response.status}`
                );
            }

            const result =
                await response.json();

            if (!result.success) {
                throw new Error(
                    "Failed to load notifications."
                );
            }

            renderNotifications(
                result.notifications
            );

            updateNotificationCount(
                result.unread_count
            );

        } catch (error) {

            console.error(
                "Notification load error:",
                error
            );

            notificationList.innerHTML = `
                <div class="notification-empty">
                    Unable to load notifications.
                </div>
            `;
        }
    }


    async function markNotificationAsRead(
        notificationId,
        element
    ) {

        try {

            const response =
                await fetch(
                    `/notifications/${notificationId}/read`,
                    {
                        method: "POST",

                        headers: {
                            "Content-Type":
                                "application/json",

                            "Accept":
                                "application/json",

                            "X-CSRF-TOKEN":
                                getCsrfToken(),

                            "X-Requested-With":
                                "XMLHttpRequest"
                        },

                        credentials:
                            "same-origin"
                    }
                );

            if (!response.ok) {
                throw new Error(
                    `HTTP ${response.status}`
                );
            }

            const result =
                await response.json();

            if (!result.success) {
                throw new Error(
                    "Unable to mark notification as read."
                );
            }

            if (element) {
                element.classList.remove(
                    "unread"
                );
            }

            await loadNotifications();

        } catch (error) {

            console.error(
                "Mark notification read error:",
                error
            );
        }
    }


    notificationBtn.addEventListener(
        "click",
        function (event) {

            event.stopPropagation();

            notificationDropdown.classList.toggle(
                "active"
            );

            if (
                notificationDropdown.classList.contains(
                    "active"
                )
            ) {
                loadNotifications();
            }
        }
    );


    notificationList.addEventListener(
        "click",
        function (event) {

            const item =
                event.target.closest(
                    ".notification-item"
                );

            if (!item) {
                return;
            }

            const id =
                item.dataset.notificationId;

            if (!id) {
                return;
            }

            markNotificationAsRead(
                id,
                item
            );
        }
    );


    markAllButton.addEventListener(
        "click",
        async function () {

            try {

                const response =
                    await fetch(
                        "{{ route('notifications.readAll') }}",
                        {
                            method: "POST",

                            headers: {
                                "Content-Type":
                                    "application/json",

                                "Accept":
                                    "application/json",

                                "X-CSRF-TOKEN":
                                    getCsrfToken(),

                                "X-Requested-With":
                                    "XMLHttpRequest"
                            },

                            credentials:
                                "same-origin"
                        }
                    );

                if (!response.ok) {
                    throw new Error(
                        `HTTP ${response.status}`
                    );
                }

                await loadNotifications();

            } catch (error) {

                console.error(
                    "Mark all notifications error:",
                    error
                );
            }
        }
    );


    clearAllButton.addEventListener(
        "click",
        async function () {

            if (
                !confirm(
                    "Clear all notifications?"
                )
            ) {
                return;
            }

            try {

                const response =
                    await fetch(
                        "{{ route('notifications.clearAll') }}",
                        {
                            method: "DELETE",

                            headers: {
                                "Content-Type":
                                    "application/json",

                                "Accept":
                                    "application/json",

                                "X-CSRF-TOKEN":
                                    getCsrfToken(),

                                "X-Requested-With":
                                    "XMLHttpRequest"
                            },

                            credentials:
                                "same-origin"
                        }
                    );

                if (!response.ok) {
                    throw new Error(
                        `HTTP ${response.status}`
                    );
                }

                await loadNotifications();

            } catch (error) {

                console.error(
                    "Clear notifications error:",
                    error
                );
            }
        }
    );


    document.addEventListener(
        "click",
        function (event) {

            if (
                !event.target.closest(
                    ".notification-wrapper"
                )
            ) {

                notificationDropdown.classList.remove(
                    "active"
                );
            }
        }
    );


    loadNotifications();

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const cashierMenu =
        document.getElementById("cashierDropdownBtn");

    const cashierDropdown =
        document.getElementById("cashierDropdown");

    const cashierWrapper =
        document.querySelector(".cashier-menu");


    if (
        !cashierMenu ||
        !cashierDropdown ||
        !cashierWrapper
    ) {
        return;
    }


    cashierMenu.addEventListener(
        "click",
        function (event) {

            event.stopPropagation();

            const isOpen =
                cashierWrapper.classList.toggle("active");

            cashierMenu.setAttribute(
                "aria-expanded",
                isOpen ? "true" : "false"
            );

        }
    );


    cashierDropdown.addEventListener(
        "click",
        function (event) {

            event.stopPropagation();

        }
    );


    document.addEventListener(
        "click",
        function () {

            cashierWrapper.classList.remove(
                "active"
            );

            cashierMenu.setAttribute(
                "aria-expanded",
                "false"
            );

        }
    );


    document.addEventListener(
        "keydown",
        function (event) {

            if (event.key === "Escape") {

                cashierWrapper.classList.remove(
                    "active"
                );

                cashierMenu.setAttribute(
                    "aria-expanded",
                    "false"
                );

            }

        }
    );

});
</script>
</script>
</body>
</html></body>
</html>

