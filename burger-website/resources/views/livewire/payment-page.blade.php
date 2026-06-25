{{-- FILE: resources/views/livewire/payment-page.blade.php --}}
<div>
    <div class="max-w-lg mx-auto px-4 py-8">
        {{-- ═══════ HEADER ═══════ --}}
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <span class="text-3xl">💳</span>
            </div>
            <h1 class="text-2xl font-poppins font-bold text-gray-800">Pembayaran</h1>
        </div>

        {{-- ═══════ INFO PESANAN ═══════ --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 mb-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider font-medium">Nomor Pesanan</p>
                    <p class="text-lg font-bold text-orange-500 font-poppins mt-0.5">{{ $order->order_number }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400 uppercase tracking-wider font-medium">Total</p>
                    <p class="text-2xl font-bold text-gray-800 font-poppins mt-0.5">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- ═══════ QRIS ═══════ --}}
        @if($order->payment_method === 'qris')
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-4">
                <h2 class="font-poppins font-bold text-center mb-4 flex items-center justify-center gap-2">
                    <span>📱</span> Scan QRIS
                </h2>
                <div class="bg-gray-100 w-52 h-52 mx-auto rounded-2xl flex flex-col items-center justify-center border-2 border-dashed border-gray-300">
                    <svg class="w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                    <p class="text-xs text-gray-400 mt-2">QR Code</p>
                </div>
                <p class="text-sm text-gray-500 mt-4 text-center">Scan kode QR di atas menggunakan aplikasi e-wallet atau mobile banking Anda.</p>
            </div>

        {{-- ═══════ TRANSFER ═══════ --}}
        @elseif($order->payment_method === 'transfer')
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-4">
                <h2 class="font-poppins font-bold mb-4 flex items-center gap-2">
                    <span>🏦</span> Transfer Bank
                </h2>
                <div class="bg-blue-50 rounded-xl p-4 border border-blue-100" x-data="{ copied: false }">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-blue-400 font-medium uppercase tracking-wider">Bank BCA</p>
                            <p class="text-2xl font-bold text-gray-800 font-poppins mt-1 tracking-wider">1234567890</p>
                            <p class="text-sm text-gray-600 mt-1">a.n. <span class="font-semibold">Burger Kebab MAN</span></p>
                        </div>
                        <button @click="navigator.clipboard.writeText('1234567890'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="px-4 py-2 rounded-xl text-sm font-semibold transition-all"
                                :class="copied ? 'bg-green-500 text-white' : 'bg-white text-blue-600 hover:bg-blue-100 border border-blue-200'">
                            <span x-show="!copied">📋 Salin</span>
                            <span x-show="copied">✓ Tersalin!</span>
                        </button>
                    </div>
                </div>
                <div class="mt-4 p-3 bg-yellow-50 rounded-xl border border-yellow-100">
                    <p class="text-xs text-yellow-700 flex items-start gap-2">
                        <span class="text-sm">⚠️</span>
                        Transfer sesuai total di atas. Jangan lupa upload bukti pembayaran.
                    </p>
                </div>
            </div>

        {{-- ═══════ COD ═══════ --}}
        @else
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-4 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <span class="text-3xl">💵</span>
                </div>
                <h2 class="font-poppins font-bold text-lg">Bayar di Tempat (COD)</h2>
                <p class="text-sm text-gray-500 mt-2">Siapkan uang pas saat pesanan Anda tiba.</p>
            </div>
        @endif

        {{-- ═══════ UPLOAD BUKTI ═══════ --}}
        @if($order->payment_method !== 'cod')
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-4">
                <h2 class="font-poppins font-bold mb-4 flex items-center gap-2">
                    <span>📸</span> Upload Bukti Pembayaran
                </h2>
                <form wire:submit="uploadProof">
                    <div x-data="{ isDragging: false }"
                         @dragover.prevent="isDragging = true"
                         @dragleave.prevent="isDragging = false"
                         @drop.prevent="isDragging = false; $wire.upload('paymentProof', $event.dataTransfer.files[0])"
                         class="border-2 border-dashed rounded-2xl p-8 text-center transition-all duration-200 cursor-pointer"
                         :class="isDragging ? 'border-orange-500 bg-orange-50' : 'border-gray-200 hover:border-orange-300 hover:bg-orange-50/30'"
                         @click="$refs.fileInput.click()">
                        <input type="file" wire:model="paymentProof" accept="image/*" class="hidden" x-ref="fileInput">
                        <svg class="w-10 h-10 text-gray-400 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm text-gray-500">Tarik & lepas foto bukti transfer</p>
                        <p class="text-xs text-gray-400 mt-1">atau klik untuk memilih file</p>
                    </div>
                    @error('paymentProof') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror

                    {{-- Preview --}}
                    @if($paymentProof)
                        <div class="mt-4 flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                            <img src="{{ $paymentProof->temporaryUrl() }}" alt="Preview" class="h-20 rounded-lg shadow-sm">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-700">Bukti siap diupload</p>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                                    <div class="bg-orange-500 h-1.5 rounded-full transition-all duration-300"
                                         wire:loading.class="w-1/2" wire:loading.remove.class="w-full"
                                         style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <button type="submit"
                            class="mt-4 w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-bold transition-all shadow-md hover:shadow-lg active:scale-[0.98] disabled:opacity-50 flex items-center justify-center gap-2"
                            wire:loading.attr="disabled"
                            {{ !$paymentProof ? 'disabled' : '' }}>
                        <span wire:loading.remove>📤 Upload Bukti</span>
                        <span wire:loading class="flex items-center gap-2">
                            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            Mengupload...
                        </span>
                    </button>
                </form>
            </div>
        @endif

        {{-- ═══════ SUCCESS MESSAGE ═══════ --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-2xl text-center mb-4 flex items-center justify-center gap-2">
                <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- ═══════ NAVIGASI ═══════ --}}
        <div class="flex gap-3">
            <a href="/order-status/{{ $order->order_number }}" wire:navigate
               class="flex-1 px-4 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl text-center font-semibold transition shadow-md text-sm">
                📦 Cek Status
            </a>
            <a href="/" wire:navigate
               class="px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-center font-semibold transition text-sm">
                🏠 Menu
            </a>
        </div>
    </div>
</div>