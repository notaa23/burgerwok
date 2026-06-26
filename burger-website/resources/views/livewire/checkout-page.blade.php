<div>
    <div class="max-w-2xl mx-auto px-4 py-8">
        {{-- ═══════ PROGRESS STEPS ═══════ --}}
        <div class="flex items-center justify-center mb-8">
            {{-- Step 1 --}}
            <div class="flex items-center">
                <div class="flex items-center justify-center w-9 h-9 rounded-full bg-orange-500 text-white text-sm font-bold shadow-md">
                    ✓
                </div>
                <span class="ml-2 text-sm font-medium text-orange-600 hidden sm:block">Keranjang</span>
            </div>
            <div class="w-12 sm:w-20 h-0.5 bg-orange-500 mx-2"></div>
            {{-- Step 2 --}}
            <div class="flex items-center">
                <div class="flex items-center justify-center w-9 h-9 rounded-full bg-orange-500 text-white text-sm font-bold shadow-md ring-4 ring-orange-100">
                    2
                </div>
                <span class="ml-2 text-sm font-bold text-orange-600 hidden sm:block">Checkout</span>
            </div>
            <div class="w-12 sm:w-20 h-0.5 bg-gray-200 mx-2"></div>
            {{-- Step 3 --}}
            <div class="flex items-center">
                <div class="flex items-center justify-center w-9 h-9 rounded-full bg-gray-200 text-gray-400 text-sm font-bold">
                    3
                </div>
                <span class="ml-2 text-sm font-medium text-gray-400 hidden sm:block">Bayar</span>
            </div>
        </div>

        @if(!empty($items))
            <form wire:submit="placeOrder">
                {{-- ═══════ DATA DIRI ═══════ --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 mb-4">
                    <h2 class="font-poppins font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center text-sm">👤</span>
                        Data Pemesan
                    </h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama Lengkap</label>
                            <div class="relative">
                                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <input type="text" wire:model="name" placeholder="Nama kamu"
                                       class="w-full pl-10 pr-4 py-2.5 border-2 rounded-xl text-sm outline-none transition
                                              {{ $errors->has('name') ? 'border-red-300 focus:border-red-500 focus:ring-2 focus:ring-red-100' : 'border-gray-100 focus:border-orange-500 focus:ring-2 focus:ring-orange-100' }}">
                            </div>
                            @error('name') <p class="text-red-500 text-xs mt-1 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1.5">Nomor WhatsApp</label>
                            <div class="relative">
                                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                </svg>
                                <input type="text" wire:model="whatsapp" placeholder="08123456789"
                                       class="w-full pl-10 pr-4 py-2.5 border-2 rounded-xl text-sm outline-none transition
                                              {{ $errors->has('whatsapp') ? 'border-red-300 focus:border-red-500 focus:ring-2 focus:ring-red-100' : 'border-gray-100 focus:border-orange-500 focus:ring-2 focus:ring-orange-100' }}">
                            </div>
                            @error('whatsapp') <p class="text-red-500 text-xs mt-1 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- ═══════ METODE PEMBAYARAN ═══════ --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 mb-4">
                    <h2 class="font-poppins font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center text-sm">💳</span>
                        Metode Pembayaran
                    </h2>
                    <div class="grid grid-cols-1 gap-3">
                        {{-- QRIS --}}
                        <label class="cursor-pointer">
                            <input type="radio" wire:model="paymentMethod" value="qris" class="hidden peer">
                            <div class="border-2 border-gray-100 peer-checked:border-orange-500 peer-checked:bg-orange-50 rounded-2xl p-4 hover:border-orange-300 transition-all duration-200 group flex items-center gap-4">
                                <div class="text-3xl">📱</div>
                                <div>
                                    <p class="text-sm font-bold text-gray-700 group-hover:text-orange-600">QRIS</p>
                                    <p class="text-xs text-gray-400 mt-0.5">GoPay, OVO, DANA, ShopeePay, Mobile Banking</p>
                                </div>
                                <div class="text-sm font-bold text-gray-700 group-hover:text-orange-600">
                                    <div class="w-2.5 h-2.5 rounded-full bg-orange-500 hidden peer-checked:block"></div>
                                </div>
                            </div>
                        </label>
                        {{-- Transfer Bank --}}
                        <label class="cursor-pointer">
                            <input type="radio" wire:model="paymentMethod" value="transfer" class="hidden peer">
                            <div class="border-2 border-gray-100 peer-checked:border-orange-500 peer-checked:bg-orange-50 rounded-2xl p-4 hover:border-orange-300 transition-all duration-200 group flex items-center gap-4">
                                <div class="text-3xl">🏦</div>
                                <div>
                                    <p class="text-sm font-bold text-gray-700 group-hover:text-orange-600">Transfer Bank</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Transfer ke rekening yang tersedia</p>
                                </div>
                            </div>
                        </label>
                        {{-- COD --}}
                        <label class="cursor-pointer">
                            <input type="radio" wire:model="paymentMethod" value="cod" class="hidden peer">
                            <div class="border-2 border-gray-100 peer-checked:border-orange-500 peer-checked:bg-orange-50 rounded-2xl p-4 hover:border-orange-300 transition-all duration-200 group flex items-center gap-4">
                                <div class="text-3xl">💵</div>
                                <div>
                                    <p class="text-sm font-bold text-gray-700 group-hover:text-orange-600">Bayar di Tempat (COD)</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Siapkan uang pas saat ambil pesanan</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('paymentMethod') <p class="text-red-500 text-xs mt-2 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                </div>

                {{-- ═══════ CATATAN ═══════ --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">📝 Catatan (opsional)</label>
                    <textarea wire:model="notes" placeholder="Instruksi khusus..."
                              class="w-full px-4 py-2.5 border-2 border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-orange-100 focus:border-orange-500 outline-none transition resize-none" rows="2"></textarea>
                </div>

                {{-- ═══════ RINGKASAN PESANAN ═══════ --}}
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 mb-6">
                    <h2 class="font-poppins font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center text-sm">📋</span>
                        Ringkasan Pesanan
                    </h2>
                    <div class="space-y-2">
                        @foreach($items as $item)
                            <div class="flex justify-between text-sm py-1.5">
                                <span class="text-gray-600">{{ $item['name'] }} <span class="text-gray-400">(x{{ $item['qty'] }})</span></span>
                                <span class="font-medium text-gray-800">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t border-gray-100 mt-3 pt-3 flex justify-between items-center">
                        <span class="font-bold text-gray-800">Total</span>
                        <span class="text-2xl font-bold text-orange-500 font-poppins">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- ═══════ TOMBOL PESAN ═══════ --}}
                <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3.5 rounded-2xl font-bold text-lg transition-all shadow-lg hover:shadow-xl active:scale-[0.98] flex items-center justify-center gap-2 disabled:opacity-50"
                        wire:loading.attr="disabled">
                    <span wire:loading.remove>🛒 Pesan Sekarang</span>
                    <span wire:loading class="flex items-center gap-2">
                        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </form>
        @else
            {{-- Empty State --}}
            <div class="text-center py-20">
                <div class="text-7xl mb-4">🛒</div>
                <h3 class="text-xl font-poppins font-bold text-gray-700 mb-2">Keranjang Kosong</h3>
                <p class="text-gray-500 mb-6">Tambahkan menu dulu sebelum checkout.</p>
                <a href="/" wire:navigate class="inline-block px-6 py-3 bg-orange-500 text-white rounded-full font-semibold hover:bg-orange-600 transition shadow-md">
                    Lihat Menu
                </a>
            </div>
        @endif
    </div>
</div>