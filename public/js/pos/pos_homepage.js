document.addEventListener("DOMContentLoaded", () => {
    const products = Array.isArray(window.posProducts) ? window.posProducts.map(product => ({
        id: Number(product.id),
        name: product.name ?? "Unnamed Product",
        sku: product.sku ?? "",
        category: product.category ?? "Uncategorized",
        brand: product.brand ?? "",
        price: Number(product.price) || 0,
        stock: Number(product.stock) || 0,
        image: product.image ?? ""
    })) : [];

    let cart = [];
    let activeCategory = "All Items";
    let searchTerm = "";
 let discount = 0;
let appliedDiscount = null;
let paymentMethod = "cash";

    const productGrid = document.getElementById("productGrid");

const cartItems = document.getElementById("cartList");
const cartEmpty = document.querySelector(".empty-cart");

const searchInput = document.getElementById("searchInput");
const barcodeInput = document.getElementById("barcodeBtn");

const subtotalElement = document.getElementById("subtotal");
const discountElement = document.getElementById("discount");
const taxElement = document.getElementById("tax");
const totalElement = document.getElementById("total");

const cartCountElement = document.getElementById("cartCount");

const discountInput = document.getElementById("discountCode");
const applyDiscountButton = document.getElementById("applyDiscount");
const processPaymentButton = document.getElementById("processPayment");

const paymentModal = document.getElementById("paymentModal");

const cashReceivedInput =
    document.getElementById("amountReceived");

const changeAmountElement =
    document.getElementById("change");

const confirmPaymentButton =
    document.getElementById("confirmPayment");
const printReceiptButton =
    document.getElementById("printReceipt");

const downloadReceiptButton =
    document.getElementById("downloadReceipt");

const newSaleButton =
    document.getElementById("newSale");
const darkModeButton =
    document.getElementById("themeToggle");

const clearCartButton =
    document.getElementById("clearCart");

const categoryButtons =
    document.querySelectorAll("[data-category]");

const paymentButtons =
    document.querySelectorAll("[data-payment]");

const gridViewButton =
    document.getElementById("gridView");

const listViewButton =
    document.getElementById("listView");
    function formatCurrency(value) {
        return `₱${Number(value).toLocaleString("en-PH", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        })}`;
    }

    function getFilteredProducts() {
        return products.filter(product => {
            const matchesCategory =
                activeCategory === "All Items" ||
                product.category === activeCategory;

            const search =
                searchTerm.toLowerCase().trim();

            const matchesSearch =
                !search ||
                product.name.toLowerCase().includes(search) ||
                product.sku.toLowerCase().includes(search);

            return matchesCategory && matchesSearch;
        });
    }

    function renderProducts() {
        if (!productGrid) {
            return;
        }

        const filteredProducts = getFilteredProducts();

        productGrid.innerHTML = "";

        if (filteredProducts.length === 0) {
            productGrid.innerHTML = `
                <div class="no-products">
                    <i class="fa-solid fa-box-open"></i>
                    <h3>No products found</h3>
                    <p>Try another search or category.</p>
                </div>
            `;

            return;
        }

        filteredProducts.forEach(product => {
            const card = document.createElement("div");

            card.className = "product-card";

            const outOfStock = product.stock <= 0;

            card.innerHTML = `
                <div class="product-image">
                    <i class="fa-solid fa-tooth"></i>
                </div>

<div class="product-info">

    <span class="product-category">
        ${product.category}
    </span>

    <h3>
        ${product.name}
    </h3>

    <p class="sku">
        SKU: ${product.sku}
    </p>

    <div class="price-row">

        <strong class="price">
            ${formatCurrency(product.price)}
        </strong>

        <span class="${outOfStock ? "stock out" : "stock"}">
            ${
                outOfStock
                    ? "Out of stock"
                    : `${product.stock} pcs`
            }
        </span>

    </div>

    <button
        class="add-button"
        data-product-id="${product.id}"
        ${outOfStock ? "disabled" : ""}
    >
        <i class="fa-solid fa-cart-plus"></i>
        Add to Cart
    </button>

	 </div>
            `;

            productGrid.appendChild(card);
        });

        attachProductButtons();
    }

    function attachProductButtons() {
        const buttons =
            document.querySelectorAll(".add-button");

        buttons.forEach(button => {
            button.addEventListener("click", () => {
                const productId =
                    Number(button.dataset.productId);

                addToCart(productId);
            });
        });
    }

    function addToCart(productId) {
        const product =
            products.find(item => item.id === productId);

        if (!product || product.stock <= 0) {
            return;
        }

        const existingItem =
            cart.find(item => item.id === productId);

        if (existingItem) {
            if (existingItem.quantity < product.stock) {
                existingItem.quantity++;
            }
        } else {
            cart.push({
                id: product.id,
                name: product.name,
                sku: product.sku,
                price: product.price,
                quantity: 1
            });
        }

        renderCart();
        updateTotals();
    }

    function removeFromCart(productId) {
        cart = cart.filter(item => item.id !== productId);

        renderCart();
        updateTotals();
    }

    function changeQuantity(productId, amount) {
        const item =
            cart.find(cartItem => cartItem.id === productId);

        if (!item) {
            return;
        }

        const product =
            products.find(productItem => productItem.id === productId);

        item.quantity += amount;

        if (item.quantity <= 0) {
            removeFromCart(productId);
            return;
        }

        if (product && item.quantity > product.stock) {
            item.quantity = product.stock;
        }

        renderCart();
        updateTotals();
    }

    function renderCart() {
        if (!cartItems || !cartEmpty) {
            return;
        }

        cartItems.innerHTML = "";

        if (cart.length === 0) {
            cartEmpty.style.display = "flex";

            updateCartCount();

            return;
        }

        cartEmpty.style.display = "none";

        cart.forEach(item => {
            const cartItem =
                document.createElement("div");

            cartItem.className = "cart-item";

            cartItem.innerHTML = `
                <div class="cart-item-info">
                    <h4>
                        ${item.name}
                    </h4>

                    <span>
                        ${item.sku}
                    </span>

                    <strong>
                        ${formatCurrency(item.price)}
                    </strong>
                </div>

                <div class="cart-item-controls">
                    <button
                        class="quantity-button"
                        data-action="decrease"
                        data-id="${item.id}"
                    >
                        <i class="fa-solid fa-minus"></i>
                    </button>

                    <span class="quantity">
                        ${item.quantity}
                    </span>

                    <button
                        class="quantity-button"
                        data-action="increase"
                        data-id="${item.id}"
                    >
                        <i class="fa-solid fa-plus"></i>
                    </button>

                    <button
                        class="remove-cart-button"
                        data-action="remove"
                        data-id="${item.id}"
                    >
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>

                <div class="cart-item-total">
                    ${formatCurrency(
                        item.price * item.quantity
                    )}
                </div>
            `;

            cartItems.appendChild(cartItem);
        });

        attachCartButtons();
        updateCartCount();
    }

    function attachCartButtons() {
        const buttons =
            document.querySelectorAll(
                "[data-action]"
            );

        buttons.forEach(button => {
            button.addEventListener("click", () => {
                const productId =
                    Number(button.dataset.id);

                const action =
                    button.dataset.action;

                if (action === "increase") {
                    changeQuantity(productId, 1);
                }

                if (action === "decrease") {
                    changeQuantity(productId, -1);
                }

                if (action === "remove") {
                    removeFromCart(productId);
                }
            });
        });
    }

function updateCartCount() {
    const count = cart.reduce(
        (total, item) => total + item.quantity,
        0
    );

    if (cartCountElement) {
        cartCountElement.textContent = count;
    }

    const selectedText =
        document.getElementById("selectedText");

    if (selectedText) {
        selectedText.textContent =
            `${count} item${count === 1 ? "" : "s"} selected`;
    }
}
    function calculateSubtotal() {
        return cart.reduce(
            (total, item) =>
                total + item.price * item.quantity,
            0
        );
    }

    function calculateDiscount(subtotal) {
        return subtotal * discount;
    }

    function calculateTax(amount) {
        return amount * 0.08;
    }

    function updateTotals() {
        const subtotal =
            calculateSubtotal();

        const discountAmount =
            calculateDiscount(subtotal);

        const taxableAmount =
            Math.max(
                subtotal - discountAmount,
                0
            );

        const tax =
            calculateTax(taxableAmount);

        const total =
            taxableAmount + tax;

        if (subtotalElement) {
            subtotalElement.textContent =
                formatCurrency(subtotal);
        }

        if (discountElement) {
            discountElement.textContent =
                `-${formatCurrency(discountAmount)}`;
        }

        if (taxElement) {
            taxElement.textContent =
                formatCurrency(tax);
        }

        if (totalElement) {
            totalElement.textContent =
                formatCurrency(total);
        }

        if (processPaymentButton) {
            processPaymentButton.innerHTML = `
                <i class="fa-solid fa-credit-card"></i>
                Process Payment (${formatCurrency(total)})
            `;
        }

        calculateChange();
    }

    function applyDiscount() {
        if (!discountInput) {
            return;
        }

        const code =
            discountInput.value
                .trim()
                .toUpperCase();

        if (code === "PROMO10") {
            discount = 0.10;
        } else if (code === "PROMO20") {
            discount = 0.20;
        } else {
            discount = 0;

            if (code !== "") {
                alert(
                    "Invalid discount code."
                );
            }
        }

        updateTotals();
    }

    function openPaymentModal() {
        if (cart.length === 0) {
            alert(
                "Please add at least one product to the cart."
            );

            return;
        }

        if (!paymentModal) {
            return;
        }

       paymentModal.classList.add("show");

        paymentModal.setAttribute(
            "aria-hidden",
            "false"
        );

        if (cashReceivedInput) {
            cashReceivedInput.value = "";

            setTimeout(() => {
                cashReceivedInput.focus();
            }, 100);
        }

        calculateChange();
    }

    function closePayment() {
        if (!paymentModal) {
            return;
        }

        paymentModal.classList.remove("show");
        paymentModal.setAttribute(
            "aria-hidden",
            "true"
        );
    }

    function calculateChange() {
        const total =
            calculateTotal();

        const cash =
            Number(
                cashReceivedInput
                    ? cashReceivedInput.value
                    : 0
            );

        const change =
            Math.max(
                cash - total,
                0
            );

        if (changeAmountElement) {
            changeAmountElement.textContent =
                formatCurrency(change);
        }
    }

    function calculateTotal() {
        const subtotal =
            calculateSubtotal();

        const discountAmount =
            calculateDiscount(subtotal);

        const taxableAmount =
            Math.max(
                subtotal - discountAmount,
                0
            );

        const tax =
            calculateTax(taxableAmount);

        return taxableAmount + tax;
    }

async function confirmPayment() {
    if (cart.length === 0) {
        alert("Your cart is empty.");
        return;
    }

    const total = calculateTotal();

    const cash = Number(
        cashReceivedInput
            ? cashReceivedInput.value
            : 0
    );

    if (paymentMethod === "cash" && cash < total) {
        alert("Insufficient cash received.");
        return;
    }

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrfToken) {
        alert("Security token is missing. Please refresh the page.");
        return;
    }

    const cartPayload = cart.map(item => ({
        id: item.id,
        qty: Number(item.quantity)
    }));

    const discountCode =
        appliedDiscount?.code ||
        (
            discountInput
                ? discountInput.value.trim().toUpperCase()
                : ""
        ) ||
        null;

    const confirmButton =
        document.getElementById("confirmPayment");

    if (confirmButton) {
        confirmButton.disabled = true;
        confirmButton.innerHTML =
            '<i class="fa-solid fa-spinner fa-spin"></i> Processing...';
    }

    try {
        const response = await fetch("/pos/checkout", {
            method: "POST",

            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken,
                "X-Requested-With": "XMLHttpRequest"
            },

            body: JSON.stringify({
                cart: cartPayload,
                discount_code: discountCode,
                cash_received: cash
            })
        });

        const data = await response.json();

        if (!response.ok || !data.success) {
            throw new Error(
                data.message ||
                data.error ||
                "Payment could not be completed."
            );
        }

        /*
         * Update receipt information from the SERVER response.
         */
        const receiptInvoice =
            document.getElementById("receiptInvoice");

        const receiptTotal =
            document.getElementById("receiptTotal");

        const receiptMethod =
            document.getElementById("receiptMethod");

        const receiptAmountReceived =
            document.getElementById("receiptAmountReceived");

        const receiptChange =
            document.getElementById("receiptChange");

        if (receiptInvoice) {
            receiptInvoice.textContent =
                data.invoice_no || "N/A";
        }

        if (receiptTotal) {
            receiptTotal.textContent =
                formatCurrency(
                    Number(data.total_amount || total)
                );
        }

        if (receiptMethod) {
            receiptMethod.textContent =
                paymentMethod === "cash"
                    ? "Cash"
                    : paymentMethod;
        }

        if (receiptAmountReceived) {
            receiptAmountReceived.textContent =
                formatCurrency(
                    Number(
                        data.cash_received ||
                        cash
                    )
                );
        }

        if (receiptChange) {
            receiptChange.textContent =
                formatCurrency(
                    Number(
                        data.change_amount || 0
                    )
                );
        }

        /*
         * Show successful receipt state.
         */
        const modalTitle =
            document.getElementById("paymentModalTitle");

        const modalMessage =
            document.getElementById("paymentModalMessage");

        const paymentConfirmation =
            document.getElementById("paymentConfirmation");

        const paymentModalActions =
            document.getElementById("paymentModalActions");

        const receiptActions =
            document.getElementById("receiptActions");

        if (modalTitle) {
            modalTitle.textContent =
                "Payment Completed";
        }

        if (modalMessage) {
            modalMessage.textContent =
                "Transaction processed successfully.";
        }

        if (paymentConfirmation) {
            paymentConfirmation.style.display =
                "block";
        }

        if (paymentModalActions) {
            paymentModalActions.style.display =
                "none";
        }

        if (receiptActions) {
            receiptActions.style.display =
                "flex";
            receiptActions.style.flexDirection =
                "column";
        }

        /*
         * Update local stock only after
         * the server successfully completed
         * the transaction.
         */
        cart.forEach(item => {
            const product = posProducts.find(
                product =>
                    Number(product.id) === Number(item.id)
            );

            if (product) {
                product.stock =
                    Math.max(
                        0,
                        Number(product.stock || 0) -
                        Number(item.quantity || 0)
                    );
            }
        });

        /*
         * Keep receipt information for
         * printing/downloading.
         */
        window.lastReceipt = {
            invoice: data.invoice_no,
            total: Number(
                data.total_amount || total
            ),
            method:
                paymentMethod === "cash"
                    ? "Cash"
                    : paymentMethod,
            amountReceived: Number(
                data.cash_received || cash
            ),
            change: Number(
                data.change_amount || 0
            )
        };

    } catch (error) {

        console.error(
            "Payment error:",
            error
        );

        alert(
            error.message ||
            "Payment failed. Please try again."
        );

        if (confirmButton) {
            confirmButton.disabled = false;

            confirmButton.innerHTML =
                '<i class="fa-solid fa-check"></i> Confirm Payment';
        }
    }
}
    function clearCart() {
        if (cart.length === 0) {
            return;
        }

        if (
            confirm(
                "Are you sure you want to clear the current order?"
            )
        ) {
            cart = [];
            discount = 0;

            if (discountInput) {
                discountInput.value = "";
            }

            renderCart();
            updateTotals();
        }
    }

    function holdOrder() {
        if (cart.length === 0) {
            alert(
                "There is no order to hold."
            );

            return;
        }

        alert(
            "Current order has been placed on hold."
        );
    }

    function toggleDarkMode() {
        document.body.classList.toggle(
            "dark-mode"
        );

        const enabled =
            document.body.classList.contains(
                "dark-mode"
            );

        localStorage.setItem(
            "pos-dark-mode",
            enabled ? "true" : "false"
        );
    }

    function loadDarkMode() {
        const enabled =
            localStorage.getItem(
                "pos-dark-mode"
            ) === "true";

        if (enabled) {
            document.body.classList.add(
                "dark-mode"
            );
        }
    }

    function setupCategories() {
        categoryButtons.forEach(button => {
            button.addEventListener(
                "click",
                () => {
                    categoryButtons.forEach(
                        item => {
                            item.classList.remove(
                                "active"
                            );
                        }
                    );

                    button.classList.add(
                        "active"
                    );

                    activeCategory =
                        button.dataset.category;

                    renderProducts();
                }
            );
        });
    }

    function setupPaymentMethods() {
        paymentButtons.forEach(button => {
            button.addEventListener(
                "click",
                () => {
                    paymentButtons.forEach(
                        item => {
                            item.classList.remove(
                                "active"
                            );
                        }
                    );

                    button.classList.add(
                        "active"
                    );

                    paymentMethod =
                        button.dataset.payment;

                    const cashSection =
                        document.getElementById(
                            "cashPaymentSection"
                        );

                    if (cashSection) {
                        cashSection.style.display =
                            paymentMethod === "cash"
                                ? "block"
                                : "none";
                    }

                    calculateChange();
                }
            );
        });
    }

    function setupSearch() {
        if (searchInput) {
            searchInput.addEventListener(
                "input",
                event => {
                    searchTerm =
                        event.target.value;

                    renderProducts();
                }
            );
        }

        if (barcodeInput) {
            barcodeInput.addEventListener(
                "keydown",
                event => {
                    if (event.key !== "Enter") {
                        return;
                    }

                    const barcode =
                        barcodeInput.value.trim();

                    if (!barcode) {
                        return;
                    }

                    const product =
                        products.find(
                            item =>
                                item.sku.toLowerCase() ===
                                barcode.toLowerCase()
                        );

                    if (product) {
                        addToCart(product.id);
                    } else {
                        alert(
                            "Product not found."
                        );
                    }

                    barcodeInput.value = "";
                }
            );
        }
    }

    function setupViewButtons() {
        if (gridViewButton) {
            gridViewButton.addEventListener(
                "click",
                () => {
                    productGrid.classList.remove(
                        "list-view"
                    );

                    gridViewButton.classList.add(
                        "active"
                    );

                    if (listViewButton) {
                        listViewButton.classList.remove(
                            "active"
                        );
                    }
                }
            );
        }

        if (listViewButton) {
            listViewButton.addEventListener(
                "click",
                () => {
                    productGrid.classList.add(
                        "list-view"
                    );

                    listViewButton.classList.add(
                        "active"
                    );

                    if (gridViewButton) {
                        gridViewButton.classList.remove(
                            "active"
                        );
                    }
                }
            );
        }
    }
