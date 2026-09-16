/* =========================================================
   PINKCART - DATABASE CONNECTED PRODUCTS
========================================================= */

const products = window.PinkCart?.products || [];

const categories = [
    ...new Set(
        products
            .map(product => product.category)
            .filter(Boolean)
    )
];

let cart = JSON.parse(
    localStorage.getItem("pinkcart_cart") || "[]"
);

let favorites = JSON.parse(
    localStorage.getItem("pinkcart_favorites") || "[]"
);

let selectedProduct = null;
let detailQty = 1;
let activeCategory = "All";


/* =========================================================
   HELPERS
========================================================= */

const $ = selector => document.querySelector(selector);
const $$ = selector => document.querySelectorAll(selector);

const money = value =>
    `₱${Number(value || 0).toLocaleString("en-PH", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    })}`;


/* =========================================================
   LOCAL CART
   Cart can remain local until checkout.
========================================================= */

function saveCart() {
    localStorage.setItem(
        "pinkcart_cart",
        JSON.stringify(cart)
    );

    localStorage.setItem(
        "pinkcart_favorites",
        JSON.stringify(favorites)
    );
}


/* =========================================================
   FIND DATABASE PRODUCT
========================================================= */

function getProduct(id) {
    return products.find(
        product => Number(product.id) === Number(id)
    );
}


/* =========================================================
   PRODUCT CARD
========================================================= */

function productCard(product) {

    const saved = favorites.includes(Number(product.id));

    const image = product.image
        ? `
            <img
                src="${product.image}"
                alt="${escapeHtml(product.name)}"
                loading="lazy"
            >
        `
        : `
            <div class="product-placeholder">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 5h16v14H4z"></path>
                    <circle cx="9" cy="10" r="2"></circle>
                    <path d="m4 17 5-5 3 3 2-2 6 6"></path>
                </svg>
            </div>
        `;

    const outOfStock = Number(product.stock) <= 0;

    return `
        <article
            class="product-card"
            data-id="${product.id}"
        >

            <div class="product-image">

                ${image}

                <button
                    type="button"
                    class="favorite-btn ${saved ? "saved" : ""}"
                    data-favorite="${product.id}"
                    aria-label="Add to favorites"
                >
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M20.8 8.7c0 5.5-8.8 10.3-8.8 10.3S3.2 14.2 3.2 8.7A4.7 4.7 0 0 1 12 6.1a4.7 4.7 0 0 1 8.8 2.6Z"></path>
                    </svg>
                </button>

                ${
                    outOfStock
                        ? `<span class="stock-badge out">Out of Stock</span>`
                        : `<span class="stock-badge">In Stock</span>`
                }

            </div>


            <div class="product-info">

                <span class="product-category">
                    ${escapeHtml(product.category || "Dental Supply")}
                </span>

                <h3>
                    ${escapeHtml(product.name)}
                </h3>

                ${
                    product.brand
                        ? `
                            <span class="product-brand">
                                ${escapeHtml(product.brand)}
                            </span>
                        `
                        : ""
                }

                ${
                    product.description
                        ? `
                            <p>
                                ${escapeHtml(
                                    String(product.description).substring(0, 90)
                                )}
                            </p>
                        `
                        : ""
                }

                <div class="product-bottom">

                    <strong class="product-price">
                        ${money(product.price)}
                    </strong>

                    ${
                        !outOfStock
                            ? `
                                <button
                                    type="button"
                                    class="add-cart-btn"
                                    data-add="${product.id}"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                    >
                                        <path d="M3 4h2l2.1 11.1a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"></path>
                                        <circle cx="9" cy="20" r="1"></circle>
                                        <circle cx="18" cy="20" r="1"></circle>
                                    </svg>

                                    Add
                                </button>
                            `
                            : `
                                <button
                                    type="button"
                                    class="add-cart-btn disabled"
                                    disabled
                                >
                                    Out of Stock
                                </button>
                            `
                    }

                </div>

            </div>

        </article>
    `;
}


/* =========================================================
   ESCAPE HTML
========================================================= */

function escapeHtml(value) {

    const div = document.createElement("div");

    div.textContent = value ?? "";

    return div.innerHTML;
}


/* =========================================================
   CATEGORIES
========================================================= */

