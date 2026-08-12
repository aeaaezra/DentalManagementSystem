
let products = @json($products);
let cart = [];

// ✅ Render Products
function renderProducts() {
    let grid = document.getElementById('product-grid');
    if (!grid) return;

    let html = '';

    products.forEach(product => {
        html += `
            <div onclick="addToCart(${product.id})"
                class="bg-white p-3 rounded-xl shadow cursor-pointer hover:scale-105 transition">

                <h3 class="font-bold text-sm">${escapeHTML(product.name)}</h3>
                <p class="text-xs text-gray-500">Stock: ${product.stock}</p>
                <p class="text-primary font-bold">₱${product.price}</p>
            </div>
        `;
    });

    grid.innerHTML = html;
}

renderProducts();


// ✅ Add to Cart
function addToCart(id) {
    let product = products.find(p => p.id === id);

    if (!product) {
        console.error("Product not found:", id);
        return;
    }

    let existing = cart.find(item => item.id === id);

    // ✅ Stock check
    if (existing) {
        if (existing.qty >= product.stock) {
            alert("Not enough stock!");
            return;
        }
        existing.qty++;
    } else {
        if (product.stock <= 0) {
            alert("Out of stock!");
            return;
        }

        cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            qty: 1
        });
    }

    updateCartUI();
}


// ✅ Update Cart UI
function updateCartUI() {
    let container = document.getElementById('cart-items-container');
    if (!container) return;

    let total = 0;
    let html = '';

    cart.forEach(item => {
        total += item.price * item.qty;

        html += `
            <div class="flex justify-between text-sm">
                <span>${escapeHTML(item.name)} x${item.qty}</span>
                <span>₱${item.price * item.qty}</span>
            </div>
        `;
    });

    container.innerHTML = html;

    let grandTotal = document.getElementById('grand-total');
    let btnTotal = document.getElementById('btn-total');

    if (grandTotal) grandTotal.innerText = '₱' + total;
    if (btnTotal) btnTotal.innerText = total;
}


// ✅ Checkout
function completeTransaction() {

    if (cart.length === 0) {
        alert("Cart is empty!");
        return;
    }

    fetch("{{ route('pos.checkout') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            cart: cart,
            total: getTotal(),
            cash_received: getTotal()
        })
    })
    .then(res => {
        if (!res.ok) throw new Error("Server error");
        return res.json();
    })
    .then(data => {
        if (data.success) {
            alert("Transaction complete!");

            cart = [];
            updateCartUI();

            location.reload(); // refresh stock
        } else {
            alert(data.error || "Failed transaction");
        }
    })
    .catch(err => {
        console.error(err);
        alert("Something went wrong!");
    });
}


// ✅ Total
function getTotal() {
    return cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
}


// ✅ Prevent XSS
function escapeHTML(str) {
    return String(str).replace(/[&<>"']/g, function (m) {
        return {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        }[m];
    });
}
