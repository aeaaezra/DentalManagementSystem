document.addEventListener('DOMContentLoaded', function () {

    // =========================================================
    // DATA FROM LARAVEL
    // =========================================================

    const products = Array.isArray(window.POS_PRODUCTS)
        ? window.POS_PRODUCTS
        : [];

    const checkoutUrl = window.POS_CHECKOUT_URL;

    let cart = [];
    let selectedCategory = 'All';
    let selectedPaymentMethod = 'Cash';
    let discountPercent = 0;


    // =========================================================
    // ELEMENTS
    // =========================================================

    const productGrid = document.getElementById('product-grid');
    const searchInput = document.getElementById('search-input');
    const barcodeInput = document.getElementById('barcode-input');

    const cartItemsContainer =
        document.getElementById('cart-items-container');

    const cartItemCount =
        document.getElementById('cart-item-count');

    const subtotalAmount =
        document.getElementById('subtotal-amount');

    const discountAmount =
        document.getElementById('discount-amount');

    const discountLabel =
        document.getElementById('discount-label');

    const taxAmount =
        document.getElementById('tax-amount');

    const grandTotal =
        document.getElementById('grand-total');

    const btnTotal =
        document.getElementById('btn-total');

    const checkoutBtn =
        document.getElementById('checkout-btn');

    const checkoutModal =
        document.getElementById('checkout-modal');

    const modalTotal =
        document.getElementById('modal-total');

    const modalPaymentMethod =
        document.getElementById('modal-payment-method');

    const cashTenderedInput =
        document.getElementById('cash-tendered-input');

    const changeAmount =
        document.getElementById('change-amount');

    const confirmPaymentBtn =
        document.getElementById('confirm-payment-btn');

    const cashTenderedSection =
        document.getElementById('cash-tendered-section');


    // =========================================================
    // MONEY FORMAT
    // =========================================================

    function formatMoney(amount) {

        return '₱' + Number(amount || 0).toLocaleString('en-PH', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

    }


    // =========================================================
    // IMAGE URL
    // =========================================================

    function getProductImage(product) {

        if (!product.image) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Images saved by ProductsController
        |--------------------------------------------------------------------------
        */

        if (product.image.startsWith('images/')) {
            return '/' + product.image;
        }

        /*
        |--------------------------------------------------------------------------
        | Images saved by Filament FileUpload
        |--------------------------------------------------------------------------
        */

        if (product.image.startsWith('products/')) {
            return '/storage/' + product.image;
        }

        return '/' + product.image;
    }


    // =========================================================
    // RENDER PRODUCTS
    // =========================================================

    function renderProducts() {

        if (!productGrid) {
            return;
        }

        const searchTerm =
            (searchInput?.value || '').toLowerCase().trim();

        let filteredProducts = products.filter(product => {

            const matchesCategory =
                selectedCategory === 'All' ||
                product.category === selectedCategory;

            const matchesSearch =
                !searchTerm ||
                (product.product_name || '')
                    .toLowerCase()
                    .includes(searchTerm) ||

                (product.sku || '')
                    .toLowerCase()
                    .includes(searchTerm);

            return matchesCategory && matchesSearch;
        });


        if (filteredProducts.length === 0) {

            productGrid.innerHTML = `
                <div class="col-span-full flex flex-col
                            items-center justify-center
                            py-20 text-gray-400">

                    <i class="fa-solid fa-box-open text-5xl mb-4"></i>

                    <p class="font-semibold">
                        No products found
                    </p>

                    <p class="text-sm mt-1">
                        Try another search or category.
                    </p>

                </div>
            `;

            return;
        }


        productGrid.innerHTML = filteredProducts.map(product => {

            const price = Number(product.selling_price || 0);
            const quantity = Number(product.quantity || 0);
            const image = getProductImage(product);

            const outOfStock = quantity <= 0;


            return `
                <div
                    class="product-card bg-white
                           dark:bg-[#251C22]
                           border border-pink-100
                           dark:border-pink-900/30
                           rounded-2xl overflow-hidden
                           shadow-sm hover:shadow-lg
                           transition cursor-pointer
                           ${outOfStock ? 'opacity-60' : ''}"
                    data-product-id="${product.id}"
                >

                    <!-- IMAGE -->

                    <div class="h-32 bg-pink-50
                                dark:bg-pink-950/20
                                flex items-center justify-center">

                        ${
                            image
                            ?
                            `
                            <img
                                src="${image}"
                                alt="${escapeHtml(product.product_name)}"
                                class="w-full h-full object-contain p-3"
                                onerror="this.style.display='none';
                                this.nextElementSibling.style.display='flex';"
                            >

                            <div
                                class="hidden w-full h-full
                                       items-center justify-center
                                       text-pink-300"
                            >
                                <i class="fa-solid fa-tooth text-4xl"></i>
                            </div>
                            `
                            :
                            `
                            <i class="fa-solid fa-tooth
                                      text-4xl text-pink-300"></i>
                            `
                        }

                    </div>


                    <!-- INFO -->

                    <div class="p-3">

                        <p class="text-[10px]
                                  text-gray-400
                                  uppercase tracking-wide">
                            ${escapeHtml(product.category || 'Product')}
                        </p>

                        <h3 class="font-semibold text-sm
                                   mt-1 line-clamp-2">
                            ${escapeHtml(product.product_name)}
                        </h3>

                        <p class="text-[10px]
                                  text-gray-400 mt-1">
                            SKU: ${escapeHtml(product.sku || '-')}
                        </p>


                        <div class="flex items-center
                                    justify-between mt-3">

                            <span class="font-bold
                                         text-primary">
                                ${formatMoney(price)}
                            </span>

                            <span class="text-[10px]
                                         ${
                                            quantity > 0
                                            ? 'text-emerald-500'
                                            : 'text-red-500'
                                         }">
                                ${
                                    quantity > 0
                                    ? quantity + ' ' + (product.unit || 'pcs')
                                    : 'Out of stock'
                                }
                            </span>

                        </div>


                        <button
                            type="button"
                            class="add-product-btn
                                   w-full mt-3 py-2
                                   rounded-xl
                                   bg-pink-50
                                   dark:bg-pink-950/30
                                   text-primary
                                   text-xs font-bold
                                   hover:bg-primary
                                   hover:text-white
                                   transition
                                   ${outOfStock
                                        ? 'opacity-50 cursor-not-allowed'
                                        : ''}"
                            data-id="${product.id}"
                            ${outOfStock ? 'disabled' : ''}
                        >
                            <i class="fa-solid fa-cart-plus mr-1"></i>
                            Add to Cart
                        </button>

                    </div>

                </div>
            `;

        }).join('');

    }


    // =========================================================
    // ESCAPE HTML
    // =========================================================

    function escapeHtml(value) {

        const div = document.createElement('div');

        div.textContent = value ?? '';

        return div.innerHTML;

    }


    // =========================================================
    // ADD PRODUCT TO CART
    // =========================================================

    function addToCart(productId) {

        const product =
            products.find(p => Number(p.id) === Number(productId));

        if (!product) {
            return;
        }


        const stock = Number(product.quantity || 0);

        if (stock <= 0) {

            alert('This product is out of stock.');

            return;
        }


        const existingItem =
            cart.find(item =>
                Number(item.id) === Number(product.id)
            );


        if (existingItem) {

            if (existingItem.qty >= stock) {

                alert('You cannot add more than the available stock.');

                return;
            }

            existingItem.qty++;

        } else {

            cart.push({
                id: product.id,
                product_name: product.product_name,
                sku: product.sku,
                price: Number(product.selling_price || 0),
                qty: 1,
                stock: stock
            });

        }


        renderCart();

    }


    // =========================================================
    // REMOVE FROM CART
    // =========================================================

    function removeFromCart(productId) {

        cart =
            cart.filter(item =>
                Number(item.id) !== Number(productId)
            );

        renderCart();

    }


    // =========================================================
    // CHANGE QUANTITY
    // =========================================================

    function changeQuantity(productId, change) {

        const item =
            cart.find(item =>
                Number(item.id) === Number(productId)
            );

        if (!item) {
            return;
        }


        const newQuantity =
            item.qty + change;


        if (newQuantity <= 0) {

            removeFromCart(productId);

            return;
        }


        if (newQuantity > item.stock) {

            alert('Not enough stock available.');

            return;
        }


        item.qty = newQuantity;

        renderCart();

    }


    // =========================================================
    // RENDER CART
    // =========================================================

    function renderCart() {

        if (!cartItemsContainer) {
            return;
        }


        if (cart.length === 0) {

            cartItemsContainer.innerHTML = `
                <div class="h-full flex flex-col
                            items-center justify-center
                            text-gray-400">

                    <i class="fa-solid fa-cart-shopping
                              text-4xl mb-3"></i>

                    <p class="text-sm font-semibold">
                        Your cart is empty
                    </p>

                    <p class="text-xs mt-1">
                        Select a product to begin.
                    </p>

                </div>
            `;

        } else {

            cartItemsContainer.innerHTML =
                cart.map(item => {

                    const subtotal =
                        item.price * item.qty;

                    return `
                        <div
                            class="bg-pink-50/60
                                   dark:bg-pink-950/20
                                   border border-pink-100
                                   dark:border-pink-900/30
                                   rounded-2xl p-3"
                        >

                            <div class="flex
                                        justify-between
                                        gap-2">

                                <div class="min-w-0">

                                    <h4 class="font-semibold
                                               text-sm
                                               truncate">
                                        ${escapeHtml(item.product_name)}
                                    </h4>

                                    <p class="text-[10px]
                                              text-gray-400">
                                        ${escapeHtml(item.sku || '')}
                                    </p>

                                </div>

                                <button
                                    type="button"
                                    class="remove-cart-btn
                                           text-red-400
                                           hover:text-red-600"
                                    data-id="${item.id}"
                                >
                                    <i class="fa-solid
                                              fa-trash-can"></i>
                                </button>

                            </div>


                            <div class="flex items-center
                                        justify-between mt-3">

                                <div class="flex items-center
                                            gap-2">

                                    <button
                                        type="button"
                                        class="quantity-btn
                                               w-7 h-7
                                               rounded-lg
                                               bg-white
                                               dark:bg-[#251C22]
                                               border
                                               border-pink-200
                                               text-primary"
                                        data-id="${item.id}"
                                        data-change="-1"
                                    >
                                        −
                                    </button>

                                    <span class="font-bold
                                                 text-sm
                                                 w-6 text-center">
                                        ${item.qty}
                                    </span>

                                    <button
                                        type="button"
                                        class="quantity-btn
                                               w-7 h-7
                                               rounded-lg
                                               bg-white
                                               dark:bg-[#251C22]
                                               border
                                               border-pink-200
                                               text-primary"
                                        data-id="${item.id}"
                                        data-change="1"
                                    >
                                        +
                                    </button>

                                </div>


                                <div class="text-right">

                                    <p class="text-xs text-gray-400">
                                        ${formatMoney(item.price)}
                                    </p>

                                    <p class="font-bold
                                              text-primary">
                                        ${formatMoney(subtotal)}
                                    </p>

                                </div>

                            </div>

                        </div>
                    `;

                }).join('');

        }


        updateTotals();

    }


    // =========================================================
    // TOTALS
    // =========================================================

    function updateTotals() {

        const subtotal =
            cart.reduce(
                (total, item) =>
                    total + (item.price * item.qty),
                0
            );


        const discount =
            subtotal * (discountPercent / 100);


        const taxableAmount =
            subtotal - discount;


        const tax =
            taxableAmount * 0.08;


        const total =
            taxableAmount + tax;


        if (subtotalAmount)
            subtotalAmount.textContent =
                formatMoney(subtotal);


        if (discountAmount)
            discountAmount.textContent =
                '-' + formatMoney(discount);


        if (discountLabel)
            discountLabel.textContent =
                discountPercent + '%';


        if (taxAmount)
            taxAmount.textContent =
                formatMoney(tax);


        if (grandTotal)
            grandTotal.textContent =
                formatMoney(total);


        if (btnTotal)
            btnTotal.textContent =
                total.toFixed(2);


        if (cartItemCount) {

            const count =
                cart.reduce(
                    (total, item) =>
                        total + item.qty,
                    0
                );

            cartItemCount.textContent =
                `${count} item${count !== 1 ? 's' : ''} selected`;

        }


        if (checkoutBtn) {

            checkoutBtn.disabled =
                cart.length === 0;

        }


        if (modalTotal) {

            modalTotal.textContent =
                formatMoney(total);

        }

    }


    // =========================================================
    // GET TOTAL
    // =========================================================

    function getCartTotal() {

        const subtotal =
            cart.reduce(
                (total, item) =>
                    total + item.price * item.qty,
                0
            );

        const discount =
            subtotal * (discountPercent / 100);

        const taxable =
            subtotal - discount;

        const tax =
            taxable * 0.08;

        return taxable + tax;

    }


    // =========================================================
    // CATEGORY BUTTONS
    // =========================================================

    document
        .querySelectorAll('.category-btn')
        .forEach(button => {

            button.addEventListener('click', function () {

                selectedCategory =
                    this.dataset.category;

                document
                    .querySelectorAll('.category-btn')
                    .forEach(btn => {

                        btn.classList.remove(
                            'active-category',
                            'bg-primary',
                            'text-white'
                        );

                    });


                this.classList.add(
                    'active-category',
                    'bg-primary',
                    'text-white'
                );


                renderProducts();

            });

        });


    // =========================================================
    // SEARCH
    // =========================================================

    if (searchInput) {

        searchInput.addEventListener(
            'input',
            renderProducts
        );

    }


    // =========================================================
    // BARCODE
    // =========================================================

    if (barcodeInput) {

        barcodeInput.addEventListener(
            'keydown',
            function (event) {

                if (event.key !== 'Enter') {
                    return;
                }

                const barcode =
                    this.value.trim().toLowerCase();

                if (!barcode) {
                    return;
                }


                const product =
                    products.find(product =>
                        String(product.sku || '')
                            .toLowerCase() === barcode
                    );


                if (!product) {

                    alert(
                        'Product with SKU "' +
                        barcode +
                        '" was not found.'
                    );

                    this.value = '';

                    return;
                }


                addToCart(product.id);

                this.value = '';

            }
        );

    }


    // =========================================================
    // PRODUCT GRID CLICK
    // =========================================================

    if (productGrid) {

        productGrid.addEventListener(
            'click',
            function (event) {

                const button =
                    event.target.closest(
                        '.add-product-btn'
                    );

                if (!button) {
                    return;
                }


                addToCart(button.dataset.id);

            }
        );

    }


    // =========================================================
    // CART CLICK
    // =========================================================

    if (cartItemsContainer) {

        cartItemsContainer.addEventListener(
            'click',
            function (event) {

                const removeButton =
                    event.target.closest(
                        '.remove-cart-btn'
                    );

                if (removeButton) {

                    removeFromCart(
                        removeButton.dataset.id
                    );

                    return;
                }


                const quantityButton =
                    event.target.closest(
                        '.quantity-btn'
                    );

                if (quantityButton) {

                    changeQuantity(
                        quantityButton.dataset.id,
                        Number(
                            quantityButton.dataset.change
                        )
                    );

                }

            }
        );

    }


    // =========================================================
    // CLEAR CART
    // =========================================================

    const clearCartBtn =
        document.getElementById('clear-cart-btn');

    if (clearCartBtn) {

        clearCartBtn.addEventListener(
            'click',
            function () {

                if (cart.length === 0) {
                    return;
                }


                if (confirm('Clear the current order?')) {

                    cart = [];

                    renderCart();

                }

            }
        );

    }


    // =========================================================
    // DISCOUNT
    // =========================================================

    const applyDiscountBtn =
        document.getElementById('apply-discount-btn');

    const discountCode =
        document.getElementById('discount-code');


    if (applyDiscountBtn) {

        applyDiscountBtn.addEventListener(
            'click',
            function () {

                const code =
                    discountCode.value
                        .trim()
                        .toUpperCase();


                if (!code) {

                    discountPercent = 0;

                    updateTotals();

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Example coupon
                |--------------------------------------------------------------------------
                */

                if (code === 'PROMO10') {

                    discountPercent = 10;

                    alert('10% discount applied.');

                } else if (code === 'PROMO20') {

                    discountPercent = 20;

                    alert('20% discount applied.');

                } else {

                    discountPercent = 0;

                    alert('Invalid coupon code.');

                }


                updateTotals();

            }
        );

    }


    // =========================================================
    // PAYMENT METHOD
    // =========================================================

    document
        .querySelectorAll('.payment-method-btn')
        .forEach(button => {

            button.addEventListener(
                'click',
                function () {

                    selectedPaymentMethod =
                        this.dataset.payment;


                    document
                        .querySelectorAll(
                            '.payment-method-btn'
                        )
                        .forEach(btn => {

                            btn.classList.remove(
                                'selected'
                            );

                        });


                    this.classList.add('selected');


                    if (modalPaymentMethod) {

                        modalPaymentMethod.textContent =
                            selectedPaymentMethod;

                    }


                    if (selectedPaymentMethod === 'Cash') {

                        cashTenderedSection.style.display =
                            'block';

                    } else {

                        cashTenderedSection.style.display =
                            'none';

                    }

                }
            );

        });


    // =========================================================
    // OPEN CHECKOUT MODAL
    // =========================================================

    if (checkoutBtn) {

        checkoutBtn.addEventListener(
            'click',
            function () {

                if (cart.length === 0) {
                    return;
                }


                updateTotals();


                if (modalPaymentMethod) {

                    modalPaymentMethod.textContent =
                        selectedPaymentMethod;

                }


                if (selectedPaymentMethod === 'Cash') {

                    cashTenderedSection.style.display =
                        'block';

                } else {

                    cashTenderedSection.style.display =
                        'none';

                }


                checkoutModal.classList.remove('hidden');

                setTimeout(() => {

                    checkoutModal.classList.remove(
                        'opacity-0'
                    );

                }, 10);

            }
        );

    }


    // =========================================================
    // CLOSE CHECKOUT MODAL
    // =========================================================

    const closeCheckoutBtn =
        document.getElementById('close-checkout-btn');


    if (closeCheckoutBtn) {

        closeCheckoutBtn.addEventListener(
            'click',
            closeCheckoutModal
        );

    }


    function closeCheckoutModal() {

        checkoutModal.classList.add('opacity-0');

        setTimeout(() => {

            checkoutModal.classList.add('hidden');

        }, 300);

    }


    // =========================================================
    // QUICK CASH
    // =========================================================

    document
        .querySelectorAll('.quick-cash')
        .forEach(button => {

            button.addEventListener(
                'click',
                function () {

                    cashTenderedInput.value =
                        this.dataset.amount;

                    updateChange();

                }
            );

        });


    // =========================================================
    // CASH CHANGE
    // =========================================================

    if (cashTenderedInput) {

        cashTenderedInput.addEventListener(
            'input',
            updateChange
        );

    }


    function updateChange() {

        const total =
            getCartTotal();

        const cash =
            Number(cashTenderedInput.value || 0);

        const change =
            Math.max(0, cash - total);


        if (changeAmount) {

            changeAmount.textContent =
                formatMoney(change);

        }

    }


    // =========================================================
    // CONFIRM PAYMENT
    // =========================================================

    if (confirmPaymentBtn) {

        confirmPaymentBtn.addEventListener(
            'click',
            processCheckout
        );

    }


    async function processCheckout() {

        if (cart.length === 0) {
            return;
        }


        const total =
            getCartTotal();


        let cashReceived;


        if (selectedPaymentMethod === 'Cash') {

            cashReceived =
                Number(
                    cashTenderedInput.value || 0
                );


            if (cashReceived < total) {

                alert(
                    'Insufficient payment.\
                    \nRequired: ' +
                    formatMoney(total)
                );

                return;
            }

        } else {

            /*
            |--------------------------------------------------------------------------
            | For GCash/Card, we send the total as received.
            |--------------------------------------------------------------------------
            */

            cashReceived = total;

        }


        confirmPaymentBtn.disabled = true;

        confirmPaymentBtn.innerHTML = `
            <i class="fa-solid fa-spinner
                      fa-spin mr-2"></i>
            Processing...
        `;


        try {

            const response =
                await fetch(
                    checkoutUrl,
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type':
                                'application/json',

                            'Accept':
                                'application/json',

                            'X-CSRF-TOKEN':
                                document
                                    .querySelector(
                                        'meta[name="csrf-token"]'
                                    )
                                    ?.getAttribute('content')
                        },

                        body: JSON.stringify({

                            cart: cart.map(item => ({
                                id: item.id,
                                qty: item.qty
                            })),

                            total: total,

                            cash_received:
                                cashReceived,

                            payment_method:
                                selectedPaymentMethod

                        })

                    }
                );


            const data =
                await response.json();


            if (!response.ok || !data.success) {

                throw new Error(
                    data.error ||
                    'Checkout failed.'
                );

            }


            alert(
                'Sale completed successfully!\n\n' +
                'Invoice: ' +
                data.invoice_no
            );


            /*
            |--------------------------------------------------------------------------
            | Reset cart
            |--------------------------------------------------------------------------
            */

            cart = [];

            discountPercent = 0;

            if (discountCode) {
                discountCode.value = '';
            }

            if (cashTenderedInput) {
                cashTenderedInput.value = '';
            }


            renderCart();

            closeCheckoutModal();


            /*
            |--------------------------------------------------------------------------
            | Reload products because quantity changed
            |--------------------------------------------------------------------------
            */

            window.location.reload();


        } catch (error) {

            console.error(error);

            alert(
                'Checkout failed:\n' +
                error.message
            );

        } finally {

            confirmPaymentBtn.disabled = false;

            confirmPaymentBtn.innerHTML = `
                <i class="fa-solid fa-check mr-2"></i>
                Confirm Payment
            `;

        }

    }


    // =========================================================
    // DARK MODE
    // =========================================================

    window.toggleDarkMode = function () {

        document.documentElement.classList.toggle('dark');

        const isDark =
            document.documentElement.classList.contains('dark');


        localStorage.setItem(
            'pos-dark-mode',
            isDark ? 'dark' : 'light'
        );


        const icon =
            document.getElementById('theme-icon');

        if (icon) {

            icon.className =
                isDark
                ? 'fa-solid fa-sun'
                : 'fa-solid fa-moon';

        }

    };


    // =========================================================
    // LOAD DARK MODE
    // =========================================================

    if (
        localStorage.getItem('pos-dark-mode') === 'dark'
    ) {

        document.documentElement.classList.add('dark');

        const icon =
            document.getElementById('theme-icon');

        if (icon) {

            icon.className =
                'fa-solid fa-sun';

        }

    }


    // =========================================================
    // LOGOUT MODAL
    // =========================================================

    window.openLogoutModal = function () {

        const modal =
            document.getElementById('logout-modal');

        if (!modal) {
            return;
        }

        modal.classList.remove('hidden');

        modal.classList.add('flex');

    };


    const cancelLogoutBtn =
        document.getElementById('cancel-logout-btn');


    if (cancelLogoutBtn) {

        cancelLogoutBtn.addEventListener(
            'click',
            function () {

                const modal =
                    document.getElementById('logout-modal');

                modal.classList.add('hidden');

                modal.classList.remove('flex');

            }
        );

    }


    // =========================================================
    // INITIAL RENDER
    // =========================================================

    console.log(
        'POS products loaded:',
        products
    );

    renderProducts();

    renderCart();

});



    function updateDateTime() {
        const now = new Date();

        // Date
        const dateOptions = {
            weekday: 'short',
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        };

        const currentDate = now.toLocaleDateString('en-PH', dateOptions);

        // Time
        const timeOptions = {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        };

        const currentTime = now.toLocaleTimeString('en-PH', timeOptions);

        // Update HTML
        document.getElementById('current-date').textContent = currentDate;
        document.getElementById('current-time').textContent = currentTime;
    }

    // Run immediately
    updateDateTime();

    // Update every second
    setInterval(updateDateTime, 1000);



    document.addEventListener('DOMContentLoaded', function () {

    const cashierButton = document.getElementById('cashier-button');
    const cashierMenu = document.getElementById('cashier-menu');
    const cashierArrow = document.getElementById('cashier-arrow');

    const profileOption = document.getElementById('profile-option');
    const settingsOption = document.getElementById('settings-option');


    /*
    |--------------------------------------------------------------------------
    | Toggle Cashier Dropdown
    |--------------------------------------------------------------------------
    */

    if (cashierButton) {

        cashierButton.addEventListener('click', function (event) {

            event.stopPropagation();

            cashierMenu.classList.toggle('hidden');

            cashierArrow.classList.toggle('rotate-180');

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    if (profileOption) {

        profileOption.addEventListener('click', function () {

            cashierMenu.classList.add('hidden');

            cashierArrow.classList.remove('rotate-180');

            window.location.href = "{{ route('profile.edit') }}";

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */

    if (settingsOption) {

        settingsOption.addEventListener('click', function () {

            cashierMenu.classList.add('hidden');

            cashierArrow.classList.remove('rotate-180');

            window.location.href = "{{ url('/settings') }}";

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Close Dropdown When Clicking Outside
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function (event) {

        const cashierDropdown =
            document.getElementById('cashier-dropdown');

        if (
            cashierDropdown &&
            !cashierDropdown.contains(event.target)
        ) {

            cashierMenu.classList.add('hidden');

            cashierArrow.classList.remove('rotate-180');

        }

    });

});
fetch(deleteUrl, {
    method: "DELETE",
    headers: {
        "X-CSRF-TOKEN": csrfToken,
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest"
    }
})