function renderCategories() {

    const container = $("#categoryList");

    if (!container) return;

    container.innerHTML = categories.map(category => {

        return `
            <button
                type="button"
                class="category-card"
                data-category="${escapeHtml(category)}"
            >

                <div class="category-icon">

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path d="M4 7h16"></path>
                        <path d="M6 7v12h12V7"></path>
                        <path d="M9 7V5h6v2"></path>
                    </svg>

                </div>

                <strong>
                    ${escapeHtml(category)}
                </strong>

            </button>
        `;

    }).join("");
}


/* =========================================================
   PRODUCTS
========================================================= */

function renderProducts() {

    const container = $("#productGrid");

    if (!container) return;

    let list = products;

    if (activeCategory !== "All") {

        list = products.filter(
            product =>
                product.category === activeCategory
        );

    }

    if (!list.length) {

        container.innerHTML = `
            <div
                class="empty-products"
                style="grid-column:1/-1"
            >

                <strong>
                    No products found
                </strong>

                <p>
                    Try another category.
                </p>

            </div>
        `;

        return;
    }

    container.innerHTML =
        list.map(productCard).join("");
}


/* =========================================================
   BEST SELLERS
========================================================= */

function renderBest() {

    const container = $("#bestSellerGrid");

    if (!container) return;

    container.innerHTML =
        products
            .filter(product => Number(product.stock) > 0)
            .slice(0, 4)
            .map(productCard)
            .join("");
}


/* =========================================================
   FILTERS
========================================================= */

function renderFilters() {

    const container = $("#filterRow");

    if (!container) return;

    const allCategories = [
        "All",
        ...categories
    ];

    container.innerHTML = allCategories
        .map(category => `
            <button
                type="button"
                class="filter ${
                    category === activeCategory
                        ? "active"
                        : ""
                }"
                data-filter="${escapeHtml(category)}"
            >
                ${escapeHtml(category)}
            </button>
        `)
        .join("");
}


/* =========================================================
   FAVORITES
========================================================= */

function renderFavorites() {

    const container = $("#favoriteGrid");

    if (!container) return;

    const list = products.filter(
        product =>
            favorites.includes(Number(product.id))
    );

    container.innerHTML = list.length
        ? list.map(productCard).join("")
        : `
            <div
                class="empty-products"
                style="grid-column:1/-1"
            >

                <h3>
                    No favorites yet
                </h3>

                <p>
                    Save products you want to find quickly later.
                </p>

            </div>
        `;
}


/* =========================================================
   CART
========================================================= */

function cartCount() {

    return cart.reduce(
        (total, item) =>
            total + Number(item.qty),
        0
    );
}


function subtotal() {

    return cart.reduce(
        (total, item) =>
            total +
            Number(item.price) *
            Number(item.qty),
        0
    );
}


function renderCart() {

    const count = cartCount();
    const sub = subtotal();

    const delivery = count > 0
        ? 60
        : 0;

    const total =
        sub + delivery;


    if ($("#cartBadge"))
        $("#cartBadge").textContent = count;

    if ($("#mobileCartBadge"))
        $("#mobileCartBadge").textContent = count;

    if ($("#sideCartCount")) {

        $("#sideCartCount").textContent =
            `${count} item${count !== 1 ? "s" : ""}`;

    }

    if ($("#sideCartTotal"))
        $("#sideCartTotal").textContent = money(sub);

    if ($("#cartSubtotal"))
        $("#cartSubtotal").textContent = money(sub);

    if ($("#cartDelivery"))
        $("#cartDelivery").textContent = money(delivery);

    if ($("#cartTotal"))
        $("#cartTotal").textContent = money(total);

    if ($("#checkoutTotal"))
        $("#checkoutTotal").textContent = money(total);


    if ($("#cartEmpty"))
        $("#cartEmpty").style.display =
            count ? "none" : "block";

    if ($("#cartItems"))
        $("#cartItems").style.display =
            count ? "block" : "none";

    if ($("#checkoutBtn")) {

        $("#checkoutBtn").disabled =
            !count;

        $("#checkoutBtn").style.opacity =
            count ? "1" : ".5";

    }


    if (!$("#cartItems")) return;


    $("#cartItems").innerHTML =
        cart.map(item => {

            const product =
                getProduct(item.id);

            const stock =
                product
                    ? Number(product.stock)
                    : Number(item.qty);

            return `
                <div class="cart-row">

                    <div class="cart-row-image">

                        ${
                            item.image
                                ? `
                                    <img
                                        src="${item.image}"
                                        alt="${escapeHtml(item.name)}"
                                    >
                                `
                                : ""
                        }

                    </div>


                    <div>

                        <h4>
                            ${escapeHtml(item.name)}
                        </h4>

                        <div class="unit">
                            ${money(item.price)}
                        </div>


                        <div class="cart-qty">

                            <button
                                type="button"
                                data-cart-minus="${item.id}"
                            >
                                −
                            </button>

                            <strong>
                                ${item.qty}
                            </strong>

                            <button
                                type="button"
                                data-cart-plus="${item.id}"
                                ${item.qty >= stock ? "disabled" : ""}
                            >
                                +
                            </button>

                        </div>

                    </div>


                    <div style="text-align:right">

                        <strong>
                            ${money(
                                Number(item.price) *
                                Number(item.qty)
                            )}
                        </strong>

                        <button
                            type="button"
                            class="remove"
                            data-remove="${item.id}"
                        >
                            Remove
                        </button>

                    </div>

                </div>
            `;

        }).join("");
}


