/* ============================================================
   PRODUCT DATA
============================================================ */

const products = [

    {
        id: 1,
        name: "Whitening Toothpaste",
        category: "toothpaste",
        price: 150,
        stock: 25,
        icon: "🪥",
        description:
            "Gentle whitening toothpaste for everyday oral care."
    },

    {
        id: 2,
        name: "Soft Toothbrush",
        category: "toothbrush",
        price: 120,
        stock: 35,
        icon: "🪥",
        description:
            "Soft-bristle toothbrush designed for gentle cleaning."
    },

    {
        id: 3,
        name: "Complete Dental Kit",
        category: "dental-kit",
        price: 350,
        stock: 18,
        icon: "🦷",
        description:
            "Complete basic dental care kit for daily use."
    },

    {
        id: 4,
        name: "Dental Floss",
        category: "consumables",
        price: 80,
        stock: 40,
        icon: "🧵",
        description:
            "Gentle dental floss for cleaning between teeth."
    },

    {
        id: 5,
        name: "Mouthwash",
        category: "oral-care",
        price: 180,
        stock: 20,
        icon: "🧴",
        description:
            "Refreshing mouthwash for daily oral hygiene."
    },

    {
        id: 6,
        name: "Tongue Cleaner",
        category: "oral-care",
        price: 90,
        stock: 30,
        icon: "✨",
        description:
            "Easy-to-use tongue cleaner for fresh breath."
    },

    {
        id: 7,
        name: "Interdental Brush",
        category: "toothbrush",
        price: 135,
        stock: 22,
        icon: "🪥",
        description:
            "Designed to clean hard-to-reach spaces between teeth."
    },

    {
        id: 8,
        name: "Kids Dental Kit",
        category: "dental-kit",
        price: 280,
        stock: 15,
        icon: "🦷",
        description:
            "Fun and gentle dental care kit for children."
    },

    {
        id: 9,
        name: "Dental Cotton Rolls",
        category: "consumables",
        price: 100,
        stock: 12,
        icon: "🧻",
        description:
            "Soft dental cotton rolls for oral care."
    }

];


/* ============================================================
   CART
============================================================ */

let cart = [];

let activeCategory = "all";


/* ============================================================
   DOM ELEMENTS
============================================================ */

const productGrid =
    document.getElementById(
        "productGrid"
    );

const productSearch =
    document.getElementById(
        "productSearch"
    );

const categorySelect =
    document.getElementById(
        "categorySelect"
    );

const categoryTabs =
    document.querySelectorAll(
        ".category-tab"
    );

const cartItems =
    document.getElementById(
        "cartItems"
    );

const cartSubtotal =
    document.getElementById(
        "cartSubtotal"
    );

const cartTotal =
    document.getElementById(
        "cartTotal"
    );

const cartItemCount =
    document.getElementById(
        "cartItemCount"
    );

const headerCartCount =
    document.getElementById(
        "headerCartCount"
    );

const checkoutButton =
    document.getElementById(
        "checkoutButton"
    );

const checkoutModal =
    document.getElementById(
        "checkoutModal"
    );

const successModal =
    document.getElementById(
        "successModal"
    );

const toast =
    document.getElementById(
        "toast"
    );

const deliveryOption =
    document.getElementById(
        "deliveryOption"
    );

const addressGroup =
    document.getElementById(
        "addressGroup"
    );

const checkoutSummary =
    document.getElementById(
        "checkoutSummary"
    );


/* ============================================================
   FORMAT CURRENCY
============================================================ */

function formatCurrency(amount) {

    return new Intl.NumberFormat(
        "en-PH",
        {
            style: "currency",
            currency: "PHP"
        }
    ).format(amount);

}


/* ============================================================
   CATEGORY NAME
============================================================ */

function categoryName(category) {

    const names = {

        "oral-care": "Oral Care",

        "toothbrush": "Toothbrush",

        "toothpaste": "Toothpaste",

        "dental-kit": "Dental Kit",

        "consumables": "Consumables"

    };

    return names[category] || "Dental Product";

}


/* ============================================================
   RENDER PRODUCTS
============================================================ */