function printReceipt() {
    if (!window.lastReceipt) {
        alert("No completed payment is available to print.");
        return;
    }

    const receipt = window.lastReceipt;

    const receiptWindow = window.open(
        "",
        "_blank",
        "width=420,height=650"
    );

    if (!receiptWindow) {
        alert("Please allow pop-ups to print the receipt.");
        return;
    }

    receiptWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Receipt - ${receipt.invoice}</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    width: 320px;
                    margin: 30px auto;
                    color: #111;
                }

                h2 {
                    text-align: center;
                    margin-bottom: 5px;
                }

                .center {
                    text-align: center;
                }

                .line {
                    border-top: 1px dashed #777;
                    margin: 15px 0;
                }

                .row {
                    display: flex;
                    justify-content: space-between;
                    margin: 8px 0;
                }

                .total {
                    font-size: 18px;
                    font-weight: bold;
                }

                @media print {
                    body {
                        margin: 0;
                    }
                }
            </style>
        </head>

        <body>

            <h2>SHINE & SMILE</h2>

            <div class="center">
                Dental Supply POS
            </div>

            <div class="line"></div>

            <div class="row">
                <span>Invoice</span>
                <strong>${receipt.invoice}</strong>
            </div>

            <div class="row">
                <span>Payment</span>
                <strong>${receipt.method}</strong>
            </div>

            <div class="line"></div>

            <div class="row total">
                <span>Total</span>
                <span>${formatCurrency(receipt.total)}</span>
            </div>

            <div class="row">
                <span>Amount Received</span>
                <span>${formatCurrency(receipt.amountReceived)}</span>
            </div>

            <div class="row">
                <span>Change</span>
                <span>${formatCurrency(receipt.change)}</span>
            </div>

            <div class="line"></div>

            <div class="center">
                Thank you for your purchase!
            </div>

        </body>
        </html>
    `);

    receiptWindow.document.close();

    receiptWindow.focus();

    setTimeout(() => {
        receiptWindow.print();
    }, 300);
}


function downloadReceipt() {
    if (!window.lastReceipt) {
        alert("No completed payment is available to download.");
        return;
    }

    const receipt = window.lastReceipt;

    const receiptText =
`SHINE & SMILE
Dental Supply POS
--------------------------------
Invoice: ${receipt.invoice}
Payment: ${receipt.method}
--------------------------------
Total: ${formatCurrency(receipt.total)}
Amount Received: ${formatCurrency(receipt.amountReceived)}
Change: ${formatCurrency(receipt.change)}
--------------------------------
Thank you for your purchase!
`;

    const blob = new Blob(
        [receiptText],
        {
            type: "text/plain;charset=utf-8"
        }
    );

    const url = URL.createObjectURL(blob);

    const link = document.createElement("a");

    link.href = url;

    link.download =
        `Receipt-${receipt.invoice}.txt`;

    document.body.appendChild(link);

    link.click();

    link.remove();

    URL.revokeObjectURL(url);
}


function startNewSale() {
    cart = [];

    discount = 0;

    window.lastReceipt = null;

    if (discountInput) {
        discountInput.value = "";
    }

    if (paymentModal) {
        paymentModal.classList.remove("show");

        paymentModal.setAttribute(
            "aria-hidden",
            "true"
        );
    }

    const paymentModalActions =
        document.getElementById(
            "paymentModalActions"
        );

    const receiptActions =
        document.getElementById(
            "receiptActions"
        );

    const paymentConfirmation =
        document.getElementById(
            "paymentConfirmation"
        );

    const modalTitle =
        document.getElementById(
            "paymentModalTitle"
        );

    const modalMessage =
        document.getElementById(
            "paymentModalMessage"
        );

    if (paymentModalActions) {
        paymentModalActions.style.display =
            "block";
    }

    if (receiptActions) {
        receiptActions.style.display =
            "none";
    }

    if (paymentConfirmation) {
        paymentConfirmation.style.display =
            "block";
    }

    if (modalTitle) {
        modalTitle.textContent =
            "Confirm Payment";
    }

    if (modalMessage) {
        modalMessage.textContent =
            "Review the payment before completing this transaction.";
    }

    if (confirmPaymentButton) {
        confirmPaymentButton.disabled = false;

        confirmPaymentButton.innerHTML =
            '<i class="fa-solid fa-check"></i> Confirm Payment';
    }

    renderProducts();
    renderCart();
    updateTotals();
}
    if (applyDiscountButton) {
        applyDiscountButton.addEventListener(
            "click",
            applyDiscount
        );
    }

    if (processPaymentButton) {
        processPaymentButton.addEventListener(
            "click",
            openPaymentModal
        );
    }

    if (closePaymentModal) {
        closePaymentModal.addEventListener(
            "click",
            closePayment
        );
    }

    if (paymentModal) {
        paymentModal.addEventListener(
            "click",
            (event) => {
                if (event.target === paymentModal) {
                    closePayment();
                }
            }
        );
    }

    if (confirmPaymentButton) {
        confirmPaymentButton.addEventListener(
            "click",
            confirmPayment
        );
    }

    if (cashReceivedInput) {
        cashReceivedInput.addEventListener(
            "input",
            calculateChange
        );
    }

    if (clearCartButton) {
        clearCartButton.addEventListener(
            "click",
            clearCart
        );
    }



    if (darkModeButton) {
        darkModeButton.addEventListener(
            "click",
            toggleDarkMode
        );
    }

    setupCategories();
    setupPaymentMethods();
    setupSearch();
    setupViewButtons();

    loadDarkMode();

    renderProducts();
    renderCart();
    updateTotals();
});