/* =========================================================
   ADD TO CART
========================================================= */

function addToCart(id, qty = 1) {

    const product = getProduct(id);

    if (!product) return;


    const stock =
        Number(product.stock);


    if (stock <= 0) {

        toast("This product is out of stock.");

        return;
    }


    const existing =
        cart.find(
            item =>
                Number(item.id) === Number(id)
        );


    if (existing) {

        if (
            Number(existing.qty) +
            Number(qty) >
            stock
        ) {

            toast(
                `Only ${stock} available.`
            );

            return;
        }

        existing.qty += Number(qty);

    } else {

        cart.push({

            id: Number(product.id),

            name: product.name,

            price: Number(product.price),

            image: product.image,

            qty: Number(qty)

        });

    }


    saveCart();

    renderCart();

    toast(
        `${product.name} added to cart`
    );
}


/* =========================================================
   FAVORITES
========================================================= */

function toggleFavorite(id) {

    id = Number(id);

    if (favorites.includes(id)) {

        favorites =
            favorites.filter(
                productId =>
                    productId !== id
            );

        toast("Removed from favorites.");

    } else {

        favorites.push(id);

        toast("Saved to favorites.");

    }

    saveCart();

    renderBest();

    renderProducts();

    renderFavorites();
}


/* =========================================================
   PRODUCT MODAL
========================================================= */

function openProduct(id) {

    const product =
        getProduct(id);

    if (!product) return;


    selectedProduct = product;

    detailQty = 1;


    if ($("#detailImage")) {

        if (product.image) {

            $("#detailImage").style.backgroundImage =
                `url("${product.image}")`;

        }

    }


    if ($("#detailRating"))
        $("#detailRating").textContent =
            product.category || "Dental Supply";


    if ($("#detailName"))
        $("#detailName").textContent =
            product.name;


    if ($("#detailPrice"))
        $("#detailPrice").textContent =
            money(product.price);


    if ($("#detailDescription"))
        $("#detailDescription").textContent =
            product.description || "No description available.";


    if ($("#detailQty"))
        $("#detailQty").textContent =
            detailQty;


    $("#productModal")
        ?.classList.add("open");

    document.body.style.overflow =
        "hidden";
}


function closeModal(id) {

    const modal =
        document.getElementById(id);

    if (!modal) return;

    modal.classList.remove("open");

    if (
        !$("#productModal")?.classList.contains("open") &&
        !$("#checkoutModal")?.classList.contains("open")
    ) {

        document.body.style.overflow = "";

    }
}


/* =========================================================
   CART DRAWER
========================================================= */

function openCart() {

    $("#cartDrawer")
        ?.classList.add("open");

    $("#drawerOverlay")
        ?.classList.add("open");

    document.body.style.overflow =
        "hidden";
}


function closeCart() {

    $("#cartDrawer")
        ?.classList.remove("open");

    $("#drawerOverlay")
        ?.classList.remove("open");

    document.body.style.overflow = "";
}


/* =========================================================
   VIEWS
========================================================= */

