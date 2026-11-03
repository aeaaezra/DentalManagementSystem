<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout | Shine & Smile</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: #fff8fb;
            color: #29232b;
            font-family: Inter, Arial, sans-serif;
        }
        header {
            background: white;
            border-bottom: 1px solid #f0e4eb;
            padding: 20px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }
        header a { color: #d91d73; text-decoration: none; font-weight: 700; }
        .brand { font-size: 21px; font-weight: 800; color: #ec3189; }
        main { max-width: 1000px; margin: 35px auto; padding: 0 18px; }
        h1 { margin-bottom: 8px; }
        .intro { color: #817783; margin-top: 0; }
        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(280px, .8fr);
            gap: 22px;
            margin-top: 25px;
        }
        .panel {
            background: white;
            border: 1px solid #f0e4eb;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 8px 25px #d928790a;
        }
        h2 { font-size: 18px; margin-top: 0; }
        label { display: block; font-weight: 700; font-size: 13px; margin: 17px 0 7px; }
        input, textarea, select {
            width: 100%;
            border: 1px solid #e5d8e0;
            border-radius: 9px;
            padding: 12px;
            font: inherit;
            background: white;
        }
        textarea { min-height: 95px; resize: vertical; }
        .btn {
            display: block;
            width: 100%;
            border: 0;
            border-radius: 10px;
            background: #ec3189;
            color: white;
            padding: 14px;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            margin-top: 20px;
        }
        .btn:disabled { opacity: .55; cursor: not-allowed; }
        .item {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            padding: 13px 0;
            border-bottom: 1px solid #f3eaf0;
            font-size: 14px;
        }
        .muted { color: #817783; font-size: 12px; margin-top: 5px; }
        .total {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: 800;
            margin-top: 20px;
        }
        #message {
            display: none;
            margin-top: 15px;
            padding: 12px;
            border-radius: 9px;
            background: #fff0f0;
            color: #a11;
            overflow-wrap: anywhere;
        }
        .empty { color: #817783; line-height: 1.6; }
        @media (max-width: 700px) {
            .layout { grid-template-columns: 1fr; }
            header { padding: 16px 5%; }
            .panel { padding: 19px; }
        }
    </style>
</head>
<body>
<header>
    <a class="brand" href="{{ route('customer.products') }}">♡ Shine & Smile</a>
    <a href="{{ route('customer.cart') }}">← Back to Cart</a>
</header>

<main>
    <h1>Checkout</h1>
    <p class="intro">Confirm your delivery details and review your order.</p>

    <div class="layout">
        <section class="panel">
            <h2>Delivery and Payment</h2>

            <form id="checkoutForm">
                <label for="customer_name">Full Name</label>
                <input id="customer_name" name="customer_name"
                       type="text" maxlength="255" required
                       value="{{ old('customer_name', auth()->user()->name ?? '') }}"
                       autocomplete="name">

                <label for="contact_number">Contact Number</label>
                <input id="contact_number" name="contact_number"
                       type="tel" maxlength="30" required
                       value="{{ old('contact_number', auth()->user()->phone ?? '') }}"
                       autocomplete="tel">

                <label>Province</label>
                <input type="text" value="South Cotabato, Philippines" readonly>

                <label for="delivery_city">City / Municipality</label>
                <select id="delivery_city" required>
                    <option value="">Loading cities and municipalities...</option>
                </select>

                <label for="delivery_barangay">Barangay</label>
                <select id="delivery_barangay" required disabled>
                    <option value="">Select a city / municipality first</option>
                </select>

                <label for="delivery_street">House No. / Building / Street / Subdivision</label>
                <textarea id="delivery_street" maxlength="1000" required
                          autocomplete="street-address"
                          placeholder="Enter house number, street, building, or subdivision"></textarea>

                <input type="hidden" id="delivery_address" name="delivery_address">

                <label for="payment_method">Payment Method</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="cod">Cash on Delivery (COD)</option>
                    <option value="gcash">GCash</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="card">Card</option>
                </select>
                <p class="muted">Selecting an electronic payment method records your payment as pending; it does not process a payment.</p>

                <label for="notes">Order Notes (optional)</label>
                <textarea id="notes" name="notes" maxlength="2000"
                          placeholder="Delivery instructions or other notes"></textarea>

                <div id="message" role="alert"></div>
                <button class="btn" id="placeOrder" type="submit">Place Order</button>
            </form>
        </section>

        <aside class="panel">
            <h2>Your Order</h2>
            <div id="orderItems"></div>
            <div class="total">
                <span>Estimated Total</span>
                <span id="orderTotal">₱0.00</span>
            </div>
            <p class="muted">Final prices and stock are verified by the server when you place your order. Delivery fee is currently ₱0.00.</p>
        </aside>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cartKey = 'shineSmileCart';
    const selectionStorageKey = 'shineSmileCheckoutSelection';

    function getCartItemKey(item) {
        return String(item.cart_key || (String(item.id) + ':' + String(item.variant_id || 0)));
    }

    function readSelectedCart(allItems) {
        try {
            const saved = JSON.parse(localStorage.getItem(selectionStorageKey) || 'null');
            if (Array.isArray(saved)) {
                const keys = saved.map(String);
                return allItems.filter(item => keys.includes(getCartItemKey(item)));
            }
        } catch (error) {}
        // Compatibility: if no selection was saved, check out the whole cart.
        return allItems;
    }
    const itemsElement = document.getElementById('orderItems');
    const totalElement = document.getElementById('orderTotal');
    const form = document.getElementById('checkoutForm');
    const button = document.getElementById('placeOrder');
    const message = document.getElementById('message');

    const citySelect = document.getElementById('delivery_city');
    const barangaySelect = document.getElementById('delivery_barangay');
    const streetInput = document.getElementById('delivery_street');
    const addressInput = document.getElementById('delivery_address');
    const psgcBase = 'https://psgc.cloud/api/v2';

    async function loadAddressOptions(url, select, placeholder) {
        select.disabled = true;
        select.innerHTML = '<option value="">Loading...</option>';

        try {
            const response = await fetch(url, {
                headers: { 'Accept': 'application/json' }
            });
            if (!response.ok) throw new Error('Address service returned HTTP ' + response.status);

            const result = await response.json();
            const rows = Array.isArray(result.data) ? result.data : [];

            select.innerHTML = '<option value="">' + placeholder + '</option>';

            rows.sort((a, b) => a.name.trim().localeCompare(b.name.trim()));

            rows.forEach(function (row) {
                const option = document.createElement('option');
                option.value = row.code;
                option.textContent = row.name.trim();
                select.appendChild(option);
            });

            select.disabled = false;

            if (!rows.length) {
                select.innerHTML = '<option value="">No locations available</option>';
                select.disabled = true;
            }
        } catch (error) {
            select.innerHTML = '<option value="">Unable to load locations; refresh and try again</option>';
            select.disabled = true;
            console.error('Address loading error:', error);
        }
    }

    function updateDeliveryAddress() {
        const city = citySelect.options[citySelect.selectedIndex];
        const barangay = barangaySelect.options[barangaySelect.selectedIndex];
        const street = streetInput.value.trim();

        const parts = [
            street,
            barangay && barangay.value ? barangay.textContent : '',
            city && city.value ? city.textContent : '',
            'South Cotabato',
            'Philippines'
        ].filter(Boolean);

        addressInput.value = parts.join(', ');
    }

    loadAddressOptions(
        psgcBase + '/provinces/1206300000/cities-municipalities',
        citySelect,
        'Select city / municipality'
    );

    citySelect.addEventListener('change', function () {
        barangaySelect.innerHTML = '<option value="">Select barangay</option>';
        barangaySelect.disabled = true;

        if (citySelect.value) {
            loadAddressOptions(
                psgcBase + '/cities-municipalities/' +
                    encodeURIComponent(citySelect.value) + '/barangays',
                barangaySelect,
                'Select barangay'
            );
        }

        updateDeliveryAddress();
    });

    barangaySelect.addEventListener('change', updateDeliveryAddress);
    streetInput.addEventListener('input', updateDeliveryAddress);

    function readCart() {
        try {
            const value = JSON.parse(localStorage.getItem(cartKey) || '[]');
            return Array.isArray(value) ? value : [];
        } catch (e) {
            return [];
        }
    }

    function money(value) {
        return '₱' + Number(value || 0).toLocaleString('en-PH', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function escapeHtml(value) {
        return String(value).replace(/[&<>"']/g, function (char) {
            return {
                '&': '&amp;', '<': '&lt;', '>': '&gt;',
                '"': '&quot;', "'": '&#039;'
            }[char];
        });
    }

    function renderCart() {
        const cart = readSelectedCart(readCart());

        if (!cart.length) {
            itemsElement.innerHTML =
                '<p class="empty">Your cart is empty. Return to the products page to add items before checkout.</p>';
            totalElement.textContent = money(0);
            button.disabled = true;
            return;
        }

        let total = 0;
        itemsElement.innerHTML = cart.map(function (item) {
            const quantity = Number(item.quantity);
            const price = Number(item.price);
            const subtotal = price * quantity;
            total += subtotal;

            return '<div class="item"><div><strong>' +
                escapeHtml(item.name || 'Product') +
                '</strong>' +
                (item.variant_name
                    ? '<div class="muted">Option: ' + escapeHtml(item.variant_name) + '</div>'
                    : '') +
                '<div class="muted">Quantity: ' +
                quantity + '</div></div><strong>' +
                money(subtotal) + '</strong></div>';
        }).join('');

        totalElement.textContent = money(total);
        button.disabled = false;
    }

    function showMessage(text) {
        message.textContent = text;
        message.style.display = 'block';
    }

    form.addEventListener('submit', async function (event) {
        event.preventDefault();
        message.style.display = 'none';

        const allCartItems = readCart();
        const cart = readSelectedCart(allCartItems);

        if (!cart.length) {
            showMessage('No items are selected for checkout. Return to your cart and select items.');
            renderCart();
            return;
        }

        const items = cart.map(function (item) {
            const rawVariantId = item.variant_id;
            return {
                product_id: Number(item.id),
                variant_id: rawVariantId === undefined ||
                    rawVariantId === null || rawVariantId === ''
                    ? null
                    : Number(rawVariantId),
                quantity: Number(item.quantity)
            };
        });

        if (items.some(item =>
            !Number.isInteger(item.product_id) || item.product_id <= 0 ||
            (item.variant_id !== null &&
                (!Number.isInteger(item.variant_id) || item.variant_id <= 0)) ||
            !Number.isInteger(item.quantity) || item.quantity < 1
        )) {
            showMessage('Your cart contains invalid item data. Please clear your cart and add the products again.');
            return;
        }

        button.disabled = true;
        button.textContent = 'Submitting Order...';

        try {
            const response = await fetch(@json(route('customer.orders.store')), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    items: items,
                    payment_method: document.getElementById('payment_method').value,
                    delivery_address: document.getElementById('delivery_address').value.trim(),
                    customer_name: document.getElementById('customer_name').value.trim(),
                    contact_number: document.getElementById('contact_number').value.trim(),
                    notes: document.getElementById('notes').value.trim()
                })
            });

            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                let errorText = data.message || 'Unable to submit your order.';
                if (data.errors) {
                    errorText = Object.values(data.errors).flat().join(' ');
                }
                throw new Error(errorText);
            }

            if (!data.success) {
                throw new Error(data.message || 'The order was not confirmed.');
            }

            const submittedKeys = new Set(cart.map(getCartItemKey));
            const remainingItems = allCartItems.filter(item =>
                !submittedKeys.has(getCartItemKey(item))
            );

            localStorage.setItem(cartKey, JSON.stringify(remainingItems));
            localStorage.removeItem(selectionStorageKey);
            window.location.href = data.redirect || @json(route('customer.orders'));
        } catch (error) {
            showMessage(error.message || 'A network error occurred. Please try again.');
            button.disabled = false;
            button.textContent = 'Place Order';
        }
    });

    renderCart();
});
</script>
</body>
</html>
