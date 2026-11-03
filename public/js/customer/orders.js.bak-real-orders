document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       SAMPLE ORDERS

       This structure is ready to be replaced by Laravel
       database data.
    ============================================================ */

    let orders = [
        {
            id: 1,

            order_number:
                'ORD-20260818-001',

            date:
                'August 18, 2026',

            status:
                'pending',

            payment:
                'Cash',

            delivery:
                'Pickup at Clinic',

            total:
                420,

            items: [

                {
                    name:
                        'Premium Toothbrush',

                    quantity:
                        2,

                    price:
                        120,

                    icon:
                        '🪥'
                },

                {
                    name:
                        'Whitening Toothpaste',

                    quantity:
                        1,

                    price:
                        180,

                    icon:
                        '🦷'
                }
            ]
        }
    ];


    /* ============================================================
       ELEMENTS
    ============================================================ */

    const ordersList =
        document.getElementById(
            'ordersList'
        );

    const ordersEmpty =
        document.getElementById(
            'ordersEmpty'
        );

    const searchInput =
        document.getElementById(
            'orderSearch'
        );

    const tabs =
        document.querySelectorAll(
            '.order-tab'
        );


    /* ============================================================
       STATISTICS
    ============================================================ */

    const totalOrders =
        document.getElementById(
            'totalOrders'
        );

    const pendingOrders =
        document.getElementById(
            'pendingOrders'
        );

    const processingOrders =
        document.getElementById(
            'processingOrders'
        );

    const completedOrders =
        document.getElementById(
            'completedOrders'
        );


    /* ============================================================
       MODAL
    ============================================================ */

    const modal =
        document.getElementById(
            'orderModal'
        );

    const closeModal =
        document.getElementById(
            'closeOrderModal'
        );

    const modalOrderNumber =
        document.getElementById(
            'modalOrderNumber'
        );

    const modalOrderStatus =
        document.getElementById(
            'modalOrderStatus'
        );

    const modalOrderItems =
        document.getElementById(
            'modalOrderItems'
        );

    const modalOrderTotal =
        document.getElementById(
            'modalOrderTotal'
        );

    const modalOrderDate =
        document.getElementById(
            'modalOrderDate'
        );

    const modalPaymentMethod =
        document.getElementById(
            'modalPaymentMethod'
        );

    const modalDelivery =
        document.getElementById(
            'modalDelivery'
        );


    /* ============================================================
       FILTER
    ============================================================ */

    let currentStatus =
        'all';


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
       UPDATE STATISTICS
    ============================================================ */

    function updateStatistics() {

        const pending =
            orders.filter(
                function (order) {

                    return order.status
                        === 'pending';

                }
            ).length;


        const processing =
            orders.filter(
                function (order) {

                    return order.status
                        === 'processing';

                }
            ).length;


        const completed =
            orders.filter(
                function (order) {

                    return order.status
                        === 'completed';

                }
            ).length;


        totalOrders.textContent =
            orders.length;

        pendingOrders.textContent =
            pending;

        processingOrders.textContent =
            processing;

        completedOrders.textContent =
            completed;
    }


    /* ============================================================
       STATUS LABEL
    ============================================================ */

    function statusLabel(status) {

        const labels = {

            pending:
                'Pending',

            processing:
                'Processing',

            completed:
                'Completed',

            cancelled:
                'Cancelled'
        };


        return labels[status]
            || status;
    }


    /* ============================================================
       RENDER ORDERS
    ============================================================ */

    function renderOrders() {

        const searchTerm =
            searchInput
                ? searchInput.value
                    .trim()
                    .toLowerCase()
                : '';


        const filteredOrders =
            orders.filter(
                function (order) {

                    const matchesStatus =
                        currentStatus
                        === 'all'
                        ||
                        order.status
                        === currentStatus;


                    const matchesSearch =
                        !searchTerm
                        ||
                        order.order_number
                            .toLowerCase()
                            .includes(
                                searchTerm
                            );


                    return (
                        matchesStatus
                        &&
                        matchesSearch
                    );
                }
            );


        if (
            filteredOrders.length
            === 0
        ) {

            ordersList.innerHTML = '';

            ordersEmpty.style.display =
                'block';

            return;
        }


        ordersEmpty.style.display =
            'none';


        ordersList.innerHTML =
            filteredOrders
                .map(
                    renderOrderCard
                )
                .join('');
    }


    /* ============================================================
       RENDER ORDER CARD
    ============================================================ */

    function renderOrderCard(order) {

        const itemCount =
            order.items.reduce(
                function (
                    total,
                    item
                ) {

                    return total
                        + Number(item.quantity);

                },
                0
            );


        const itemsHtml =
            order.items
                .slice(0, 3)
                .map(
                    function (item) {

                        const subtotal =
                            Number(item.price)
                            *
                            Number(item.quantity);


                        return `
                            <div class="order-product">

                                <div class="order-product-icon">
                                    ${item.icon || '🦷'}
                                </div>


                                <div class="order-product-info">

                                    <strong>
                                        ${item.name}
                                    </strong>

                                    <span>
                                        Qty: ${item.quantity}
                                    </span>

                                </div>


                                <span class="order-product-price">
                                    ${formatMoney(subtotal)}
                                </span>

                            </div>
                        `;
                    }
                )
                .join('');


        return `
            <article class="order-card">


                <div class="order-card-header">

                    <div>

                        <span class="order-number">
                            ${order.order_number}
                        </span>

                        <span class="order-date">
                            ${order.date}
                        </span>

                    </div>


                    <span
                        class="order-status ${order.status}"
                    >
                        ${statusLabel(order.status)}
                    </span>

                </div>



                <div class="order-products">

                    ${itemsHtml}

                </div>



                <div class="order-card-footer">

                    <span class="order-items-count">

                        ${itemCount}

                        item${itemCount === 1 ? '' : 's'}

                    </span>


                    <div class="order-total">

                        <span>
                            Total
                        </span>

                        <strong>
                            ${formatMoney(order.total)}
                        </strong>

                    </div>


                    <button
                        type="button"
                        class="view-order-button"
                        data-order-id="${order.id}"
                    >
                        View Details
                    </button>

                </div>

            </article>
        `;
    }


    /* ============================================================
       OPEN ORDER MODAL
    ============================================================ */

    function openOrderModal(orderId) {

        const order =
            orders.find(
                function (item) {

                    return Number(item.id)
                        === Number(orderId);

                }
            );


        if (!order) {
            return;
        }


        modalOrderNumber.textContent =
            order.order_number;


        modalOrderStatus.textContent =
            statusLabel(
                order.status
            );


        modalOrderDate.textContent =
            order.date;


        modalPaymentMethod.textContent =
            order.payment;


        modalDelivery.textContent =
            order.delivery;


        modalOrderTotal.textContent =
            formatMoney(
                order.total
            );


        modalOrderItems.innerHTML =
            order.items
                .map(
                    function (item) {

                        const subtotal =
                            Number(item.price)
                            *
                            Number(item.quantity);


                        return `
                            <div class="modal-item">

                                <div class="modal-item-icon">
                                    ${item.icon || '🦷'}
                                </div>


                                <div class="modal-item-info">

                                    <strong>
                                        ${item.name}
                                    </strong>

                                    <span>
                                        ${item.quantity}
                                        ×
                                        ${formatMoney(item.price)}
                                    </span>

                                </div>


                                <strong class="modal-item-price">
                                    ${formatMoney(subtotal)}
                                </strong>

                            </div>
                        `;
                    }
                )
                .join('');


        modal.classList.add(
            'show'
        );


        document.body.style.overflow =
            'hidden';
    }


    /* ============================================================
       CLOSE MODAL
    ============================================================ */

    function closeOrderModal() {

        modal.classList.remove(
            'show'
        );


        document.body.style.overflow =
            '';
    }


    /* ============================================================
       ORDER CARD CLICK
    ============================================================ */

    ordersList.addEventListener(
        'click',
        function (event) {

            const button =
                event.target.closest(
                    '.view-order-button'
                );


            if (!button) {
                return;
            }


            openOrderModal(
                button.dataset.orderId
            );
        }
    );


    /* ============================================================
       STATUS TABS
    ============================================================ */

    tabs.forEach(
        function (tab) {

            tab.addEventListener(
                'click',
                function () {

                    currentStatus =
                        tab.dataset.status;


                    tabs.forEach(
                        function (button) {

                            button.classList.remove(
                                'active'
                            );

                        }
                    );


                    tab.classList.add(
                        'active'
                    );


                    renderOrders();
                }
            );
        }
    );


    /* ============================================================
       SEARCH
    ============================================================ */

    if (searchInput) {

        searchInput.addEventListener(
            'input',
            renderOrders
        );
    }


    /* ============================================================
       CLOSE MODAL
    ============================================================ */

    closeModal.addEventListener(
        'click',
        closeOrderModal
    );


    modal.addEventListener(
        'click',
        function (event) {

            if (
                event.target
                === modal
            ) {

                closeOrderModal();
            }
        }
    );


    /* ============================================================
       ESC KEY
    ============================================================ */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key
                === 'Escape'
            ) {

                closeOrderModal();
            }
        }
    );


    /* ============================================================
       INITIALIZE
    ============================================================ */

    updateStatistics();

    renderOrders();

});
