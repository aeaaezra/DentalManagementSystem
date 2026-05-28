<x-filament::page>
<div class="grid grid-cols-3 gap-6">

    <!-- 🛍️ PRODUCTS -->
    <div class="col-span-2">
        <div class="grid grid-cols-3 gap-4">
            @foreach($this->products as $product)
                <div class="p-4 bg-white rounded-xl shadow cursor-pointer hover:shadow-lg"
                    wire:click="addToCart({{ $product->id }})">

                    <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-500">₱{{ $product->price }}</p>

                    <span class="text-xs px-2 py-1 rounded
                        {{ $product->stock > 5 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        Stock: {{ $product->stock }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 🧾 CART -->
    <div class="bg-white p-4 rounded-xl shadow flex flex-col">

        <h2 class="text-xl font-bold mb-4">Cart</h2>

        <div class="flex-1 space-y-2 overflow-auto">
            @foreach($this->cart as $id => $item)
                <div class="flex justify-between items-center border-b pb-2">
                    <div>
                        <p class="font-semibold">{{ $item['name'] }}</p>
                        <p class="text-sm">₱{{ $item['price'] }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <button wire:click="updateQty({{ $id }}, 'decrease')" class="px-2 bg-gray-200">-</button>
                        <span>{{ $item['qty'] }}</span>
                        <button wire:click="updateQty({{ $id }}, 'increase')" class="px-2 bg-gray-200">+</button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 💰 TOTAL -->
        <div class="mt-4 border-t pt-4">
            <p class="text-lg font-bold">Total: ₱{{ $this->total }}</p>

            <select wire:model="payment_method" class="w-full mt-2 border rounded p-2">
                <option value="cash">Cash</option>
                <option value="gcash">GCash</option>
            </select>

            <input type="number" wire:model="amount_paid"
                placeholder="Amount Paid"
                class="w-full mt-2 border rounded p-2">

            <p class="mt-2">Change: ₱{{ $this->change }}</p>

            <button wire:click="checkout"
                    class="w-full mt-4 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                Complete Sale
            </button>
        </div>

    </div>
</div>
</x-filament::page>
