{{-- FILE: resources/views/livewire/payment-page.blade.php --}}
<div>
    <div class="max-w-lg mx-auto px-4 py-8">

        {{-- ═══════ HEADER ═══════ --}}
        <div class="text-center mb-6">
            <div class="w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-3 shadow-xl"
                 style="background: linear-gradient(135deg, #ea580c, #dc2626); box-shadow: 0 12px 32px rgba(234,88,12,0.4);">
                <span class="text-4xl">💳</span>
            </div>
            <h1 class="text-2xl font-poppins font-black text-gray-900">Pembayaran</h1>
            <p class="text-gray-500 text-sm mt-1">Selesaikan pembayaran untuk memproses pesananmu</p>
        </div>

        {{-- ═══════ INFO PESANAN ═══════ --}}
        <div class="rounded-3xl p-5 mb-4 shadow-lg relative overflow-hidden"
             style="background: linear-gradient(135deg, #1c1917, #292524);">
            {{-- Decorative --}}
            <div class="absolute top-0 right-0 w-32 h-32 rounded-full opacity-10"
                 style="background: radial-gradient(circle, #f97316, transparent); transform: translate(30%, -30%);"></div>
            <div class="flex justify-between items-center relative z-10">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-orange-400 mb-1">Nomor Pesanan</p>
                    <p class="text-xl font-black text-white font-poppins">{{ $order->order_number }}</p>
                    <p class="text-xs text-gray-400 mt-1 capitalize">
                        {{ str_replace('_', ' ', $order->payment_method) }}
                        @if($order->payment_status === 'pending')
                            · <span class="text-yellow-400">⏳ Menunggu Pembayaran</span>
                        @elseif($order->payment_status === 'waiting_confirmation')
                            · <span class="text-blue-400">🔍 Menunggu Konfirmasi</span>
                        @elseif($order->payment_status === 'confirmed')
                            · <span class="text-green-400">✅ Terkonfirmasi</span>
                        @endif
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold uppercase tracking-widest text-orange-400 mb-1">Total</p>
                    <p class="text-3xl font-black text-white font-poppins">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- ═══════ MIDTRANS ═══════ --}}
        @if($order->payment_method === 'midtrans')
            <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100 mb-4 text-center">
                <h2 class="font-poppins font-black text-gray-900 mb-2 flex items-center justify-center gap-2 text-lg">
                    <span class="w-9 h-9 rounded-xl flex items-center justify-center text-sm"
                          style="background: linear-gradient(135deg, #7c3aed, #4f46e5);">💳</span>
                    Bayar Online
                </h2>
                <p class="text-gray-500 text-sm mb-6">Klik tombol di bawah ini untuk memunculkan pilihan pembayaran (QRIS, GoPay, Transfer Bank, dll)</p>
                
                @if($order->payment_status === 'pending' && $order->snap_token)
                    <button id="pay-button" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-2xl font-bold text-lg transition-all shadow-lg hover:shadow-xl active:scale-[0.98]">
                        Proses Pembayaran
                    </button>
                    
                    @php
                        $midtransScriptUrl = env('MIDTRANS_IS_PRODUCTION', false) ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js';
                    @endphp
                    <script src="{{ $midtransScriptUrl }}" data-client-key="{{ env('MIDTRANS_CLIENT_KEY', 'Mid-client-HjZjxhtw1VbJAGri') }}"></script>
                    <script>
                        document.getElementById('pay-button').onclick = function () {

                            snap.pay('{{ $order->snap_token }}', {
                                onSuccess: function (result) {
                                    window.location.href = '/order-status/{{ $order->order_number }}';
                                },
                                onPending: function (result) {
                                    window.location.href = '/order-status/{{ $order->order_number }}';
                                },
                                onError: function (result) {
                                    alert("Pembayaran gagal!");
                                },
                                onClose: function () {
                                    console.log('Customer closed the popup without finishing the payment');
                                }
                            });
                        };
                    </script>
                @elseif($order->payment_status === 'confirmed')
                    <div class="p-4 rounded-2xl text-center flex items-center justify-center gap-2" style="background: linear-gradient(135deg, #f0fdf4, #dcfce7); border: 1px solid #86efac;">
                        <span class="text-2xl">🎉</span>
                        <span class="font-bold text-green-800">Pembayaran telah berhasil!</span>
                    </div>
                @elseif($order->payment_status === 'pending' && !$order->snap_token)
                    <div class="p-4 rounded-2xl text-center mb-4 text-red-700 bg-red-50 border border-red-200">
                        <span class="text-2xl block mb-2">⚠️</span>
                        <span class="font-bold">Gagal terhubung ke server pembayaran.</span>
                        @if(session('error'))
                            <p class="text-sm mt-1">{{ session('error') }}</p>
                        @endif
                        <p class="text-xs text-red-500 mt-2">Pastikan konfigurasi API Key Midtrans Anda sudah benar di file .env.</p>
                    </div>
                @endif
            </div>

        {{-- ═══════ QRIS ═══════ --}}
        @elseif($order->payment_method === 'qris')
            <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100 mb-4">
                <h2 class="font-poppins font-black text-gray-900 text-center mb-5 flex items-center justify-center gap-2 text-lg">
                    <span class="w-9 h-9 rounded-xl flex items-center justify-center text-sm"
                          style="background: linear-gradient(135deg, #7c3aed, #4f46e5);">📱</span>
                    Scan QRIS
                </h2>
                {{-- QR Placeholder --}}
                <div class="w-56 h-56 mx-auto rounded-2xl flex flex-col items-center justify-center border-2 border-dashed border-gray-200 mb-4 relative"
                     style="background: linear-gradient(135deg, #f9fafb, #f3f4f6);">
                    {{-- QR Pattern decoration --}}
                    <div class="grid grid-cols-3 gap-1 opacity-30 mb-2">
                        @for($i = 0; $i < 9; $i++)
                        <div class="w-10 h-10 rounded" style="background: {{ $i % 2 == 0 ? '#1c1917' : '#d1d5db' }};"></div>
                        @endfor
                    </div>
                    <p class="text-xs text-gray-400 font-medium text-center px-4">Hubungi kasir untuk QR Code aktif</p>
                    <div class="absolute top-3 left-3 w-8 h-8 border-4 border-gray-800 rounded-sm" style="border-right: none; border-bottom: none;"></div>
                    <div class="absolute top-3 right-3 w-8 h-8 border-4 border-gray-800 rounded-sm" style="border-left: none; border-bottom: none;"></div>
                    <div class="absolute bottom-3 left-3 w-8 h-8 border-4 border-gray-800 rounded-sm" style="border-right: none; border-top: none;"></div>
                </div>
                <div class="p-3 rounded-2xl text-center" style="background: linear-gradient(135deg, #eff6ff, #dbeafe);">
                    <p class="text-sm text-blue-700 font-medium">
                        📲 Scan menggunakan aplikasi e-wallet atau mobile banking Anda
                    </p>
                </div>
            </div>

        {{-- ═══════ TRANSFER ═══════ --}}
        @elseif($order->payment_method === 'transfer')
            <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100 mb-4">
                <h2 class="font-poppins font-black text-gray-900 mb-5 flex items-center gap-2 text-lg">
                    <span class="w-9 h-9 rounded-xl flex items-center justify-center text-sm"
                          style="background: linear-gradient(135deg, #0284c7, #0369a1);">🏦</span>
                    Transfer Bank
                </h2>
                <div class="rounded-2xl p-4 border border-blue-100 mb-3" style="background: linear-gradient(135deg, #eff6ff, #f0f9ff);"
                     x-data="{ copied: false }">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-blue-500 mb-1">Bank BCA</p>
                            <p class="text-2xl font-black text-gray-900 font-poppins tracking-widest">1234567890</p>
                            <p class="text-sm text-gray-500 mt-1">a.n. <span class="font-bold text-gray-700">Burger Kebab MAN</span></p>
                        </div>
                        <button @click="navigator.clipboard.writeText('1234567890'); copied = true; setTimeout(() => copied = false, 2500)"
                                class="px-4 py-2.5 rounded-xl text-sm font-black transition-all duration-200 shadow-sm"
                                :class="copied ? 'bg-green-500 text-white shadow-green-200' : 'bg-white text-blue-600 hover:bg-blue-50 border-2 border-blue-200'">
                            <span x-show="!copied">📋 Salin</span>
                            <span x-show="copied">✅ Tersalin!</span>
                        </button>
                    </div>
                </div>
                <div class="p-3 rounded-2xl" style="background: linear-gradient(135deg, #fefce8, #fef9c3); border: 1px solid #fde68a;">
                    <p class="text-xs text-yellow-800 flex items-start gap-2">
                        <span class="text-base">⚠️</span>
                        Transfer tepat sesuai total tagihan. Jangan lupa upload bukti pembayaran di bawah.
                    </p>
                </div>
            </div>

        {{-- ═══════ COD ═══════ --}}
        @else
            <div class="rounded-3xl p-6 shadow-md mb-4 text-center relative overflow-hidden"
                 style="background: linear-gradient(135deg, #052e16, #14532d);">
                <div class="absolute top-0 right-0 w-40 h-40 rounded-full opacity-10"
                     style="background: radial-gradient(circle, #4ade80, transparent); transform: translate(30%, -30%);"></div>
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg relative z-10"
                     style="background: linear-gradient(135deg, #16a34a, #15803d);">
                    <span class="text-3xl">💵</span>
                </div>
                <h2 class="font-poppins font-black text-white text-xl relative z-10">Bayar di Tempat (COD)</h2>
                <p class="text-green-300 text-sm mt-2 relative z-10">Siapkan uang pas saat pesanan tiba ya! 🙏</p>
                <div class="mt-4 flex justify-center gap-4 relative z-10">
                    <div class="text-center">
                        <p class="text-green-400 font-black text-lg">✅</p>
                        <p class="text-green-300 text-xs">Pesanan Diterima</p>
                    </div>
                    <div class="w-px bg-green-700"></div>
                    <div class="text-center">
                        <p class="text-green-400 font-black text-lg">🚀</p>
                        <p class="text-green-300 text-xs">Sedang Diproses</p>
                    </div>
                    <div class="w-px bg-green-700"></div>
                    <div class="text-center">
                        <p class="text-green-400 font-black text-lg">💚</p>
                        <p class="text-green-300 text-xs">Bayar Saat Terima</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- ═══════ UPLOAD BUKTI (Hanya untuk manual) ═══════ --}}
        @if(in_array($order->payment_method, ['qris', 'transfer']))
            <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100 mb-4">
                <h2 class="font-poppins font-black text-gray-900 mb-5 flex items-center gap-2 text-lg">
                    <span class="w-9 h-9 rounded-xl flex items-center justify-center text-sm"
                          style="background: linear-gradient(135deg, #ea580c, #dc2626);">📸</span>
                    Upload Bukti Pembayaran
                </h2>
                <form wire:submit="uploadProof">
                    <div x-data="{ isDragging: false }"
                         @dragover.prevent="isDragging = true"
                         @dragleave.prevent="isDragging = false"
                         @drop.prevent="isDragging = false; $wire.upload('paymentProof', $event.dataTransfer.files[0])"
                         class="border-2 border-dashed rounded-2xl p-8 text-center transition-all duration-300 cursor-pointer"
                         :class="isDragging ? 'border-orange-500 bg-orange-50 scale-[1.02]' : 'border-gray-200 hover:border-orange-400 hover:bg-orange-50/30'"
                         @click="$refs.fileInput.click()">
                        <input type="file" wire:model="paymentProof" accept="image/*" class="hidden" x-ref="fileInput">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3"
                             style="background: linear-gradient(135deg, #fff7ed, #ffedd5);">
                            <svg class="w-7 h-7 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-gray-700">Drag & drop foto bukti transfer</p>
                        <p class="text-xs text-gray-400 mt-1">atau klik untuk memilih file · Max 2MB</p>
                    </div>
                    @error('paymentProof') <p class="text-red-500 text-xs mt-2 flex items-center gap-1">⚠️ {{ $message }}</p> @enderror

                    {{-- Preview --}}
                    @if($paymentProof)
                        <div class="mt-4 flex items-center gap-4 p-4 rounded-2xl" style="background: linear-gradient(135deg, #f9fafb, #f3f4f6);">
                            <img src="{{ $paymentProof->temporaryUrl() }}" alt="Preview" class="h-20 w-20 object-cover rounded-xl shadow-md">
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-700">✅ Bukti siap diupload</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $paymentProof->getClientOriginalName() }}</p>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2.5">
                                    <div class="h-1.5 rounded-full transition-all duration-300"
                                         style="background: linear-gradient(90deg, #ea580c, #dc2626); width: 100%;"
                                         wire:loading.class="w-1/2" wire:loading.remove.class="w-full"></div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <button type="submit"
                            class="mt-4 w-full text-white py-3.5 rounded-2xl font-black transition-all shadow-lg hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 flex items-center justify-center gap-2 text-base"
                            style="background: linear-gradient(135deg, #ea580c, #dc2626); box-shadow: 0 8px 24px rgba(234,88,12,0.4);"
                            wire:loading.attr="disabled"
                            {{ !$paymentProof ? 'disabled' : '' }}>
                        <span wire:loading.remove>📤 Upload Bukti Pembayaran</span>
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
            <div class="p-4 rounded-2xl text-center mb-4 flex items-center justify-center gap-2"
                 style="background: linear-gradient(135deg, #f0fdf4, #dcfce7); border: 1px solid #86efac;">
                <span class="text-2xl">🎉</span>
                <span class="font-bold text-green-800">{{ session('success') }}</span>
            </div>
        @endif

        {{-- ═══════ NAVIGASI ═══════ --}}
        <div class="flex gap-3">
            <a href="/order-status/{{ $order->order_number }}" wire:navigate
               class="flex-1 py-3.5 text-white rounded-2xl text-center font-black transition-all shadow-lg hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2"
               style="background: linear-gradient(135deg, #ea580c, #dc2626); box-shadow: 0 8px 24px rgba(234,88,12,0.35);">
                📦 Cek Status Pesanan
            </a>
            <a href="/" wire:navigate
               class="px-4 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-2xl text-center font-black transition-all text-sm flex items-center justify-center">
                🏠
            </a>
        </div>

        {{-- ═══════ TIPS ═══════ --}}
        <div class="mt-5 p-4 rounded-2xl text-center" style="background: rgba(249,115,22,0.08); border: 1px dashed rgba(234,88,12,0.3);">
            <p class="text-xs text-orange-700 font-medium">
                💡 Simpan nomor pesanan <strong>{{ $order->order_number }}</strong> untuk melacak status pesananmu
            </p>
        </div>
    </div>
</div>