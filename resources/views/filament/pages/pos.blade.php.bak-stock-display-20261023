<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

        <div class="md:col-span-8">
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($this->products as $product)
                    <button
                        wire:click="addToCart({{ $product->id }})"
                        class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:border-primary-500 transition text-left"
                    >
                        <div class="font-bold text-lg text-gray-900 dark:text-white">{{ $product->name }}</div>
                        <div class="text-primary-600 font-semibold">₱{{ number_format($product->price, 2) }}</div>
                        <div class="text-xs text-gray-500">Stock: {{ $product->stock }}</div>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="md:col-span-4">
            <x-filament::section>
                <x-slot name="heading">Current Order</x-slot>

                <div class="space-y-4 max-h-[400px] overflow-y-auto">
                    @forelse($cart as $id => $item)
                        <div class="flex justify-between items-center border-b pb-2 dark:border-gray-700">
                            <div>
                                <div class="font-medium">{{ $item['name'] }}</div>
                                <div class="text-sm text-gray-500">₱{{ $item['price'] }} x {{ $item['qty'] }}</div>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-filament::icon-button icon="heroicon-m-minus" size="sm" color="gray" wire:click="updateQty({{ $id }}, 'decrease')" />
                                <span class="font-bold">{{ $item['qty'] }}</span>
                                <x-filament::icon-button icon="heroicon-m-plus" size="sm" color="gray" wire:click="updateQty({{ $id }}, 'increase')" />
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-500">Cart is empty</div>
                    @endforelse
                </div>

                <div class="mt-6 space-y-2 border-t pt-4 dark:border-gray-700">
                    <div class="flex justify-between text-xl font-bold">
                        <span>Total:</span>
                        <span>₱{{ number_format($total, 2) }}</span>
                    </div>

                    <div class="pt-4">
                        <label class="text-sm font-medium">Amount Paid</label>
                        <x-filament::input.wrapper>
                            <x-filament::input
                                type="number"
                                step="0.01"
                                wire:model.live="amount_paid"
                            />
                        </x-filament::input.wrapper>
                    </div>

                    <div class="flex justify-between text-lg text-success-600 font-semibold pt-2">
                        <span>Change:</span>
                        <span>₱{{ number_format($change, 2) }}</span>
                    </div>

                    <x-filament::button
                        wire:click="checkout"
                        class="w-full mt-4"
                        size="xl"
                        color="primary"
                        :disabled="empty($cart) || $amount_paid < $total"
                    >
                        COMPLETE TRANSACTION
                    </x-filament::button>
                </div>
            </x-filament::section>
        </div>
    </div>
</x-filament-panels::page>
