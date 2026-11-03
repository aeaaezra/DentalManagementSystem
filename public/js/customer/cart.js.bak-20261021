document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       CART
    ============================================================ */

    let cart = JSON.parse(
        localStorage.getItem('shineSmileCart')
    ) || [];


    /* ============================================================
       ELEMENTS
    ============================================================ */

    const cartItems =
        document.getElementById('cartItems');

    const emptyCart =
        document.getElementById('emptyCart');

    const cartItemCount =
        document.getElementById('cartItemCount');

    const subtotalElement =
        document.getElementById('subtotal');

    const deliveryElement =
        document.getElementById('delivery');

    const totalElement =
        document.getElementById('total');

    const headerCartCount =
        document.getElementById(
            'headerCartCount'
        );

    const checkoutButton =
        document.getElementById(
            'checkoutButton'
        );

    const clearCartButton =
        document.getElementById(
            'clearCart'
        );

    const toast =
        document.getElementById('toast');


    /* ============================================================
       DELIVERY FEE
    ============================================================ */

    const DELIVERY_FEE = 0;


    /* ============================================================
       FORMAT MONEY
    ============================================================ */

    function formatMoney(amount) {

        return '₱' +
            Number(amount || 0)
                .toLocaleString(
                    'en-PH',
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }
                );
    }


    /* ============================================================
       SAVE CART
    ============================================================ */

    function saveCart() {

        localStorage.setItem(
            'shineSmileCart',
            JSON.stringify(cart)
        );
    }


    /* ============================================================
       TOAST
    ============================================================ */

    function showToast(message) {

        if (!toast) {
            return;
        }


        toast.textContent =
            message;


        toast.classList.add(
            'show'
        );


        setTimeout(function () {

            toast.classList.remove(
                'show'
            );

        }, 2500);
    }


    /* ============================================================
       UPDATE CART
    ============================================================ */

    function updateCart() {

        const totalItems =
            cart.reduce(
                function (sum, item) {

                    return sum
                        + Number(item.quantity);

                },
                0
            );


        const subtotal =
            cart.reduce(
                function (sum, item) {

                    return sum
                        + (
                            Number(item.price)
                            *
                            Number(item.quantity)
                        );

                },
                0
            );


        const total =
            subtotal
            + DELIVERY_FEE;


        if (cartItemCount) {

            cartItemCount.textContent =
                totalItems
                + ' item'
                + (
                    totalItems === 1
                        ? ''
                        : 's'
                );
        }


        if (headerCartCount) {

            headerCartCount.textContent =
                totalItems;
        }


        if (subtotalElement) {

            subtotalElement.textContent =
                formatMoney(subtotal);
        }


        if (deliveryElement) {

            deliveryElement.textContent =
                formatMoney(DELIVERY_FEE);
        }


        if (totalElement) {

            totalElement.textContent =
                formatMoney(total);
        }


        if (checkoutButton) {

            checkoutButton.disabled =
                cart.length === 0;
        }


        renderCartItems();

        saveCart();
    }


    /* ============================================================
       RENDER CART ITEMS
    ============================================================ */

    function renderCartItems() {

        if (!cartItems) {
            return;
        }


        if (cart.length === 0) {

            cartItems.innerHTML = '';

            if (emptyCart) {

                emptyCart.style.display =
                    'block';
            }

            return;
        }


        if (emptyCart) {

            emptyCart.style.display =
                'none';
        }


        cartItems.innerHTML =
            cart.map(function (item) {

                const subtotal =
                    Number(item.price)
                    *
                    Number(item.quantity);


                return `
                    <div
                        class="cart-item"
                        data-id="${item.id}"
                    >

                        <div class="cart-item-image">
                            ${item.icon || '🦷'}
                        </div>


                        <div class="cart-item-details">

                            <span class="cart-item-category">
                                ${item.category || 'Dental'}
                            </span>


                            <h4>
                                ${item.name}
                            </h4>


                            <p>
                                ${item.description || 'Dental care product'}
                            </p>


                            <span class="cart-item-price">
                                ${formatMoney(item.price)}
                            </span>

                        </div>


                        <div class="cart-item-actions">

                            <div class="quantity-control">

                                <button
                                    type="button"
                                    class="quantity-minus"
                                    data-id="${item.id}"
                                >
                                    −
                                </button>


                                <span>
                                    ${item.quantity}
                                </span>


                                <button
                                    type="button"
                                    class="quantity-plus"
                                    data-id="${item.id}"
                                >
                                    +
                                </button>

                            </div>


                            <strong class="item-subtotal">
                                ${formatMoney(subtotal)}
                            </strong>


                            <button
                                type="button"
                                class="remove-item"
                                data-id="${item.id}"
                            >
                                Remove
                            </button>

                        </div>

                    </div>
                `;

            }).join('');
    }


    /* ============================================================
       CHANGE QUANTITY
    ============================================================ */

    function changeQuantity(
        productId,
        change
    ) {

        const item =
            cart.find(function (cartItem) {

                return String(cartItem.id)
                    === String(productId);

            });


        if (!item) {
            return;
        }


        const newQuantity =
            Number(item.quantity)
            + change;


        if (newQuantity <= 0) {

            removeItem(productId);

            return;
        }


        if (
            item.stock
            &&
            newQuantity > item.stock
        ) {

            showToast(
                'You have reached the available stock.'
            );

            return;
        }


        item.quantity =
            newQuantity;


        updateCart();
    }


    /* ============================================================
       REMOVE ITEM
    ============================================================ */

    function removeItem(productId) {

        cart =
            cart.filter(function (item) {

                return String(item.id)
                    !== String(productId);

            });


        updateCart();

        showToast(
            'Product removed from cart.'
        );
    }


    /* ============================================================
       CLEAR CART
    ============================================================ */

    if (clearCartButton) {

        clearCartButton.addEventListener(
            'click',
            function () {

                if (cart.length === 0) {
                    return;
                }


                const confirmed =
                    confirm(
                        'Are you sure you want to clear your cart?'
                    );


                if (!confirmed) {
                    return;
                }


                cart = [];


                updateCart();


                showToast(
                    'Cart cleared.'
                );
            }
        );
    }


    /* ============================================================
       CART ITEM ACTIONS
    ============================================================ */

    if (cartItems) {

        cartItems.addEventListener(
            'click',
            function (event) {

                const minus =
                    event.target.closest(
                        '.quantity-minus'
                    );


                const plus =
                    event.target.closest(
                        '.quantity-plus'
                    );


                const remove =
                    event.target.closest(
                        '.remove-item'
                    );


                if (minus) {

                    changeQuantity(
                        minus.dataset.id,
                        -1
                    );

                    return;
                }


                if (plus) {

                    changeQuantity(
                        plus.dataset.id,
                        1
                    );

                    return;
                }


                if (remove) {

                    removeItem(
                        remove.dataset.id
                    );
                }
            }
        );
    }


    /* ============================================================
       CHECKOUT
    ============================================================ */

    if (checkoutButton) {

        checkoutButton.addEventListener(
            'click',
            function () {

                if (cart.length === 0) {

                    showToast(
                        'Your cart is empty.'
                    );

                    return;
                }


                /*
                 * Change this route to your actual
                 * checkout route when you create it.
                 */

                window.location.href =
                    '/orders/checkout';
            }
        );
    }


    /* ============================================================
       INITIALIZE
    ============================================================ */

    updateCart();

});