function renderProducts() {

    const search =
        productSearch.value
            .trim()
            .toLowerCase();


    const filteredProducts =
        products.filter(
            product => {

                const matchesCategory =
                    activeCategory === "all" ||
                    product.category === activeCategory;


                const matchesSearch =
                    product.name
                        .toLowerCase()
                        .includes(search) ||

                    product.description
                        .toLowerCase()
                        .includes(search);


                return (
                    matchesCategory &&
                    matchesSearch
                );

            }
        );


    document.getElementById(
        "productCount"
    ).textContent =
        `${filteredProducts.length} products`;


    if (
        filteredProducts.length === 0
    ) {

        productGrid.innerHTML = `

            <div class="empty-products">

                <strong>
                    No products found
                </strong>

                <span>
                    Try another search or category.
                </span>

            </div>

        `;

        return;
    }


    productGrid.innerHTML =
        filteredProducts.map(
            product => {

                const isLowStock =
                    product.stock <= 10;


                return `

                    <article
                        class="product-card"
                    >

                        <div class="product-image">

                            <div class="product-icon">
                                ${product.icon}
                            </div>

                            <span
                                class="stock-label ${isLowStock ? "low" : ""}"
                            >
                                ${
                                    isLowStock
                                        ? "Low Stock"
                                        : "In Stock"
                                }
                            </span>

                        </div>


                        <div class="product-content">

                            <div class="product-category">
                                ${categoryName(product.category)}
                            </div>


                            <div class="product-name">
                                ${product.name}
                            </div>


                            <div class="product-description">
                                ${product.description}
                            </div>


                            <div class="product-bottom">

                                <div class="product-price">
                                    ${formatCurrency(product.price)}
                                </div>


                                <button
                                    type="button"
                                    class="add-button"
                                    onclick="addToCart(${product.id})"
                                    ${
                                        product.stock <= 0
                                            ? "disabled"
                                            : ""
                                    }
                                >
                                    ${
                                        product.stock <= 0
                                            ? "Out of Stock"
                                            : "Add to Cart"
                                    }
                                </button>

                            </div>

                        </div>

                    </article>

                `;

            }
        ).join("");

}


/* ============================================================
   ADD TO CART
============================================================ */

function addToCart(productId) {

    const product =
        products.find(
            item => item.id === productId
        );


    if (!product) {
        return;
    }


    const existing =
        cart.find(
            item => item.id === productId
        );


    if (existing) {

        if (
            existing.quantity >=
            product.stock
        ) {

            showToast(
                "You have reached the available stock."
            );

            return;
        }


        existing.quantity++;

    } else {

        cart.push({

            id: product.id,

            name: product.name,

            price: product.price,

            icon: product.icon,

            stock: product.stock,

            quantity: 1

        });

    }


    renderCart();


    showToast(
        `${product.name} added to cart.`
    );

}


/* ============================================================
   CHANGE QUANTITY
============================================================ */

function changeQuantity(
    productId,
    amount
) {

    const item =
        cart.find(
            product =>
                product.id === productId
        );


    if (!item) {
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
        item.stock
    ) {

        showToast(
            "Maximum available stock reached."
        );

        return;
    }


    item.quantity =
        newQuantity;


    renderCart();

}


/* ============================================================
   REMOVE FROM CART
============================================================ */

function removeFromCart(productId) {

    cart =
        cart.filter(
            item =>
                item.id !== productId
        );


    renderCart();

}


/* ============================================================
   RENDER CART
============================================================ */

