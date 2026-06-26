<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-md mx-auto px-4">

        {{-- ═══════ HEADER ═══════ --}}
        <div class="text-center mb-8">
            <div class="w-24 h-24 rounded-[2rem] flex items-center justify-center mx-auto mb-4 bg-gradient-to-br from-orange-400 to-red-500 shadow-xl shadow-orange-500/20 transform hover:scale-105 transition-transform duration-300">
                <span class="text-5xl">💳</span>
            </div>
            <h1 class="text-3xl font-poppins font-black text-slate-800 tracking-tight">Selesaikan Pembayaran</h1>
            <p class="text-slate-500 font-medium mt-2">Satu langkah lagi menuju kelezatan!</p>
        </div>

        {{-- ═══════ INFO PESANAN ═══════ --}}
        <div class="rounded-[2rem] p-6 mb-6 shadow-2xl relative overflow-hidden"
             style="background: linear-gradient(135deg, #0f172a, #1e293b);">
            {{-- Decorative --}}
            <div class="absolute top-0 right-0 w-40 h-40 rounded-full opacity-10 blur-xl"
                 style="background: radial-gradient(circle, #f97316, transparent); transform: translate(30%, -30%);"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 rounded-full opacity-10 blur-xl"
                 style="background: radial-gradient(circle, #38bdf8, transparent); transform: translate(-30%, 30%);"></div>
            
            <div class="relative z-10 flex flex-col gap-4">
                <div class="flex justify-between items-center border-b border-white/10 pb-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-400 mb-1">Nomor Pesanan</p>
                        <div class="flex items-center gap-2" x-data="{ copied: false }">
                            <p class="text-2xl font-black text-white font-poppins tracking-wider">{{ $order->order_number }}</p>
                            <button @click="navigator.clipboard.writeText('{{ $order->order_number }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                    class="text-white/60 hover:text-white transition-colors"
                                    title="Salin Nomor Pesanan">
                                <span x-show="!copied">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <span x-show="copied" style="display: none;" class="text-green-400">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-xl px-3 py-1.5 border border-white/5">
                        <p class="text-xs text-white/80 font-medium capitalize flex items-center gap-1">
                            @if($order->payment_status === 'pending')
                                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                                Menunggu Pembayaran
                            @elseif($order->payment_status === 'waiting_confirmation')
                                <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                                Menunggu Konfirmasi
                            @elseif($order->payment_status === 'confirmed')
                                <span class="w-2 h-2 rounded-full bg-green-400"></span>
                                Terkonfirmasi
                            @endif
                        </p>
                    </div>
                </div>
                <div class="flex justify-between items-end pt-2">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400 mb-1">Metode Pembayaran</p>
                        <p class="text-lg font-bold text-white capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-400 mb-1">Total Belanja</p>
                        <p class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-300 font-poppins">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════ MIDTRANS ═══════ --}}
        @if($order->payment_method === 'midtrans')
            <div class="bg-white rounded-[2rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 mb-6 text-center">
                <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-indigo-100">
                    <span class="text-3xl">📱</span>
                </div>
                <h2 class="font-poppins font-black text-slate-800 mb-2 text-xl">Bayar Lebih Mudah</h2>
                <p class="text-slate-500 font-medium text-sm mb-8 leading-relaxed">
                    Selesaikan pembayaran dengan aman menggunakan e-Wallet (GoPay, OVO, Dana), QRIS, atau Virtual Account Bank pilihan Anda.
                </p>
                
                @if($order->payment_status === 'pending' && $order->snap_token)
                    @if(str_starts_with($order->snap_token, 'http'))
                        <a href="{{ $order->snap_token }}" class="w-full bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white py-4 px-6 rounded-2xl font-black text-lg transition-all shadow-xl shadow-orange-500/30 hover:shadow-orange-500/50 active:scale-[0.98] flex items-center justify-center gap-2 group">
                            <span>Bayar Sekarang</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    @else
                        <button id="pay-button" class="w-full bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white py-4 px-6 rounded-2xl font-black text-lg transition-all shadow-xl shadow-orange-500/30 hover:shadow-orange-500/50 active:scale-[0.98] flex items-center justify-center gap-2">
                            <span>Proses Pembayaran</span>
                        </button>
                        
                        @php
                            $midtransScriptUrl = config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js';
                        @endphp
                        <script src="{{ $midtransScriptUrl }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
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
                    @endif
                @elseif($order->payment_status === 'confirmed')
                    <div class="p-6 rounded-2xl text-center bg-emerald-50 border border-emerald-200">
                        <div class="w-12 h-12 bg-emerald-500 rounded-full flex items-center justify-center text-white mx-auto mb-3 shadow-lg shadow-emerald-500/30">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="font-black text-emerald-800 block text-lg">Pembayaran Berhasil!</span>
                        <span class="text-emerald-600 font-medium text-sm mt-1 block">Pesanan Anda segera diproses.</span>
                    </div>
                @elseif($order->payment_status === 'pending' && !$order->snap_token)
                    <div class="p-6 rounded-2xl text-center mb-4 text-red-800 bg-red-50 border border-red-200">
                        <span class="text-3xl block mb-3">⚠️</span>
                        <span class="font-bold text-lg block">Gagal terhubung ke server pembayaran.</span>
                        @if(session('error'))
                            <p class="text-sm font-medium mt-2 bg-white/50 p-2 rounded-lg">{{ session('error') }}</p>
                        @endif
                        <p class="text-xs text-red-600 font-medium mt-3">Sistem sedang mengalami gangguan teknis atau API Key belum dikonfigurasi dengan benar.</p>
                    </div>
                @endif
            </div>

        {{-- ═══════ QRIS ═══════ --}}
        @elseif($order->payment_method === 'qris')
            <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100 mb-4">
                <h2 class="font-poppins font-black text-gray-900 text-center mb-2 text-lg">
                    📱 Scan QRIS untuk Membayar
                </h2>
                <p class="text-center text-sm text-gray-500 mb-5">Gunakan GoPay, OVO, DANA, ShopeePay, atau Mobile Banking apapun</p>

                {{-- Nominal yang harus dibayar --}}
                <div class="mb-4 p-3 rounded-2xl text-center" style="background: linear-gradient(135deg, #fff7ed, #ffedd5); border: 1px solid #fed7aa;">
                    <p class="text-xs font-bold uppercase tracking-widest text-orange-600 mb-1">Bayar Tepat Sebesar</p>
                    <p class="text-3xl font-black text-orange-600 font-poppins">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                </div>

                {{-- QRIS Image --}}
                <div class="flex justify-center mb-4">
                    @if(file_exists(public_path('images/qris.jpg')) || file_exists(public_path('images/qris.png')))
                        <div class="p-3 border-4 border-gray-900 rounded-2xl shadow-lg">
                            @if(file_exists(public_path('images/qris.jpg')))
                                <img src="/images/qris.jpg" alt="QRIS Burger Kebab MAN" class="w-56 h-56 object-contain">
                            @else
                                <img src="/images/qris.png" alt="QRIS Burger Kebab MAN" class="w-56 h-56 object-contain">
                            @endif
                        </div>
                    @else
                        <div class="w-64 p-6 border-4 border-dashed border-orange-400 rounded-2xl text-center bg-orange-50">
                            <p class="text-5xl mb-3">📋</p>
                            <p class="font-black text-orange-700 text-sm">QRIS belum diunggah</p>
                            <p class="text-xs text-orange-500 mt-2 leading-relaxed">
                                Taruh gambar QRIS Anda di:<br>
                                <code class="bg-orange-100 px-1 rounded text-orange-700">public/images/qris.jpg</code>
                            </p>
                        </div>
                    @endif
                </div>

                <div class="p-3 rounded-2xl text-center" style="background: linear-gradient(135deg, #eff6ff, #dbeafe);">
                    <p class="text-sm text-blue-700 font-medium">
                        💡 Setelah scan & bayar, upload bukti bayar di bawah ya!
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
                            <p class="text-xs font-black uppercase tracking-widest text-blue-500 mb-1">Bank BRI</p>
                            <p class="text-2xl font-black text-gray-900 font-poppins tracking-widest">1234567890</p>
                            <p class="text-sm text-gray-500 mt-1">VA <span class="font-bold text-gray-700">Burger Kebab MAN</span></p>
                        </div>
                        <button @click="navigator.clipboard.writeText('1234567890'); copied = true; setTimeout(() => copied = false, 2500)"
                                class="px-4 py-2.5 rounded-xl text-sm font-black transition-all duration-200 shadow-sm"
                                :class="copied ? 'bg-green-500 text-white shadow-green-200' : 'bg-white text-blue-600 hover:bg-blue-50 border-2 border-blue-200'">
                            <span x-show="!copied">📋 Salin</span>
                            <span x-show="copied">✅ Tersalin!</span>
                        </button>
                    </div>
                </div>
                                </h2>
                <div class="rounded-2xl p-4 border border-blue-100 mb-3" style="background: linear-gradient(135deg, #eff6ff, #f0f9ff);"
                     x-data="{ copied: false }">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-blue-500 mb-1">Bank BNI</p>
                            <p class="text-2xl font-black text-gray-900 font-poppins tracking-widest">1234567890</p>
                            <p class="text-sm text-gray-500 mt-1">VA <span class="font-bold text-gray-700">Burger Kebab MAN</span></p>
                        </div>
                        <button @click="navigator.clipboard.writeText('1234567890'); copied = true; setTimeout(() => copied = false, 2500)"
                                class="px-4 py-2.5 rounded-xl text-sm font-black transition-all duration-200 shadow-sm"
                                :class="copied ? 'bg-green-500 text-white shadow-green-200' : 'bg-white text-blue-600 hover:bg-blue-50 border-2 border-blue-200'">
                            <span x-show="!copied">📋 Salin</span>
                            <span x-show="copied">✅ Tersalin!</span>
                        </button>
                    </div>
                </div>
                                </h2>
                <div class="rounded-2xl p-4 border border-blue-100 mb-3" style="background: linear-gradient(135deg, #eff6ff, #f0f9ff);"
                     x-data="{ copied: false }">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-blue-500 mb-1">Bank Mandiri</p>
                            <p class="text-2xl font-black text-gray-900 font-poppins tracking-widest">1234567890</p>
                            <p class="text-sm text-gray-500 mt-1">VA <span class="font-bold text-gray-700">Burger Kebab MAN</span></p>
                        </div>
                        <button @click="navigator.clipboard.writeText('1234567890'); copied = true; setTimeout(() => copied = false, 2500)"
                                class="px-4 py-2.5 rounded-xl text-sm font-black transition-all duration-200 shadow-sm"
                                :class="copied ? 'bg-green-500 text-white shadow-green-200' : 'bg-white text-blue-600 hover:bg-blue-50 border-2 border-blue-200'">
                            <span x-show="!copied">📋 Salin</span>
                            <span x-show="copied">✅ Tersalin!</span>
                        </button>
                    </div>
                </div>
                                </h2>
                <div class="rounded-2xl p-4 border border-blue-100 mb-3" style="background: linear-gradient(135deg, #eff6ff, #f0f9ff);"
                     x-data="{ copied: false }">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-blue-500 mb-1">Bank BCA</p>
                            <p class="text-2xl font-black text-gray-900 font-poppins tracking-widest">1234567890</p>
                            <p class="text-sm text-gray-500 mt-1">VA <span class="font-bold text-gray-700">Burger Kebab MAN</span></p>
                        </div>
                        <button @click="navigator.clipboard.writeText('1234567890'); copied = true; setTimeout(() => copied = false, 2500)"
                                class="px-4 py-2.5 rounded-xl text-sm font-black transition-all duration-200 shadow-sm"
                                :class="copied ? 'bg-green-500 text-white shadow-green-200' : 'bg-white text-blue-600 hover:bg-blue-50 border-2 border-blue-200'">
                            <span x-show="!copied">📋 Salin</span>
                            <span x-show="copied">✅ Tersalin!</span>
                        </button>
                    </div>
                </div>
                                </h2>
                <div class="rounded-2xl p-4 border border-blue-100 mb-3" style="background: linear-gradient(135deg, #eff6ff, #f0f9ff);"
                     x-data="{ copied: false }">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-blue-500 mb-1">Bank BSI</p>
                            <p class="text-2xl font-black text-gray-900 font-poppins tracking-widest">1234567890</p>
                            <p class="text-sm text-gray-500 mt-1">VA <span class="font-bold text-gray-700">Burger Kebab MAN</span></p>
                        </div>
                        <button @click="navigator.clipboard.writeText('1234567890'); copied = true; setTimeout(() => copied = false, 2500)"
                                class="px-4 py-2.5 rounded-xl text-sm font-black transition-all duration-200 shadow-sm"
                                :class="copied ? 'bg-green-500 text-white shadow-green-200' : 'bg-white text-blue-600 hover:bg-blue-50 border-2 border-blue-200'">
                            <span x-show="!copied">📋 Salin</span>
                            <span x-show="copied">✅ Tersalin!</span>
                        </button>
                    </div>
                </div>
                                </h2>
                <div class="rounded-2xl p-4 border border-blue-100 mb-3" style="background: linear-gradient(135deg, #eff6ff, #f0f9ff);"
                     x-data="{ copied: false }">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-blue-500 mb-1">Bank BTN</p>
                            <p class="text-2xl font-black text-gray-900 font-poppins tracking-widest">1234567890</p>
                            <p class="text-sm text-gray-500 mt-1">VA <span class="font-bold text-gray-700">Burger Kebab MAN</span></p>
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
                        <div class="mt-4 flex items-center gap-4 p-4 rounded-2xl relative" style="background: linear-gradient(135deg, #f9fafb, #f3f4f6);">
                            <button type="button" wire:click="$set('paymentProof', null)" @click="$refs.fileInput.value = null"
                                    class="absolute -top-2 -right-2 w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-md transition-all text-xs"
                                    title="Batalkan file ini">
                                ❌
                            </button>
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