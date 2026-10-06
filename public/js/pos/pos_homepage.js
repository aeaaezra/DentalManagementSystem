document.addEventListener("DOMContentLoaded", () => {
    /*
    |--------------------------------------------------------------------------
    | PRODUCTS
    |--------------------------------------------------------------------------
    */

    const products = Array.isArray(window.posProducts)
        ? window.posProducts.map(product => ({
            id: Number(product.id),
            name: product.name ?? "Unnamed Product",
            sku: product.sku ?? "",
            category: product.category ?? "Uncategorized",
            brand: product.brand ?? "",
            price: Number(product.price) || 0,
            stock: Number(product.stock) || 0,
            image: product.image ?? ""
        }))
        : [];

    /*
    |--------------------------------------------------------------------------
    | POS STATE
    |--------------------------------------------------------------------------
    */

    let cart = [];
    let activeCategory = "All Items";
    let searchTerm = "";
    let discount = 0;
    let appliedDiscount = null;
    let paymentMethod = "cash";

    /*
    |--------------------------------------------------------------------------
    | DOM ELEMENTS
    |--------------------------------------------------------------------------
    */

    const productGrid =
        document.getElementById("productGrid");

    const cartItems =
        document.getElementById("cartList");

    const cartEmpty =
        document.querySelector(".empty-cart");

    const searchInput =
        document.getElementById("searchInput");

    const barcodeInput =
        document.getElementById("barcodeBtn");

    const subtotalElement =
        document.getElementById("subtotal");

    const discountElement =
        document.getElementById("discount");

    const taxElement =
        document.getElementById("tax");

    const totalElement =
        document.getElementById("total");

    const cartCountElement =
        document.getElementById("cartCount");

    const discountInput =
        document.getElementById("discountCode");

    const applyDiscountButton =
        document.getElementById("applyDiscount");

    const processPaymentButton =
        document.getElementById("processPayment");

    const paymentModal =
        document.getElementById("paymentModal");

    const closePaymentModal =
        document.getElementById("closePaymentModal");

    const cashReceivedInput =
        document.getElementById("amountReceived");

    const modalCashReceivedInput =
        document.getElementById("modalAmountReceived");

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

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    function formatCurrency(value) {
        return `₱${Number(value || 0).toLocaleString("en-PH", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        })}`;
    }

    function getCsrfToken() {
        return document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUCT FILTERING
    |--------------------------------------------------------------------------
    */

    function getFilteredProducts() {
        const search =
            searchTerm.toLowerCase().trim();

        return products.filter(product => {
            const matchesCategory =
                activeCategory === "All Items" ||
                product.category === activeCategory;

            const matchesSearch =
                !search ||
                product.name
                    .toLowerCase()
                    .includes(search) ||
                product.sku
                    .toLowerCase()
                    .includes(search) ||
                product.brand
                    .toLowerCase()
                    .includes(search);

            return matchesCategory && matchesSearch;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RENDER PRODUCTS
    |--------------------------------------------------------------------------
    */

    function renderProducts() {
        if (!productGrid) {
            return;
        }

        const list = getFilteredProducts();

        if (!list.length) {
            productGrid.innerHTML = `
                <div
                    style="
                        grid-column:1/-1;
                        text-align:center;
                        padding:60px;
                        color:var(--muted);
                    "
                >
                    <i
                        class="fa-solid fa-box-open"
                        style="
                            font-size:38px;
                            margin-bottom:12px;
                        "
                    ></i>

                    <h3>No products found</h3>

                    <p
                        style="
                            font-size:12px;
                            margin-top:5px;
                        "
                    >
                        Try another search, brand, or category.
                    </p>
                </div>
            `;

            return;
        }

        productGrid.innerHTML = list
            .map(product => {
                const out =
                    product.stock <= 0;

                const low =
                    !out && product.stock <= 10;

                let image =
                    product.image || "";

                /*
                |--------------------------------------------------------------------------
                | PRODUCT IMAGE URL
                |--------------------------------------------------------------------------
                */

                if (
                    image &&
                    !/^(https?:)?\/\//.test(image)
                ) {
                    if (
                        image.startsWith("storage/")
                    ) {
                        image = "/" + image;
                    } else {
                        image =
                            "/storage/" +
                            image.replace(/^\/+/, "");
                    }
                }

                return `
                    <article class="product-card">

                        <div class="product-image">

                            ${
                                image
                                    ? `
                                        <img
                                            src="${image}"
                                            alt="${product.name}"
                                            class="product-image-file"
                                            loading="lazy"
                                            onerror="
                                                this.style.display='none';
                                                this.nextElementSibling.style.display='flex';
                                            "
                                        >

                                        <div
                                            class="product-image-fallback"
                                            style="display:none;"
                                        >
                                            <i class="fa-solid fa-box"></i>
                                        </div>
                                    `
                                    : `
                                        <div
                                            class="product-image-fallback"
                                        >
                                            <i class="fa-solid fa-box"></i>
                                        </div>
                                    `
                            }

                            <button
                                type="button"
                                class="product-favorite"
                                data-favorite="${product.id}"
                                title="Favorite"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                        </div>

                        <div class="product-info">

                            <span class="product-category">
                                ${product.category}
                            </span>

                            <h3>
                                ${product.name}
                            </h3>

                            <div class="sku">
                                SKU: ${product.sku}
                            </div>

                            <div
                                class="
                                    stock
                                    ${out
                                        ? "out"
                                        : low
                                            ? "low"
                                            : ""}
                                "
                            >
                                <i class="fa-solid fa-circle"></i>

                                ${
                                    out
                                        ? "Out of Stock"
                                        : low
                                            ? `Low Stock (${product.stock})`
                                            : `In Stock (${product.stock})`
                                }
                            </div>

                            <div class="price-row">
                                <span class="price">
                                    ${formatCurrency(product.price)}
                                </span>
                            </div>

                            <button
                                type="button"
                                class="add-button"
                                data-add="${product.id}"
                                ${out ? "disabled" : ""}
                            >
                                <i
                                    class="fa-solid fa-cart-shopping"
                                ></i>

                                ${
                                    out
                                        ? "Out of Stock"
                                        : "Add to Cart"
                                }
                            </button>

                        </div>

                    </article>
                `;
            })
            .join("");
    }

    /*
    |--------------------------------------------------------------------------
    | ADD TO CART
    |--------------------------------------------------------------------------
    */

    function addToCart(productId) {
        const id =
            Number(productId);

        const product =
            products.find(
                item =>
                    Number(item.id) === id
            );

        if (!product) {
            console.error(
                "Product not found:",
                id
            );

            return;
        }

        if (product.stock <= 0) {
            alert(
                "This product is out of stock."
            );

            return;
        }

        const existingItem =
            cart.find(
                item =>
                    Number(item.id) === id
            );

        if (existingItem) {
            if (
                existingItem.quantity >=
                product.stock
            ) {
                alert(
                    `Only ${product.stock} item(s) available.`
                );

                return;
            }

            existingItem.quantity += 1;
        } else {
            cart.push({
                id: product.id,
                name: product.name,
                sku: product.sku,
                price: product.price,
                quantity: 1,
                stock: product.stock
            });
        }

        renderCart();
        updateTotals();
    }

    /*
    |--------------------------------------------------------------------------
    | CHANGE QUANTITY
    |--------------------------------------------------------------------------
    */

    function changeQuantity(
        productId,
        amount
    ) {
        const item =
            cart.find(
                cartItem =>
                    Number(cartItem.id) ===
                    Number(productId)
            );

        if (!item) {
            return;
        }

        const product =
            products.find(
                productItem =>
                    Number(productItem.id) ===
                    Number(productId)
            );

        if (!product) {
            return;
        }

        const newQuantity =
            item.quantity + amount;

        if (newQuantity <= 0) {
            removeFromCart(productId);
            return;
        }

        if (
            newQuantity >
            product.stock
        ) {
            alert(
                `Only ${product.stock} item(s) available.`
            );

            return;
        }

        item.quantity =
            newQuantity;

        renderCart();
        updateTotals();
    }

    /*
    |--------------------------------------------------------------------------
    | REMOVE FROM CART
    |--------------------------------------------------------------------------
    */

    function removeFromCart(productId) {
        cart =
            cart.filter(
                item =>
                    Number(item.id) !==
                    Number(productId)
            );

        renderCart();
        updateTotals();
    }

    /*
    |--------------------------------------------------------------------------
    | RENDER CART
    |--------------------------------------------------------------------------
    */

    function renderCart() {
        if (!cartItems || !cartEmpty) {
            return;
        }

        cartItems.innerHTML = "";

        if (cart.length === 0) {
            cartEmpty.style.display =
                "flex";

            updateCartCount();

            return;
        }

        cartEmpty.style.display =
            "none";

        cart.forEach(item => {
            const cartItem =
                document.createElement("div");

            cartItem.className =
                "cart-item";

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
                        type="button"
                    >
                        <i
                            class="fa-solid fa-minus"
                        ></i>
                    </button>

                    <span class="quantity">
                        ${item.quantity}
                    </span>

                    <button
                        class="quantity-button"
                        data-action="increase"
                        data-id="${item.id}"
                        type="button"
                    >
                        <i
                            class="fa-solid fa-plus"
                        ></i>
                    </button>

                    <button
                        class="remove-cart-button"
                        data-action="remove"
                        data-id="${item.id}"
                        type="button"
                    >
                        <i
                            class="fa-solid fa-trash"
                        ></i>
                    </button>

                </div>

                <div class="cart-item-total">
                    ${formatCurrency(
                        item.price *
                        item.quantity
                    )}
                </div>
            `;

            cartItems.appendChild(
                cartItem
            );
        });

        attachCartButtons();
        updateCartCount();
    }

    /*
    |--------------------------------------------------------------------------
    | CART BUTTONS
    |--------------------------------------------------------------------------
    */

    function attachCartButtons() {
        const buttons =
            document.querySelectorAll(
                "[data-action]"
            );

        buttons.forEach(button => {
            button.addEventListener(
                "click",
                () => {
                    const productId =
                        Number(
                            button.dataset.id
                        );

                    const action =
                        button.dataset.action;

                    if (
                        action ===
                        "increase"
                    ) {
                        changeQuantity(
                            productId,
                            1
                        );
                    }

                    if (
                        action ===
                        "decrease"
                    ) {
                        changeQuantity(
                            productId,
                            -1
                        );
                    }

                    if (
                        action ===
                        "remove"
                    ) {
                        removeFromCart(
                            productId
                        );
                    }
                }
            );
        });
    }

    /*
    |--------------------------------------------------------------------------
    | CART COUNT
    |--------------------------------------------------------------------------
    */

    function updateCartCount() {
        const count =
            cart.reduce(
                (total, item) =>
                    total +
                    item.quantity,
                0
            );

        if (cartCountElement) {
            cartCountElement.textContent =
                count;
        }

        const selectedText =
            document.getElementById(
                "selectedText"
            );

        if (selectedText) {
            selectedText.textContent =
                `${count} item${
                    count === 1
                        ? ""
                        : "s"
                } selected`;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SUBTOTAL
    |--------------------------------------------------------------------------
    */

    function calculateSubtotal() {
        return cart.reduce(
            (total, item) =>
                total +
                item.price *
                item.quantity,
            0
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DISCOUNT
    |--------------------------------------------------------------------------
    */

    function calculateDiscount(
        subtotal
    ) {
        if (!appliedDiscount) {
            return 0;
        }

        let discountAmount = 0;

        if (
            appliedDiscount.type ===
            "percentage"
        ) {
            discountAmount =
                subtotal *
                (
                    Number(
                        appliedDiscount.value
                    ) / 100
                );
        }

        if (
            appliedDiscount.type ===
            "fixed"
        ) {
            discountAmount =
                Number(
                    appliedDiscount.value
                );
        }

        if (
            appliedDiscount.maximum_discount !==
                null &&
            appliedDiscount.maximum_discount !==
                undefined
        ) {
            discountAmount =
                Math.min(
                    discountAmount,
                    Number(
                        appliedDiscount.maximum_discount
                    )
                );
        }

        return Math.min(
            discountAmount,
            subtotal
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TAX
    |--------------------------------------------------------------------------
    */

    function calculateTax(amount) {
        return 0;
    }

    /*
    |--------------------------------------------------------------------------
    | TOTALS
    |--------------------------------------------------------------------------
    */

    function updateTotals() {
        const subtotal =
            calculateSubtotal();

        const discountAmount =
            calculateDiscount(
                subtotal
            );

        const taxableAmount =
            Math.max(
                subtotal -
                discountAmount,
                0
            );

        const tax =
            calculateTax(
                taxableAmount
            );

        const total =
            taxableAmount + tax;

        if (subtotalElement) {
            subtotalElement.textContent =
                formatCurrency(
                    subtotal
                );
        }

        if (discountElement) {
            discountElement.textContent =
                `-${formatCurrency(
                    discountAmount
                )}`;
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

    /*
    |--------------------------------------------------------------------------
    | APPLY DISCOUNT
    |--------------------------------------------------------------------------
    */

    async function applyDiscount() {
        if (!discountInput) {
            return;
        }

        const code =
            discountInput.value
                .trim()
                .toUpperCase();

        if (!code) {
            appliedDiscount = null;
            discount = 0;

            updateTotals();

            return;
        }

        const subtotal =
            calculateSubtotal();

        if (subtotal <= 0) {
            alert(
                "Please add products to the cart first."
            );

            return;
        }

        const csrfToken =
            getCsrfToken();

        if (!csrfToken) {
            alert(
                "Security token is missing. Please refresh the page."
            );

            return;
        }

        if (applyDiscountButton) {
            applyDiscountButton.disabled =
                true;

            applyDiscountButton.textContent =
                "Checking...";
        }

        try {
            const response =
                await fetch(
                    "/pos/discount/validate",
                    {
                        method: "POST",

                        headers: {
                            "Content-Type":
                                "application/json",

                            "Accept":
                                "application/json",

                            "X-CSRF-TOKEN":
                                csrfToken,

                            "X-Requested-With":
                                "XMLHttpRequest"
                        },

                        body:
                            JSON.stringify({
                                code: code,
                                subtotal:
                                    subtotal
                            })
                    }
                );

            const data =
                await response.json();

            if (
                !response.ok ||
                !data.success
            ) {
                throw new Error(
                    data.message ||
                    data.error ||
                    "Invalid discount code."
                );
            }

            appliedDiscount = {
                code: data.code,

                type: data.type,

                value:
                    Number(
                        data.value
                    ),

                minimum_amount:
                    Number(
                        data.minimum_amount ||
                        0
                    ),

                maximum_discount:
                    data.maximum_discount !==
                    null
                        ? Number(
                            data.maximum_discount
                        )
                        : null,

                discount_amount:
                    Number(
                        data.discount_amount
                    ) || 0
            };

            discount =
                subtotal > 0
                    ? appliedDiscount.discount_amount /
                      subtotal
                    : 0;

            updateTotals();

            alert(
                `Discount ${appliedDiscount.code} applied.\n` +
                `Discount: ${formatCurrency(
                    appliedDiscount.discount_amount
                )}`
            );

        } catch (error) {
            console.error(
                "Discount validation error:",
                error
            );

            appliedDiscount = null;
            discount = 0;

            updateTotals();

            alert(
                error.message ||
                "Invalid discount code."
            );

        } finally {
            if (applyDiscountButton) {
                applyDiscountButton.disabled =
                    false;

                applyDiscountButton.textContent =
                    "Apply";
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | OPEN PAYMENT MODAL
    |--------------------------------------------------------------------------
    */

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

        const currentTotal =
            calculateTotal();

        const existingCash =
            Number(
                cashReceivedInput?.value ||
                0
            );

        paymentModal.classList.add(
            "show"
        );

        paymentModal.setAttribute(
            "aria-hidden",
            "false"
        );

        const receiptTotal =
            document.getElementById(
                "receiptTotal"
            );

        const receiptMethod =
            document.getElementById(
                "receiptMethod"
            );

        const receiptAmountReceived =
            document.getElementById(
                "receiptAmountReceived"
            );

        const modalAmount =
            document.getElementById(
                "modalAmountReceived"
            );

        if (receiptTotal) {
            receiptTotal.textContent =
                formatCurrency(
                    currentTotal
                );
        }

        if (receiptMethod) {
            receiptMethod.textContent =
                paymentMethod === "cash"
                    ? "Cash"
                    : paymentMethod.toUpperCase();
        }

        if (modalAmount) {
            modalAmount.value =
                existingCash > 0
                    ? existingCash
                    : "";
        }

        if (receiptAmountReceived) {
            receiptAmountReceived.textContent =
                formatCurrency(
                    existingCash
                );
        }

        calculateChange();

        setTimeout(() => {
            if (modalAmount) {
                modalAmount.focus();
                modalAmount.select();
            }
        }, 100);
    }

    /*
    |--------------------------------------------------------------------------
    | CLOSE PAYMENT
    |--------------------------------------------------------------------------
    */

    function closePayment() {
        if (!paymentModal) {
            return;
        }

        paymentModal.classList.remove(
            "show"
        );

        paymentModal.setAttribute(
            "aria-hidden",
            "true"
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CALCULATE CHANGE
    |--------------------------------------------------------------------------
    */

    function calculateChange() {
        const total =
            calculateTotal();

        const cash =
            Number(
                modalCashReceivedInput
                    ? modalCashReceivedInput.value
                    : cashReceivedInput
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
                formatCurrency(
                    change
                );
        }

        const receiptChange =
            document.getElementById(
                "receiptChange"
            );

        if (receiptChange) {
            receiptChange.textContent =
                formatCurrency(
                    change
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | TOTAL
    |--------------------------------------------------------------------------
    */

    function calculateTotal() {
        const subtotal =
            calculateSubtotal();

        const discountAmount =
            calculateDiscount(
                subtotal
            );

        const taxableAmount =
            Math.max(
                subtotal -
                discountAmount,
                0
            );

        const tax =
            calculateTax(
                taxableAmount
            );

        return taxableAmount + tax;
    }

    /*
    |--------------------------------------------------------------------------
    | CONFIRM PAYMENT
    |--------------------------------------------------------------------------
    */

    async function confirmPayment() {
        if (cart.length === 0) {
            alert(
                "Your cart is empty."
            );

            return;
        }

        const total =
            calculateTotal();

        const cash =
            Number(
                cashReceivedInput
                    ? cashReceivedInput.value
                    : 0
            );

        if (
            paymentMethod === "cash" &&
            cash < total
        ) {
            alert(
                "Insufficient cash received."
            );

            return;
        }

        const csrfToken =
            getCsrfToken();

        if (!csrfToken) {
            alert(
                "Security token is missing. Please refresh the page."
            );

            return;
        }

        const cartPayload =
            cart.map(item => ({
                id: item.id,
                qty:
                    Number(
                        item.quantity
                    )
            }));

        const discountCode =
            appliedDiscount?.code ||
            (
                discountInput
                    ? discountInput.value
                        .trim()
                        .toUpperCase()
                    : ""
            ) ||
            null;

        const confirmButton =
            document.getElementById(
                "confirmPayment"
            );

        if (confirmButton) {
            confirmButton.disabled =
                true;

            confirmButton.innerHTML =
                `
                    <i
                        class="fa-solid fa-spinner fa-spin"
                    ></i>
                    Processing...
                `;
        }

        try {
            const response =
                await fetch(
                    "/pos/checkout",
                    {
                        method: "POST",

                        headers: {
                            "Content-Type":
                                "application/json",

                            "Accept":
                                "application/json",

                            "X-CSRF-TOKEN":
                                csrfToken,

                            "X-Requested-With":
                                "XMLHttpRequest"
                        },

                        body:
                            JSON.stringify({
                                cart:
                                    cartPayload,

                                discount_code:
                                    discountCode,

                                cash_received:
                                    cash
                            })
                    }
                );

            const data =
                await response.json();

            if (
                !response.ok ||
                !data.success
            ) {
                throw new Error(
                    data.message ||
                    data.error ||
                    "Payment could not be completed."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | RECEIPT INFORMATION
            |--------------------------------------------------------------------------
            */

            const receiptInvoice =
                document.getElementById(
                    "receiptInvoice"
                );

            const receiptTotal =
                document.getElementById(
                    "receiptTotal"
                );

            const receiptMethod =
                document.getElementById(
                    "receiptMethod"
                );

            const receiptAmountReceived =
                document.getElementById(
                    "receiptAmountReceived"
                );

            const receiptChange =
                document.getElementById(
                    "receiptChange"
                );

            if (receiptInvoice) {
                receiptInvoice.textContent =
                    data.invoice_no ||
                    "N/A";
            }

            if (receiptTotal) {
                receiptTotal.textContent =
                    formatCurrency(
                        Number(
                            data.total_amount ||
                            total
                        )
                    );
            }

            if (receiptMethod) {
                receiptMethod.textContent =
                    paymentMethod === "cash"
                        ? "Cash"
                        : paymentMethod;
            }

            /*
            |--------------------------------------------------------------------------
            | AMOUNT RECEIVED
            |--------------------------------------------------------------------------
            */

            if (receiptAmountReceived) {
                receiptAmountReceived.textContent =
                    formatCurrency(
                        Number(
                            data.cash_received ||
                            cash
                        )
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | CHANGE
            |--------------------------------------------------------------------------
            */

            if (receiptChange) {
                receiptChange.textContent =
                    formatCurrency(
                        Number(
                            data.change_amount ||
                            0
                        )
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | SHOW SUCCESSFUL RECEIPT STATE
            |--------------------------------------------------------------------------
            */

            const modalTitle =
                document.getElementById(
                    "paymentModalTitle"
                );

            const modalMessage =
                document.getElementById(
                    "paymentModalMessage"
                );

            const paymentConfirmation =
                document.getElementById(
                    "paymentConfirmation"
                );

            const paymentModalActions =
                document.getElementById(
                    "paymentModalActions"
                );

            const receiptActions =
                document.getElementById(
                    "receiptActions"
                );

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
            |--------------------------------------------------------------------------
            | UPDATE LOCAL PRODUCT STOCK
            |--------------------------------------------------------------------------
            */

            cart.forEach(item => {
                const product =
                    products.find(
                        productItem =>
                            Number(
                                productItem.id
                            ) ===
                            Number(item.id)
                    );

                if (product) {
                    product.stock =
                        Math.max(
                            0,
                            Number(
                                product.stock ||
                                0
                            ) -
                            Number(
                                item.quantity ||
                                0
                            )
                        );
                }
            });

            /*
            |--------------------------------------------------------------------------
            | SAVE LAST RECEIPT
            |--------------------------------------------------------------------------
            */

            window.lastReceipt = {
                invoice:
                    data.invoice_no,

                total:
                    Number(
                        data.total_amount ||
                        total
                    ),

                method:
                    paymentMethod === "cash"
                        ? "Cash"
                        : paymentMethod,

                amountReceived:
                    Number(
                        data.cash_received ||
                        cash
                    ),

                change:
                    Number(
                        data.change_amount ||
                        0
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
                confirmButton.disabled =
                    false;

                confirmButton.innerHTML =
                    `
                        <i
                            class="fa-solid fa-check"
                        ></i>
                        Confirm Payment
                    `;
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CLEAR CART
    |--------------------------------------------------------------------------
    */

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

            appliedDiscount = null;

            if (discountInput) {
                discountInput.value =
                    "";
            }

            renderCart();
            updateTotals();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | HOLD ORDER
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | DARK MODE
    |--------------------------------------------------------------------------
    */

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
            enabled
                ? "true"
                : "false"
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

    /*
    |--------------------------------------------------------------------------
    | CATEGORIES
    |--------------------------------------------------------------------------
    */

    function setupCategories() {
        categoryButtons.forEach(
            button => {
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
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PAYMENT METHODS
    |--------------------------------------------------------------------------
    */

    function setupPaymentMethods() {
        paymentButtons.forEach(
            button => {
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
                            (
                                button.dataset.payment ||
                                "cash"
                            ).toLowerCase();

                        const cashSection =
                            document.getElementById(
                                "cashPaymentSection"
                            );

                        if (cashSection) {
                            cashSection.style.display =
                                paymentMethod ===
                                "cash"
                                    ? "block"
                                    : "none";
                        }

                        calculateChange();
                    }
                );
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUCT BUTTONS
    |--------------------------------------------------------------------------
    |
    | Event delegation is used here because renderProducts()
    | replaces the product HTML after searching/filtering.
    |
    */

    function setupProductButtons() {
        if (!productGrid) {
            return;
        }

        productGrid.addEventListener(
            "click",
            event => {
                const button =
                    event.target.closest(
                        "[data-add]"
                    );

                if (!button) {
                    return;
                }

                if (button.disabled) {
                    return;
                }

                const productId =
                    Number(
                        button.dataset.add
                    );

                addToCart(productId);
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH / BARCODE
    |--------------------------------------------------------------------------
    */

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
                    if (
                        event.key !==
                        "Enter"
                    ) {
                        return;
                    }

                    const barcode =
                        barcodeInput.value
                            .trim();

                    if (!barcode) {
                        return;
                    }

                    const product =
                        products.find(
                            item =>
                                item.sku
                                    .toLowerCase() ===
                                barcode
                                    .toLowerCase()
                        );

                    if (product) {
                        addToCart(
                            product.id
                        );
                    } else {
                        alert(
                            "Product not found."
                        );
                    }

                    barcodeInput.value =
                        "";
                }
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | GRID / LIST VIEW
    |--------------------------------------------------------------------------
    */

    function setupViewButtons() {
        if (
            gridViewButton &&
            productGrid
        ) {
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

        if (
            listViewButton &&
            productGrid
        ) {
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

    /*
    |--------------------------------------------------------------------------
    | PRINT RECEIPT
    |--------------------------------------------------------------------------
    */

    function printReceipt() {
        if (!window.lastReceipt) {
            alert(
                "No completed payment is available to print."
            );

            return;
        }

        const receipt =
            window.lastReceipt;

        const receiptWindow =
            window.open(
                "",
                "_blank",
                "width=420,height=650"
            );

        if (!receiptWindow) {
            alert(
                "Please allow pop-ups to print the receipt."
            );

            return;
        }

        receiptWindow.document.write(`
            <!DOCTYPE html>

            <html>

            <head>

                <title>
                    Receipt - ${receipt.invoice}
                </title>

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

                <h2>
                    SHINE & SMILE
                </h2>

                <div class="center">
                    Dental Supply POS
                </div>

                <div class="line"></div>

                <div class="row">
                    <span>Invoice</span>
                    <strong>
                        ${receipt.invoice}
                    </strong>
                </div>

                <div class="row">
                    <span>Payment</span>
                    <strong>
                        ${receipt.method}
                    </strong>
                </div>

                <div class="line"></div>

                <div class="row total">
                    <span>Total</span>
                    <span>
                        ${formatCurrency(
                            receipt.total
                        )}
                    </span>
                </div>

                <div class="row">
                    <span>
                        Amount Received
                    </span>

                    <span>
                        ${formatCurrency(
                            receipt.amountReceived
                        )}
                    </span>
                </div>

                <div class="row">
                    <span>Change</span>

                    <span>
                        ${formatCurrency(
                            receipt.change
                        )}
                    </span>
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

    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD RECEIPT
    |--------------------------------------------------------------------------
    */

    function downloadReceipt() {
        if (!window.lastReceipt) {
            alert(
                "No completed payment is available to download."
            );

            return;
        }

        const receipt =
            window.lastReceipt;

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

        const blob =
            new Blob(
                [receiptText],
                {
                    type:
                        "text/plain;charset=utf-8"
                }
            );

        const url =
            URL.createObjectURL(
                blob
            );

        const link =
            document.createElement(
                "a"
            );

        link.href = url;

        link.download =
            `Receipt-${receipt.invoice}.txt`;

        document.body.appendChild(
            link
        );

        link.click();

        link.remove();

        URL.revokeObjectURL(
            url
        );
    }

    /*
    |--------------------------------------------------------------------------
    | NEW SALE
    |--------------------------------------------------------------------------
    */

    function startNewSale() {
        cart = [];

        discount = 0;

        appliedDiscount = null;

        window.lastReceipt = null;

        if (discountInput) {
            discountInput.value =
                "";
        }

        if (cashReceivedInput) {
            cashReceivedInput.value =
                "";
        }

        if (modalCashReceivedInput) {
            modalCashReceivedInput.value =
                "";
        }

        if (paymentModal) {
            paymentModal.classList.remove(
                "show"
            );

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
            confirmPaymentButton.disabled =
                false;

            confirmPaymentButton.innerHTML =
                `
                    <i
                        class="fa-solid fa-check"
                    ></i>
                    Confirm Payment
                `;
        }

        renderProducts();
        renderCart();
        updateTotals();
    }

    /*
    |--------------------------------------------------------------------------
    | EVENT LISTENERS
    |--------------------------------------------------------------------------
    */

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
            event => {
                if (
                    event.target ===
                    paymentModal
                ) {
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

    if (modalCashReceivedInput) {
        modalCashReceivedInput.addEventListener(
            "input",
            () => {
                if (cashReceivedInput) {
                    cashReceivedInput.value =
                        modalCashReceivedInput.value;
                }

                calculateChange();

                const receiptAmountReceived =
                    document.getElementById(
                        "receiptAmountReceived"
                    );

                if (receiptAmountReceived) {
                    receiptAmountReceived.textContent =
                        formatCurrency(
                            Number(
                                modalCashReceivedInput.value ||
                                0
                            )
                        );
                }
            }
        );
    }

    if (clearCartButton) {
        clearCartButton.addEventListener(
            "click",
            clearCart
        );
    }

    if (printReceiptButton) {
        printReceiptButton.addEventListener(
            "click",
            printReceipt
        );
    }

    if (downloadReceiptButton) {
        downloadReceiptButton.addEventListener(
            "click",
            downloadReceipt
        );
    }

    if (newSaleButton) {
        newSaleButton.addEventListener(
            "click",
            startNewSale
        );
    }

    if (darkModeButton) {
        darkModeButton.addEventListener(
            "click",
            toggleDarkMode
        );
    }

    /*
    |--------------------------------------------------------------------------
    | INITIALIZE
    |--------------------------------------------------------------------------
    */

    setupCategories();

    setupPaymentMethods();

    setupSearch();

    setupViewButtons();

    setupProductButtons();

    loadDarkMode();

    renderProducts();

    renderCart();

    updateTotals();
});