function showView(view) {

    $$(".view").forEach(
        element =>
            element.classList.remove("active")
    );


    const target =
        document.getElementById(
            `${view}View`
        );


    if (target)
        target.classList.add("active");


    $$(".nav-item[data-view]")
        .forEach(nav => {

            nav.classList.toggle(
                "active",
                nav.dataset.view === view
            );

        });


    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });


    if (view === "products") {

        renderFilters();

        renderProducts();

    }


    if (view === "favorites")
        renderFavorites();

}


/* =========================================================
   TOAST
========================================================= */

function toast(message) {

    const element =
        $("#toast");

    if (!element) return;

    element.textContent =
        message;

    element.classList.add("show");

    clearTimeout(
        window.pinkCartToastTimer
    );

    window.pinkCartToastTimer =
        setTimeout(() => {

            element.classList.remove("show");

        }, 2200);
}


/* =========================================================
   EVENTS
========================================================= */

document.addEventListener(
    "click",
    event => {

        const view =
            event.target.closest(
                "[data-view]"
            );

        if (view) {

            showView(
                view.dataset.view
            );

            return;
        }


        const add =
            event.target.closest(
                "[data-add]"
            );

        if (add) {

            addToCart(
                Number(add.dataset.add)
            );

            return;
        }


        const favorite =
            event.target.closest(
                "[data-favorite]"
            );

        if (favorite) {

            event.stopPropagation();

            toggleFavorite(
                Number(
                    favorite.dataset.favorite
                )
            );

            return;
        }


        const card =
            event.target.closest(
                ".product-card"
            );

        if (
            card &&
            !event.target.closest("button")
        ) {

            openProduct(
                Number(card.dataset.id)
            );

            return;
        }


        const category =
            event.target.closest(
                "[data-category]"
            );

        if (category) {

            activeCategory =
                category.dataset.category;

            showView("products");

            return;
        }


        const filter =
            event.target.closest(
                "[data-filter]"
            );

        if (filter) {

            activeCategory =
                filter.dataset.filter;

            renderFilters();

            renderProducts();

            return;
        }


        const plus =
            event.target.closest(
                "[data-cart-plus]"
            );

        if (plus) {

            const item =
                cart.find(
                    x =>
                        Number(x.id) ===
                        Number(
                            plus.dataset.cartPlus
                        )
                );

            const product =
                item
                    ? getProduct(item.id)
                    : null;

            if (
                item &&
                product &&
                item.qty < Number(product.stock)
            ) {

                item.qty++;

                saveCart();

                renderCart();

            }

            return;
        }


        const minus =
            event.target.closest(
                "[data-cart-minus]"
            );

        if (minus) {

            const item =
                cart.find(
                    x =>
                        Number(x.id) ===
                        Number(
                            minus.dataset.cartMinus
                        )
                );

            if (item) {

                item.qty--;

                if (item.qty <= 0) {

                    cart =
                        cart.filter(
                            x =>
                                Number(x.id) !==
                                Number(item.id)
                        );

                }

                saveCart();

                renderCart();

            }

            return;
        }


        const remove =
            event.target.closest(
                "[data-remove]"
            );

        if (remove) {

            cart =
                cart.filter(
                    item =>
                        Number(item.id) !==
                        Number(remove.dataset.remove)
                );

            saveCart();

            renderCart();

            return;
        }


        const close =
            event.target.closest(
                "[data-close]"
            );

        if (close) {

            closeModal(
                close.dataset.close
            );

        }

    }
);


/* =========================================================
   HEADER BUTTONS
========================================================= */

$("#cartBtn")?.addEventListener(
    "click",
    openCart
);

$("#mobileCart")?.addEventListener(
    "click",
    openCart
);

$("#sideCheckoutBtn")?.addEventListener(
    "click",
    openCart
);

$("#closeCart")?.addEventListener(
    "click",
    closeCart
);

$("#drawerOverlay")?.addEventListener(
    "click",
    closeCart
);


/* =========================================================
   SEARCH
========================================================= */

$("#searchToggle")?.addEventListener(
    "click",
    () => {

        $("#searchWrap")
            ?.classList.toggle("open");

        if (
            $("#searchWrap")
                ?.classList.contains("open")
        ) {

            $("#searchInput")?.focus();

        }

    }
);


