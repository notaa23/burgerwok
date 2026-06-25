<div>
    <div class="max-w-2xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-poppins font-bold text-gray-900 mb-6">📋 Checkout</h1>

        @if(!empty($items))
            <form wire:submit="placeOrder">
                <!-- Data Diri -->
                <div class="bg-white rounded-xl p-4 shadow-sm mb-4">
                    <h2 class="font-semibold text-gray-900 mb-3">Data Pemesan</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Nama</label>
                            <input type="text" wire:model="name" placeholder="Nama kamu" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 outline-none">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">WhatsApp</label>
                            <input type="text" wire:model="whatsapp" placeholder="08123456789" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 outline-none">
                            @error('whatsapp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Pembayaran -->
                <div class="bg-white rounded-xl p-4 shadow-sm mb-4">
                    <h2 class="font-semibold text-gray-900 mb-3">Metode Pembayaran</h2>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" wire:model="paymentMethod" value="qris" class="hidden peer">
                            <div class="border-2 border-gray-200 peer-checked:border-orange-500 rounded-lg p-3 text-center hover:border-orange-300 transition">
                                <p class="text-2xl mb-1">📱</p>
                                <p class="text-sm font-medium">QRIS</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" wire:model="paymentMethod" value="transfer" class="hidden peer">
                            <div class="border-2 border-gray-200 peer-checked:border-orange-500 rounded-lg p-3 text-center hover:border-orange-300 transition">
                                <p class="text-2xl mb-1">🏦</p>
                                <p class="text-sm font-medium">Transfer</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" wire:model="paymentMethod" value="cod" class="hidden peer">
                            <div class="border-2 border-gray-200 peer-checked:border-orange-500 rounded-lg p-3 text-center hover:border-orange-300 transition">
                                <p class="text-2xl mb-1">💵</p>
                                <p class="text-sm font-medium">COD</p>
                            </div>
                        </label>
                    </div>
                    @error('paymentMethod') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Catatan -->
                <div class="bg-white rounded-xl p-4 shadow-sm mb-4">
                    <label class="block text-sm text-gray-600 mb-1">Catatan (opsional)</label>
                    <textarea wire:model="notes" placeholder="Tambahan pedas, tanpa bawang, dll..." 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 outline-none" rows="2"></textarea>
                </div>

                <!-- Ringkasan -->
                <div class="bg-white rounded-xl p-4 shadow-sm mb-4">
                    <h2 class="font-semibold text-gray-900 mb-3">Ringkasan Pesanan</h2>
                    @foreach($items as $item)
                        <div class="flex justify-between text-sm py-1">
                            <span>{{ $item['name'] }} (x{{ $item['qty'] }})</span>
                            <span>Rp {{ number_format($item['price'] * $item['qty']) }}</span>
                        </div>
                    @endforeach
                    <div class="border-t mt-2 pt-2 flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span class="text-orange-500">Rp {{ number_format($total) }}</span>
                    </div>
                </div>

                <!-- Tombol -->
                <button type="submit" 
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-full font-bold text-lg transition shadow-md">
                    Pesan Sekarang
                </button>
            </form>
        @else
            <div class="text-center py-20">
                <p class="text-6xl mb-4">🛒</p>
                <p class="text-gray-500">Keranjang kosong.</p>
                <a href="/" class="inline-block mt-4 px-6 py-2 bg-orange-500 text-white rounded-full">Lihat Menu</a>
            </div>
        @endif
    </div>
</div>