<!DOCTYPE html>
<html>
<head>
    <title>POS System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">

<div class="grid grid-cols-3 h-screen">

    <!-- 🛍️ PRODUCT AREA -->
    <div class="col-span-2 p-4 overflow-y-auto">
        <h2 class="text-2xl font-bold mb-4">Products</h2>

        <div class="grid grid-cols-4 gap-4">

        @foreach($products as $product)
            <button type="button"
                onclick="addToCart($product)"
                class="bg-white rounded shadow cursor-pointer hover:scale-105 transition p-2 text-left">

                <img src="{{ asset('storage/' . $product->image) }}"
                    class="w-full h-32 object-cover rounded">

                <div class="mt-2 text-center">
                    <h3 class="font-bold">{{ $product->name }}</h3>
                    <p class="text-green-600">₱{{ $product->price }}</p>
                </div>

            </button>
        @endforeach
        </div>
    </div>

    <!-- 🧾 CART AREA -->
    <div class="bg-white p-4 flex flex-col">
        <h2 class="text-xl font-bold mb-4">Cart</h2>

        <div id="cart-list" class="flex-1 overflow-y-auto"></div>

        <div class="border-t pt-4">
            <h3 class="text-lg font-bold">
                Total: ₱<span id="total">0</span>
            </h3>

            <form method="POST" action="/pos/checkout">
                @csrf
                <input type="hidden" name="cart" id="cart-input">

                <button class="bg-green-500 text-white w-full mt-4 p-3 rounded">
                    Checkout
                </button>
            </form>
        </div>
    </div>

</div>

<script>
let cart = [];

function addToCart(product) {
    let existing = cart.find(item => item.id === product.id);

    if (existing) {
        existing.quantity++;
    } else {
        cart.push({...product, quantity: 1});
    }

    renderCart();
}

function renderCart() {
    let list = document.getElementById('cart-list');
    let total = 0;

    list.innerHTML = '';

    cart.forEach((item, index) => {
        total += item.price * item.quantity;

        list.innerHTML += `
            <div class="flex justify-between items-center mb-2">
                <div>
                    <p class="font-bold">${item.name}</p>
                    <p>₱${item.price} x ${item.quantity}</p>
                </div>

                <button onclick="removeItem(${index})"
                    class="text-red-500">X</button>
            </div>
        `;
    });

    document.getElementById('total').innerText = total;
    document.getElementById('cart-input').value = JSON.stringify(cart);
}

function removeItem(index) {
    cart.splice(index, 1);
    renderCart();
}
</script>

</body>
</html>