function renderCart() {

    if (cart.length === 0) {

        cartItems.innerHTML = `

            <div class="cart-empty">

                <div class="cart-empty-icon">
                    🛒
                </div>

                <p>
                    Your cart is empty.
                </p>

                <span>
                    Add a product to get started.
                </span>

            </div>

        `;

    } else {

        cartItems.innerHTML =
            cart.map(
                item => `

                    <div
                        class="cart-item"
                    >

                        <div class="cart-item-image">
                            ${item.icon}
                        </div>


                        <div>

                            <div class="cart-item-name">
                                ${item.name}
                            </div>


                            <div class="cart-item-price">
                                ${formatCurrency(item.price)}
                            </div>


                            <div class="cart-item-controls">

                                <div
                                    class="quantity-controls"
                                >

                                    <button
                                        type="button"
                                        class="quantity-button"
                                        onclick="changeQuantity(${item.id}, -1)"
                                    >
                                        −
                                    </button>


                                    <span
                                        class="quantity-number"
                                    >
                                        ${item.quantity}
                                    </span>


                                    <button
                                        type="button"
                                        class="quantity-button"
                                        onclick="changeQuantity(${item.id}, 1)"
                                    >
                                        +
                                    </button>

                                </div>


                                <button
                                    type="button"
                                    class="remove-item"
                                    onclick="removeFromCart(${item.id})"
                                >
                                    Remove
                                </button>

                            </div>

                        </div>

                    </div>

                `
            ).join("");

    }


    const totalQuantity =
        cart.reduce(
            (
                total,
                item
            ) =>
                total +
                item.quantity,
            0
        );


    const subtotal =
        cart.reduce(
            (
                total,
                item
            ) =>
                total +
                (
                    item.price *
                    item.quantity
                ),
            0
        );


    const delivery =
        cart.length > 0
            ? 50
            : 0;


    const total =
        subtotal +
        delivery;


    cartItemCount.textContent =
        `${totalQuantity} ${
            totalQuantity === 1
                ? "item"
                : "items"
        }`;


    headerCartCount.textContent =
        totalQuantity;


    cartSubtotal.textContent =
        formatCurrency(
            subtotal
        );


    document.getElementById(
        "deliveryFee"
    ).textContent =
        formatCurrency(
            delivery
        );


    cartTotal.textContent =
        formatCurrency(
            total
        );


    checkoutButton.disabled =
        cart.length === 0;

}


/* ============================================================
   CATEGORY TABS
============================================================ */

categoryTabs.forEach(
    tab => {

        tab.addEventListener(
            "click",
            () => {

                categoryTabs.forEach(
                    item =>
                        item.classList.remove(
                            "active"
                        )
                );


                tab.classList.add(
                    "active"
                );


                activeCategory =
                    tab.dataset.category;


                categorySelect.value =
                    activeCategory;


                renderProducts();

            }
        );

    }
);


/* ============================================================
   CATEGORY SELECT
============================================================ */

categorySelect.addEventListener(
    "change",
    () => {

        activeCategory =
            categorySelect.value;


        categoryTabs.forEach(
            tab => {

                tab.classList.toggle(
                    "active",
                    tab.dataset.category ===
                    activeCategory
                );

            }
        );


        renderProducts();

    }
);


/* ============================================================
   SEARCH
============================================================ */

productSearch.addEventListener(
    "input",
    () => {

        renderProducts();

    }
);


/* ============================================================
   CHECKOUT
============================================================ */

checkoutButton.addEventListener(
    "click",
    () => {

        if (cart.length === 0) {
            return;
        }


        renderCheckoutSummary();


        checkoutModal.classList.add(
            "show"
        );

        document.body.style.overflow =
            "hidden";

    }
);


/* ============================================================
   CHECKOUT SUMMARY
============================================================ */

function renderCheckoutSummary() {

    const subtotal =
        cart.reduce(
            (
                total,
                item
            ) =>
                total +
                (
                    item.price *
                    item.quantity
                ),
            0
        );


    const delivery =
        50;


    const total =
        subtotal +
        delivery;


    checkoutSummary.innerHTML = `

        ${cart.map(
            item => `

                <div class="summary-product">

                    <span>
                        ${item.name}
                        × ${item.quantity}
                    </span>

                    <strong>
                        ${formatCurrency(
                            item.price *
                            item.quantity
                        )}
                    </strong>

                </div>

            `
        ).join("")}


        <div class="summary-product">

            <span>
                Subtotal
            </span>

            <strong>
                ${formatCurrency(subtotal)}
            </strong>

        </div>


        <div class="summary-product">

            <span>
                Delivery
            </span>

            <strong>
                ${formatCurrency(delivery)}
            </strong>

        </div>


        <div class="summary-product">

            <strong>
                Total
            </strong>

            <strong>
                ${formatCurrency(total)}
            </strong>

        </div>

    `;

}


