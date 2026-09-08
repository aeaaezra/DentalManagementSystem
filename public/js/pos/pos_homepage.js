document.addEventListener("DOMContentLoaded", () => {
    const products = [
        {
            id: 1,
            name: "Mefenamic",
            sku: "DEN-001",
            category: "Consumables",
            price: 250,
            stock: 0
        },
        {
            id: 2,
            name: "Nitrile Gloves (Medium)",
            sku: "DEN-002",
            category: "Consumables",
            price: 550,
            stock: 77
        },
        {
            id: 3,
            name: "Paracetamol",
            sku: "DEN-003",
            category: "Consumables",
            price: 10,
            stock: 0
        },
        {
            id: 4,
            name: "Paracetamol",
            sku: "DEN-004",
            category: "Consumables",
            price: 5,
            stock: 0
        },
        {
            id: 5,
            name: "Paracetamol",
            sku: "DEN-006",
            category: "Consumables",
            price: 175,
            stock: 98
        }
    ];

    let cart = [];
    let activeCategory = "All Items";
    let searchTerm = "";
    let discount = 0;
    let paymentMethod = "cash";

    const productGrid = document.getElementById("productGrid");
    const cartItems = document.getElementById("cartItems");
    const cartEmpty = document.getElementById("cartEmpty");

    const searchInput = document.getElementById("productSearch");
    const barcodeInput = document.getElementById("barcodeInput");

    const subtotalElement = document.getElementById("subtotal");
    const discountElement = document.getElementById("discount");
    const taxElement = document.getElementById("tax");
    const totalElement = document.getElementById("totalAmount");

    const cartCountElement = document.getElementById("cartCount");

    const discountInput = document.getElementById("discountInput");
    const applyDiscountButton = document.getElementById("applyDiscount");

    const processPaymentButton =
        document.getElementById("processPayment");

    const paymentModal =
        document.getElementById("paymentModal");

    const paymentOverlay =
        document.getElementById("paymentOverlay");

    const closePaymentModal =
        document.getElementById("closePaymentModal");

    const cashReceivedInput =
        document.getElementById("cashReceived");

    const changeAmountElement =
        document.getElementById("changeAmount");

    const confirmPaymentButton =
        document.getElementById("confirmPayment");

    const darkModeButton =
        document.getElementById("darkModeButton");

    const clearCartButton =
        document.getElementById("clearCart");

    const holdOrderButton =
        document.getElementById("holdOrder");

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

                <div class="product-content">
                    <span class="product-category">
                        ${product.category}
                    </span>

                    <h3>
                        ${product.name}
                    </h3>

                    <p class="product-sku">
                        SKU: ${product.sku}
                    </p>

                    <div class="product-bottom">
                        <strong>
                            ${formatCurrency(product.price)}
                        </strong>

                        <span class="${
                            outOfStock
                                ? "stock-out"
                                : "stock-available"
                        }">
                            ${
                                outOfStock
                                    ? "Out of stock"
                                    : `${product.stock} pcs`
                            }
                        </span>
                    </div>

                    <button
                        class="add-cart-button"
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
            document.querySelectorAll(".add-cart-button");

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
        if (!cartCountElement) {
            return;
        }

        const count =
            cart.reduce(
                (total, item) =>
                    total + item.quantity,
                0
            );

        cartCountElement.textContent =
            `${count} item${count === 1 ? "" : "s"} selected`;
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

        paymentModal.classList.add("active");

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

        paymentModal.classList.remove("active");

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

    function confirmPayment() {
        const total =
            calculateTotal();

        const cash =
            Number(
                cashReceivedInput
                    ? cashReceivedInput.value
                    : 0
            );

        if (paymentMethod === "cash" && cash < total) {
            alert(
                "Insufficient cash received."
            );

            return;
        }

        const change =
            paymentMethod === "cash"
                ? cash - total
                : 0;

        cart.forEach(item => {
            const product =
                products.find(
                    productItem =>
                        productItem.id === item.id
                );

            if (product) {
                product.stock -= item.quantity;
            }
        });

        const invoiceNumber =
            "INV-" +
            new Date()
                .toISOString()
                .replace(/\D/g, "")
                .slice(0, 14);

        alert(
            `Payment successful!\n\n` +
            `Invoice: ${invoiceNumber}\n` +
            `Total: ${formatCurrency(total)}\n` +
            `Change: ${formatCurrency(change)}`
        );

        cart = [];
        discount = 0;

        if (discountInput) {
            discountInput.value = "";
        }

        closePayment();

        renderProducts();
        renderCart();
        updateTotals();
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

    if (paymentOverlay) {
        paymentOverlay.addEventListener(
            "click",
            closePayment
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

    if (holdOrderButton) {
        holdOrderButton.addEventListener(
            "click",
            holdOrder
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