$("#searchInput")?.addEventListener(
    "input",
    event => {

        const query =
            event.target.value
                .toLowerCase()
                .trim();


        if (!query) {

            renderProducts();

            return;
        }


        showView("products");


        const results =
            products.filter(product => {

                const text =
                    `${product.name}
                     ${product.category}
                     ${product.brand || ""}
                     ${product.sku || ""}`.toLowerCase();

                return text.includes(query);

            });


        $("#productGrid").innerHTML =
            results.length
                ? results.map(productCard).join("")
                : `
                    <div
                        class="empty-products"
                        style="grid-column:1/-1"
                    >
                        <h3>
                            No products found
                        </h3>

                        <p>
                            Try another search.
                        </p>
                    </div>
                `;

    }
);


/* =========================================================
   PRODUCT QUANTITY
========================================================= */

$("#detailMinus")?.addEventListener(
    "click",
    () => {

        detailQty =
            Math.max(
                1,
                detailQty - 1
            );

        $("#detailQty").textContent =
            detailQty;

    }
);


$("#detailPlus")?.addEventListener(
    "click",
    () => {

        if (!selectedProduct)
            return;


        const stock =
            Number(
                selectedProduct.stock
            );


        if (detailQty >= stock) {

            toast(
                `Only ${stock} available.`
            );

            return;
        }


        detailQty++;

        $("#detailQty").textContent =
            detailQty;

    }
);


$("#detailAdd")?.addEventListener(
    "click",
    () => {

        if (!selectedProduct)
            return;

        addToCart(
            selectedProduct.id,
            detailQty
        );

        closeModal("productModal");

        openCart();

    }
);


/* =========================================================
   CHECKOUT
========================================================= */

$("#checkoutBtn")?.addEventListener(
    "click",
    () => {

        if (!cartCount()) {

            toast(
                "Your cart is empty."
            );

            return;
        }


        closeCart();

        $("#checkoutModal")
            ?.classList.add("open");

        document.body.style.overflow =
            "hidden";

    }
);


/* =========================================================
   SEND ORDER TO LARAVEL DATABASE
========================================================= */

$("#checkoutForm")?.addEventListener(
    "submit",
    async event => {

        event.preventDefault();


        if (!cart.length) {

            toast(
                "Your cart is empty."
            );

            return;
        }


        const form =
            event.target;


        const formData =
            new FormData(form);


        /*
         * Laravel expects:
         *
         * items[0][product_id]
         * items[0][quantity]
         * items[1][product_id]
         * items[1][quantity]
         *
         * payment_method
         */


        cart.forEach(
            (item, index) => {

                formData.append(
                    `items[${index}][product_id]`,
                    item.id
                );

                formData.append(
                    `items[${index}][quantity]`,
                    item.qty
                );

            }
        );


        formData.set(
            "payment_method",
            form.querySelector(
                '[name="payment_method"]'
            )?.value || ""
        );


        /*
         * CustomerOrderController
         * expects the authenticated
         * customer to exist.
         */

        try {

            const response =
                await fetch(
                    window.PinkCart.orderUrl,
                    {
                        method: "POST",

                        headers: {
                            "X-CSRF-TOKEN":
                                window.PinkCart.csrf,

                            "Accept":
                                "application/json"
                        },

                        body: formData
                    }
                );


            const result =
                await response.json();


            if (!response.ok) {

                const message =
                    result.message ||
                    "Unable to place your order.";

                throw new Error(
                    message
                );
            }


            if (!result.success) {

                throw new Error(
                    result.message ||
                    "Order failed."
                );

            }


            /*
             * Order successfully stored
             * in MySQL.
             */

            cart = [];

            saveCart();

            renderCart();

            closeModal(
                "checkoutModal"
            );


            toast(
                result.message ||
                "Your order has been submitted successfully."
            );


            /*
             * Go to My Orders.
             */

            if (result.redirect) {

                setTimeout(
                    () => {
                        window.location.href =
                            result.redirect;
                    },
                    700
                );

            }

        } catch (error) {

            console.error(
                "Checkout error:",
                error
            );

            toast(
                error.message ||
                "Something went wrong."
            );

        }

    }
);


/* =========================================================
   INITIALIZE
========================================================= */

renderCategories();

renderBest();

renderFilters();

renderProducts();

renderFavorites();

renderCart();