/* ============================================================
   DELIVERY OPTION
============================================================ */

deliveryOption.addEventListener(
    "change",
    () => {

        if (
            deliveryOption.value ===
            "delivery"
        ) {

            addressGroup.style.display =
                "block";

        } else {

            addressGroup.style.display =
                "none";

        }

    }
);


/* ============================================================
   PAYMENT SELECTION
============================================================ */

document
    .querySelectorAll(
        ".payment-option"
    )
    .forEach(
        option => {

            option.addEventListener(
                "click",
                () => {

                    document
                        .querySelectorAll(
                            ".payment-option"
                        )
                        .forEach(
                            item =>
                                item.classList.remove(
                                    "selected"
                                )
                        );


                    option.classList.add(
                        "selected"
                    );


                    const radio =
                        option.querySelector(
                            "input"
                        );


                    radio.checked =
                        true;

                }
            );

        }
    );


/* ============================================================
   CLOSE CHECKOUT
============================================================ */

function closeCheckoutModal() {

    checkoutModal.classList.remove(
        "show"
    );

    document.body.style.overflow =
        "";

}


document
    .getElementById(
        "closeCheckout"
    )
    .addEventListener(
        "click",
        closeCheckoutModal
    );


document
    .getElementById(
        "cancelCheckout"
    )
    .addEventListener(
        "click",
        closeCheckoutModal
    );


/* ============================================================
   PLACE ORDER
============================================================ */

document
    .getElementById(
        "placeOrderButton"
    )
    .addEventListener(
        "click",
        () => {

            const contact =
                document
                    .getElementById(
                        "contactNumber"
                    )
                    .value
                    .trim();


            const orderMethod =
                deliveryOption.value;


            const address =
                document
                    .getElementById(
                        "deliveryAddress"
                    )
                    .value
                    .trim();


            const payment =
                document.querySelector(
                    'input[name="payment"]:checked'
                );


            if (!contact) {

                showToast(
                    "Please enter your contact number."
                );

                return;
            }


            if (
                orderMethod ===
                "delivery" &&
                !address
            ) {

                showToast(
                    "Please enter your delivery address."
                );

                return;
            }


            if (!payment) {

                showToast(
                    "Please select a payment method."
                );

                return;
            }


            const orderNumber =
                "ORD-" +
                Date.now()
                    .toString()
                    .slice(-6);


            document.getElementById(
                "generatedOrderNumber"
            ).textContent =
                orderNumber;


            checkoutModal.classList.remove(
                "show"
            );


            successModal.classList.add(
                "show"
            );


            cart = [];


            renderCart();


            document.body.style.overflow =
                "hidden";


            /*
             * IMPORTANT:
             *
             * This currently only simulates
             * placing the order.
             *
             * Later, connect this to your
             * Laravel order controller using
             * fetch() or an HTML form.
             */

        }
    );


/* ============================================================
   CLOSE SUCCESS
============================================================ */

document
    .getElementById(
        "closeSuccess"
    )
    .addEventListener(
        "click",
        () => {

            successModal.classList.remove(
                "show"
            );

            document.body.style.overflow =
                "";

        }
    );


/* ============================================================
   HEADER CART BUTTON
============================================================ */

document
    .getElementById(
        "headerCartButton"
    )
    .addEventListener(
        "click",
        () => {

            document
                .getElementById(
                    "cartPanel"
                )
                .scrollIntoView({
                    behavior: "smooth"
                });

        }
    );


/* ============================================================
   NOTIFICATION BUTTON
============================================================ */

document
    .getElementById(
        "notificationButton"
    )
    .addEventListener(
        "click",
        () => {

            showToast(
                "No new notifications."
            );

        }
    );


/* ============================================================
   TOAST
============================================================ */

let toastTimer;


function showToast(message) {

    toast.textContent =
        message;


    toast.classList.add(
        "show"
    );


    clearTimeout(
        toastTimer
    );


    toastTimer =
        setTimeout(
            () => {

                toast.classList.remove(
                    "show"
                );

            },
            2500
        );

}


/* ============================================================
   INITIALIZE
============================================================ */

renderProducts();

renderCart();
