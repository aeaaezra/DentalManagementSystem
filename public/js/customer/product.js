document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* ========================================================
           ELEMENTS
        ======================================================== */

        const profileButton =
            document.getElementById(
                'profileDropdownButton'
            );

        const profileWrapper =
            document.querySelector(
                '.customer-profile-wrapper'
            );

        const searchInput =
            document.getElementById(
                'searchInput'
            );

        const categoryFilter =
            document.getElementById(
                'categoryFilter'
            );

        const categoryButtons =
            document.querySelectorAll(
                '.category'
            );

        const productGrid =
            document.getElementById(
                'productGrid'
            );

        const productCount =
            document.getElementById(
                'productCount'
            );

        const shopNowButton =
            document.getElementById(
                'shopNowButton'
            );

        const productsSection =
            document.getElementById(
                'productsSection'
            );

        const cartDrawer =
            document.getElementById(
                'cartDrawer'
            );

        const cartOverlay =
            document.getElementById(
                'cartOverlay'
            );

        const closeCart =
            document.getElementById(
                'closeCart'
            );

        const cartContent =
            document.getElementById(
                'cartContent'
            );

        const cartCount =
            document.getElementById(
                'cartCount'
            );

        const cartItemsText =
            document.getElementById(
                'cartItemsText'
            );

        const cartTotal =
            document.getElementById(
                'cartTotal'
            );

        const checkoutButton =
            document.getElementById(
                'checkoutButton'
            );

        const productModal =
            document.getElementById(
                'productModal'
            );

        const closeProductModal =
            document.getElementById(
                'closeProductModal'
            );

        const modalProductCategory =
            document.getElementById(
                'modalProductCategory'
            );

        const modalProductName =
            document.getElementById(
                'modalProductName'
            );

        const modalProductDescription =
            document.getElementById(
                'modalProductDescription'
            );

        const modalProductPrice =
            document.getElementById(
                'modalProductPrice'
            );

        const modalProductStock =
            document.getElementById(
                'modalProductStock'
            );

        const modalQuantity =
            document.getElementById(
                'modalQuantity'
            );

        const modalMinus =
            document.getElementById(
                'modalMinus'
            );

        const modalPlus =
            document.getElementById(
                'modalPlus'
            );

        const modalAddButton =
            document.getElementById(
                'modalAddButton'
            );

        const toast =
            document.getElementById(
                'toast'
            );



        /* ========================================================
           PRODUCT DATA

           Your controller can pass:

           window.customerProducts = @json($products);

           If it isn't available yet, this safely starts empty.
        ======================================================== */

        let products = [];


        if (
            Array.isArray(
                window.customerProducts
            )
        ) {

            products =
                window.customerProducts.map(
                    normalizeProduct
                );

        }


        /*
         * Temporary fallback.
         *
         * Remove these once your controller is
         * passing real products from the database.
         */

        if (products.length === 0) {

            products = [
                {
                    id: 1,
                    name: 'Premium Toothbrush',
                    category: 'toothbrush',
                    description:
                        'Soft-bristle toothbrush for everyday oral care.',
                    price: 89.00,
                    stock: 25
                },
                {
                    id: 2,
                    name: 'Fresh Mint Toothpaste',
                    category: 'toothpaste',
                    description:
                        'Daily fluoride toothpaste with a fresh mint flavor.',
                    price: 129.00,
                    stock: 30
                },
                {
                    id: 3,
                    name: 'Complete Dental Kit',
                    category: 'dental-kit',
                    description:
                        'Essential dental care items in one convenient kit.',
                    price: 249.00,
                    stock: 12
                },
                {
                    id: 4,
                    name: 'Dental Floss',
                    category: 'oral-care',
                    description:
                        'Gentle dental floss for cleaning between teeth.',
                    price: 79.00,
                    stock: 40
                }
            ];

        }



        /* ========================================================
           NORMALIZE PRODUCT
        ======================================================== */

        function normalizeProduct(
            product
        ) {

            return {

                id:
                    product.id,

                name:
                    product.name ??
                    product.product_name ??
                    'Product',

                category:
                    normalizeCategory(
                        product.category ??
                        product.category_name ??
                        'oral-care'
                    ),

                description:
                    product.description ??
                    'Quality dental care product.',

                price:
                    Number(
                        product.price ??
                        product.selling_price ??
                        product.unit_price ??
                        0
                    ),

                stock:
                    Number(
                        product.stock ??
                        product.quantity ??
                        product.stock_quantity ??
                        0
                    )

            };

        }



        /* ========================================================
           CATEGORY NORMALIZATION
        ======================================================== */

        function normalizeCategory(
            category
        ) {

            return String(
                category
            )
                .toLowerCase()
                .trim()
                .replace(
                    /\s+/g,
                    '-'
                );

        }



        /* ========================================================
           FORMAT PRICE
        ======================================================== */

        function formatPrice(
            amount
        ) {

            return new Intl.NumberFormat(
                'en-PH',
                {
                    style: 'currency',
                    currency: 'PHP'
                }
            ).format(
                Number(amount) || 0
            );

        }



        /* ========================================================
           SVG PRODUCT ICON
        ======================================================== */

        function productIcon() {

            return `
                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path
                        d="M8.5 3.5
                           C6.2 3.5 4.5 5.2 4.5 7.8
                           C4.5 11.2 5.8 14.3 6.4 17.4
                           C6.8 19.5 7.7 21 9 21
                           C10.3 21 10.5 18.2 12 18.2
                           C13.5 18.2 13.7 21 15 21
                           C16.3 21 17.2 19.5 17.6 17.4
                           C18.2 14.3 19.5 11.2 19.5 7.8
                           C19.5 5.2 17.8 3.5 15.5 3.5
                           C14 3.5 13 4.3 12 4.3
                           C11 4.3 10 3.5 8.5 3.5Z"
                    />
                </svg>
            `;

        }



        /* ========================================================
           CART ICON
        ======================================================== */

        function cartIcon() {

            return `
                <svg viewBox="0 0 24 24">

                    <path
                        d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"
                    />

                    <circle
                        cx="10"
                        cy="20"
                        r="1.2"
                    />

                    <circle
                        cx="18"
                        cy="20"
                        r="1.2"
                    />

                </svg>
            `;

        }



        /* ========================================================
           RENDER PRODUCTS
        ======================================================== */

        function renderProducts() {

            if (!productGrid) {
                return;
            }


            const search =
                (
                    searchInput?.value ||
                    ''
                )
                .toLowerCase()
                .trim();


            const selectedCategory =
                categoryFilter?.value ||
                'all';


            const filteredProducts =
                products.filter(
                    function (product) {

                        const matchesSearch =
                            product.name
                                .toLowerCase()
                                .includes(search)
                            ||
                            product.description
                                .toLowerCase()
                                .includes(search);


                        const matchesCategory =
                            selectedCategory ===
                                'all'
                            ||
                            product.category ===
                                selectedCategory;


                        return (
                            matchesSearch &&
                            matchesCategory
                        );

                    }
                );


            if (productCount) {

                productCount.textContent =
                    filteredProducts.length === 1
                        ? '1 product'
                        : `${filteredProducts.length} products`;

            }


            if (
                filteredProducts.length ===
                0
            ) {

                productGrid.innerHTML = `

                    <div class="no-products">

                        <div class="no-products-icon">

                            <svg viewBox="0 0 24 24">

                                <circle
                                    cx="11"
                                    cy="11"
                                    r="7"
                                />

                                <path
                                    d="m20 20-4-4"
                                />

                            </svg>

                        </div>

                        <strong>
                            No products found
                        </strong>

                        <p>
                            Try another search or category.
                        </p>

                    </div>

                `;

                return;

            }


            productGrid.innerHTML =
                filteredProducts
                    .map(
                        renderProductCard
                    )
                    .join('');


            attachProductEvents();

        }



        /* ========================================================
           PRODUCT CARD
        ======================================================== */

        function renderProductCard(
            product
        ) {

            const outOfStock =
                product.stock <= 0;


            return `

                <article
                    class="product-card"
                    data-product-id="${product.id}"
                >

                    <div class="product-image">

                        ${productIcon()}

                    </div>


                    <div class="product-body">

                        <span class="product-category">
                            ${escapeHtml(
                                product.category
                                    .replace(
                                        /-/g,
                                        ' '
                                    )
                            )}
                        </span>


                        <h3 class="product-name">
                            ${escapeHtml(
                                product.name
                            )}
                        </h3>


                        <p class="product-description">
                            ${escapeHtml(
                                product.description
                            )}
                        </p>


                        <div class="product-bottom">

                            <div>

                                <div class="product-price">
                                    ${formatPrice(
                                        product.price
                                    )}
                                </div>

                                <div class="product-stock">
                                    ${
                                        outOfStock
                                            ? 'Out of stock'
                                            : `${product.stock} in stock`
                                    }
                                </div>

                            </div>


                            <button
                                type="button"
                                class="product-button"
                                data-product-id="${product.id}"
                                ${outOfStock ? 'disabled' : ''}
                                aria-label="Add product to cart"
                            >

                                ${cartIcon()}

                            </button>

                        </div>

                    </div>

                </article>

            `;

        }



        /* ========================================================
           ESCAPE HTML
        ======================================================== */

        function escapeHtml(
            value
        ) {

            const div =
                document.createElement(
                    'div'
                );

            div.textContent =
                String(value ?? '');

            return div.innerHTML;

        }



        /* ========================================================
           PRODUCT EVENTS
        ======================================================== */

        function attachProductEvents() {

            document
                .querySelectorAll(
                    '.product-card'
                )
                .forEach(
                    function (card) {

                        card.addEventListener(
                            'click',
                            function (event) {

                                if (
                                    event.target.closest(
                                        '.product-button'
                                    )
                                ) {
                                    return;
                                }


                                const id =
                                    Number(
                                        card.dataset.productId
                                    );


                                openProductModal(
                                    id
                                );

                            }
                        );

                    }
                );


            document
                .querySelectorAll(
                    '.product-button'
                )
                .forEach(
                    function (button) {

                        button.addEventListener(
                            'click',
                            function (event) {

                                event.stopPropagation();


                                const id =
                                    Number(
                                        button.dataset.productId
                                    );


                                addToCart(
                                    id,
                                    1
                                );

                            }
                        );

                    }
                );

        }



        /* ========================================================
           PRODUCT MODAL
        ======================================================== */

        let selectedProduct = null;

        let modalQty = 1;


        function openProductModal(
            productId
        ) {

            selectedProduct =
                products.find(
                    function (product) {

                        return Number(
                            product.id
                        ) === Number(
                            productId
                        );

                    }
                );


            if (!selectedProduct) {
                return;
            }


            modalQty = 1;


            if (modalProductCategory) {

                modalProductCategory.textContent =
                    selectedProduct.category
                        .replace(
                            /-/g,
                            ' '
                        );

            }


            if (modalProductName) {

                modalProductName.textContent =
                    selectedProduct.name;

            }


            if (modalProductDescription) {

                modalProductDescription.textContent =
                    selectedProduct.description;

            }


            if (modalProductPrice) {

                modalProductPrice.textContent =
                    formatPrice(
                        selectedProduct.price
                    );

            }


            if (modalProductStock) {

                modalProductStock.textContent =
                    selectedProduct.stock;

            }


            updateModalQuantity();


            if (productModal) {

                productModal.classList.add(
                    'show'
                );

                document.body.style.overflow =
                    'hidden';

            }

        }



        function closeModal() {

            if (productModal) {

                productModal.classList.remove(
                    'show'
                );

            }

            document.body.style.overflow =
                '';

            selectedProduct = null;

        }



        function updateModalQuantity() {

            if (modalQuantity) {

                modalQuantity.textContent =
                    modalQty;

            }


            if (
                selectedProduct &&
                modalAddButton
            ) {

                modalAddButton.disabled =
                    selectedProduct.stock <= 0
                    ||
                    modalQty <= 0
                    ||
                    modalQty >
                        selectedProduct.stock;

            }

        }



        /* ========================================================
           MODAL QUANTITY
        ======================================================== */

        if (modalMinus) {

            modalMinus.addEventListener(
                'click',
                function () {

                    if (modalQty > 1) {

                        modalQty--;

                        updateModalQuantity();

                    }

                }
            );

        }


        if (modalPlus) {

            modalPlus.addEventListener(
                'click',
                function () {

                    if (
                        selectedProduct &&
                        modalQty <
                            selectedProduct.stock
                    ) {

                        modalQty++;

                        updateModalQuantity();

                    }

                }
            );

        }


        if (closeProductModal) {

            closeProductModal.addEventListener(
                'click',
                closeModal
            );

        }


        if (productModal) {

            productModal.addEventListener(
                'click',
                function (event) {

                    if (
                        event.target ===
                        productModal
                    ) {

                        closeModal();

                    }

                }
            );

        }



        /* ========================================================
           ADD TO CART FROM MODAL
        ======================================================== */

        if (modalAddButton) {

            modalAddButton.addEventListener(
                'click',
                function () {

                    if (!selectedProduct) {
                        return;
                    }


                    addToCart(
                        selectedProduct.id,
                        modalQty
                    );


                    closeModal();

                }
            );

        }



        /* ========================================================
           LOCAL STORAGE CART
        ======================================================== */

        function getCart() {

            try {

                const saved =
                    localStorage.getItem(
                        'shineSmileCart'
                    );


                if (!saved) {
                    return [];
                }


                const cart =
                    JSON.parse(
                        saved
                    );


                return Array.isArray(
                    cart
                )
                    ? cart
                    : [];

            } catch (error) {

                console.warn(
                    'Unable to load cart.',
                    error
                );

                return [];

            }

        }



        function saveCart(
            cart
        ) {

            localStorage.setItem(
                'shineSmileCart',
                JSON.stringify(
                    cart
                )
            );


            updateCart();

        }



        /* ========================================================
           ADD TO CART
        ======================================================== */

        function addToCart(
            productId,
            quantity
        ) {

            const product =
                products.find(
                    function (item) {

                        return Number(
                            item.id
                        ) === Number(
                            productId
                        );

                    }
                );


            if (!product) {
                return;
            }


            if (product.stock <= 0) {

                showToast(
                    'This product is out of stock.'
                );

                return;

            }


            let cart =
                getCart();


            const existing =
                cart.find(
                    function (item) {

                        return Number(
                            item.id
                        ) === Number(
                            product.id
                        );

                    }
                );


            if (existing) {

                existing.quantity =
                    Math.min(
                        Number(
                            existing.quantity
                        ) + Number(
                            quantity
                        ),
                        product.stock
                    );

            } else {

                cart.push({

                    id:
                        product.id,

                    name:
                        product.name,

                    price:
                        product.price,

                    category:
                        product.category,

                    quantity:
                        Math.min(
                            Number(
                                quantity
                            ),
                            product.stock
                        )

                });

            }


            saveCart(
                cart
            );


            showToast(
                `${product.name} added to cart.`
            );


            openCart();

        }



        /* ========================================================
           UPDATE CART
        ======================================================== */

        function updateCart() {

            const cart =
                getCart();


            const totalQuantity =
                cart.reduce(
                    function (
                        total,
                        item
                    ) {

                        return total +
                            Number(
                                item.quantity || 0
                            );

                    },
                    0
                );


            const total =
                cart.reduce(
                    function (
                        amount,
                        item
                    ) {

                        return amount +
                            (
                                Number(
                                    item.price || 0
                                )
                                *
                                Number(
                                    item.quantity || 0
                                )
                            );

                    },
                    0
                );


            if (cartCount) {

                cartCount.textContent =
                    totalQuantity > 99
                        ? '99+'
                        : totalQuantity;

            }


            if (cartItemsText) {

                cartItemsText.textContent =
                    totalQuantity === 1
                        ? '1 item'
                        : `${totalQuantity} items`;

            }


            if (cartTotal) {

                cartTotal.textContent =
                    formatPrice(
                        total
                    );

            }


            if (checkoutButton) {

                checkoutButton.disabled =
                    cart.length === 0;

            }


            renderCart(
                cart
            );

        }



        /* ========================================================
           RENDER CART
        ======================================================== */

        function renderCart(
            cart
        ) {

            if (!cartContent) {
                return;
            }


            if (cart.length === 0) {

                cartContent.innerHTML = `

                    <div class="empty-cart">

                        <div class="empty-cart-icon">

                            ${cartIcon()}

                        </div>

                        <strong>
                            Your cart is empty
                        </strong>

                        <p>
                            Add some dental products to get started.
                        </p>

                    </div>

                `;

                return;

            }


            cartContent.innerHTML =
                cart.map(
                    renderCartItem
                ).join('');


            attachCartEvents();

        }



        /* ========================================================
           CART ITEM
        ======================================================== */

        function renderCartItem(
            item
        ) {

            return `

                <div
                    class="cart-item"
                    data-cart-id="${item.id}"
                >

                    <div class="cart-item-image">

                        ${productIcon()}

                    </div>


                    <div class="cart-item-info">

                        <span class="cart-item-name">
                            ${escapeHtml(
                                item.name
                            )}
                        </span>


                        <div class="cart-item-price">
                            ${formatPrice(
                                item.price
                            )}
                        </div>


                        <div class="cart-item-actions">

                            <div class="cart-quantity">

                                <button
                                    type="button"
                                    class="cart-minus"
                                    data-id="${item.id}"
                                    aria-label="Decrease quantity"
                                >

                                    <svg viewBox="0 0 24 24">

                                        <path
                                            d="M5 12h14"
                                        />

                                    </svg>

                                </button>


                                <span>
                                    ${item.quantity}
                                </span>


                                <button
                                    type="button"
                                    class="cart-plus"
                                    data-id="${item.id}"
                                    aria-label="Increase quantity"
                                >

                                    <svg viewBox="0 0 24 24">

                                        <path
                                            d="M12 5v14"
                                        />

                                        <path
                                            d="M5 12h14"
                                        />

                                    </svg>

                                </button>

                            </div>


                            <button
                                type="button"
                                class="remove-cart-item"
                                data-id="${item.id}"
                            >
                                Remove
                            </button>

                        </div>

                    </div>

                </div>

            `;

        }



        /* ========================================================
           CART EVENTS
        ======================================================== */

        function attachCartEvents() {

            document
                .querySelectorAll(
                    '.cart-minus'
                )
                .forEach(
                    function (button) {

                        button.addEventListener(
                            'click',
                            function () {

                                changeCartQuantity(
                                    Number(
                                        button.dataset.id
                                    ),
                                    -1
                                );

                            }
                        );

                    }
                );


            document
                .querySelectorAll(
                    '.cart-plus'
                )
                .forEach(
                    function (button) {

                        button.addEventListener(
                            'click',
                            function () {

                                changeCartQuantity(
                                    Number(
                                        button.dataset.id
                                    ),
                                    1
                                );

                            }
                        );

                    }
                );


            document
                .querySelectorAll(
                    '.remove-cart-item'
                )
                .forEach(
                    function (button) {

                        button.addEventListener(
                            'click',
                            function () {

                                removeFromCart(
                                    Number(
                                        button.dataset.id
                                    )
                                );

                            }
                        );

                    }
                );

        }



        /* ========================================================
           CHANGE CART QUANTITY
        ======================================================== */

        function changeCartQuantity(
            productId,
            amount
        ) {

            let cart =
                getCart();


            const item =
                cart.find(
                    function (cartItem) {

                        return Number(
                            cartItem.id
                        ) === Number(
                            productId
                        );

                    }
                );


            const product =
                products.find(
                    function (productItem) {

                        return Number(
                            productItem.id
                        ) === Number(
                            productId
                        );

                    }
                );


            if (!item) {
                return;
            }


            item.quantity =
                Number(
                    item.quantity
                ) +
                Number(
                    amount
                );


            if (
                product &&
                item.quantity >
                    product.stock
            ) {

                item.quantity =
                    product.stock;

            }


            if (
                item.quantity <= 0
            ) {

                cart =
                    cart.filter(
                        function (cartItem) {

                            return Number(
                                cartItem.id
                            ) !== Number(
                                productId
                            );

                        }
                    );

            }


            saveCart(
                cart
            );

        }



        /* ========================================================
           REMOVE FROM CART
        ======================================================== */

        function removeFromCart(
            productId
        ) {

            const cart =
                getCart()
                    .filter(
                        function (item) {

                            return Number(
                                item.id
                            ) !== Number(
                                productId
                            );

                        }
                    );


            saveCart(
                cart
            );


            showToast(
                'Item removed from cart.'
            );

        }



        /* ========================================================
           OPEN CART
        ======================================================== */

        function openCart() {

            if (cartDrawer) {

                cartDrawer.classList.add(
                    'open'
                );

            }

            if (cartOverlay) {

                cartOverlay.classList.add(
                    'show'
                );

            }

            document.body.style.overflow =
                'hidden';

        }



        /* ========================================================
           CLOSE CART
        ======================================================== */

        function closeCartDrawer() {

            if (cartDrawer) {

                cartDrawer.classList.remove(
                    'open'
                );

            }

            if (cartOverlay) {

                cartOverlay.classList.remove(
                    'show'
                );

            }

            document.body.style.overflow =
                '';

        }



        if (cartOverlay) {

            cartOverlay.addEventListener(
                'click',
                closeCartDrawer
            );

        }


        if (closeCart) {

            closeCart.addEventListener(
                'click',
                closeCartDrawer
            );

        }



        /* ========================================================
           CART BUTTON
        ======================================================== */

        const headerCart =
            document.querySelector(
                '.cart-button'
            );


        if (headerCart) {

            headerCart.addEventListener(
                'click',
                function (event) {

                    /*
                     * Keep the normal route when
                     * the user intentionally visits
                     * the dedicated cart page.
                     *
                     * The drawer is opened from
                     * product buttons / checkout flow.
                     */

                }
            );

        }



        /* ========================================================
           CHECKOUT
        ======================================================== */

        if (checkoutButton) {

            checkoutButton.addEventListener(
                'click',
                function () {

                    const cart =
                        getCart();


                    if (
                        cart.length === 0
                    ) {

                        showToast(
                            'Your cart is empty.'
                        );

                        return;

                    }


                    /*
                     * This sends the customer to
                     * your Laravel checkout route.
                     */

                    window.location.href =
                        checkoutButton.dataset.url ||
                        '/customer/checkout';

                }
            );

        }



        /* ========================================================
           PROFILE DROPDOWN
        ======================================================== */

        if (
            profileButton &&
            profileWrapper
        ) {

            profileButton.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();


                    const isOpen =
                        profileWrapper.classList.contains(
                            'open'
                        );


                    profileWrapper.classList.toggle(
                        'open',
                        !isOpen
                    );


                    profileButton.setAttribute(
                        'aria-expanded',
                        String(
                            !isOpen
                        )
                    );

                }
            );


            document.addEventListener(
                'click',
                function (event) {

                    if (
                        !profileWrapper.contains(
                            event.target
                        )
                    ) {

                        profileWrapper.classList.remove(
                            'open'
                        );


                        profileButton.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                    }

                }
            );

        }



        /* ========================================================
           SEARCH
        ======================================================== */

        if (searchInput) {

            searchInput.addEventListener(
                'input',
                renderProducts
            );

        }



        /* ========================================================
           CATEGORY SELECT
        ======================================================== */

        if (categoryFilter) {

            categoryFilter.addEventListener(
                'change',
                function () {

                    syncCategoryButtons(
                        categoryFilter.value
                    );


                    renderProducts();

                }
            );

        }



        /* ========================================================
           CATEGORY BUTTONS
        ======================================================== */

        categoryButtons.forEach(
            function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        const category =
                            button.dataset.category;


                        if (categoryFilter) {

                            categoryFilter.value =
                                category;

                        }


                        syncCategoryButtons(
                            category
                        );


                        renderProducts();

                    }
                );

            }
        );



        function syncCategoryButtons(
            category
        ) {

            categoryButtons.forEach(
                function (button) {

                    button.classList.toggle(
                        'active',
                        button.dataset.category ===
                            category
                    );

                }
            );

        }



        /* ========================================================
           SHOP NOW
        ======================================================== */

        if (shopNowButton) {

            shopNowButton.addEventListener(
                'click',
                function () {

                    if (productsSection) {

                        productsSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                    }

                }
            );

        }



        /* ========================================================
           ESCAPE KEY
        ======================================================== */

        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key !==
                    'Escape'
                ) {

                    return;

                }


                closeModal();

                closeCartDrawer();


                if (profileWrapper) {

                    profileWrapper.classList.remove(
                        'open'
                    );

                }

            }
        );



        /* ========================================================
           TOAST
        ======================================================== */

        let toastTimer = null;


        function showToast(
            message
        ) {

            if (!toast) {
                return;
            }


            toast.textContent =
                message;


            toast.classList.add(
                'show'
            );


            clearTimeout(
                toastTimer
            );


            toastTimer =
                setTimeout(
                    function () {

                        toast.classList.remove(
                            'show'
                        );

                    },
                    2500
                );

        }



        /* ========================================================
           INITIALIZE
        ======================================================== */

        renderProducts();

        updateCart();

    }
);
