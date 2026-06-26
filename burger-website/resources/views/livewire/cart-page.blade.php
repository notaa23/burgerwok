<div class="min-h-[70vh] bg-slate-50/50 py-10">
    <div class="max-w-3xl mx-auto px-4">
        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8">
            <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-red-500 rounded-2xl flex items-center justify-center shadow-lg shadow-orange-500/20">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-poppins font-black text-slate-800">Keranjang Belanja</h1>
                <p class="text-sm font-medium text-slate-500 mt-0.5">{{ count($items) }} pesanan siap diproses</p>
            </div>
        </div>

        @if(count($items) > 0)
            {{-- Item List --}}
            <div class="space-y-4">
                @foreach($items as $key => $item)
                    <div class="bg-white rounded-[1.5rem] p-5 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300"
                         x-data="{ removing: false }"
                         x-show="!removing"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-full">
                        <div class="flex justify-between items-start gap-4">
                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <h3 class="font-poppins font-bold text-lg text-slate-800">{{ $item['name'] }}</h3>
                                <div class="flex flex-wrap items-center gap-2 mt-2">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold bg-slate-100 text-slate-700 px-2.5 py-1 rounded-full">
                                        📦 {{ $item['qty'] }} Porsi
                                    </span>
                                    @if(!empty($item['spice_level']['name']))
                                        <span class="inline-flex items-center gap-1.5 text-xs font-bold bg-red-50 text-red-600 px-2.5 py-1 rounded-full border border-red-100">
                                            🌶️ {{ $item['spice_level']['name'] }}
                                        </span>
                                    @endif
                                </div>
                                @if(!empty($item['toppings']))
                                    <p class="text-sm text-orange-600 mt-2 font-semibold">
                                        <span class="text-xs text-orange-400 mr-1">+ Ekstra:</span>
                                        {{ implode(', ', array_column($item['toppings'], 'name')) }}
                                    </p>
                                @endif
                                @if(!empty($item['notes']))
                                    <p class="text-sm text-slate-500 mt-2 italic bg-slate-50 px-3 py-2 rounded-xl">📝 {{ $item['notes'] }}</p>
                                @endif
                            </div>

                            {{-- Price & Remove --}}
                            <div class="text-right flex flex-col items-end gap-3">
                                <span class="text-xl font-black text-orange-500 font-poppins">
                                    Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                </span>
                                <button wire:click="remove('{{ $item['id'] }}')"
                                        @click="removing = true"
                                        class="text-sm text-slate-400 hover:text-red-500 font-bold flex items-center gap-1.5 transition-colors bg-white px-3 py-1.5 rounded-full border border-slate-200 hover:border-red-200 hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Total & Actions --}}
            <div class="mt-8 bg-white rounded-[2rem] shadow-lg shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <div class="p-6 md:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-slate-500 font-bold text-lg">Total Pembayaran</span>
                        <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600 font-poppins">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button wire:click="clear"
                                class="px-6 py-4 bg-slate-100 text-slate-600 rounded-2xl text-sm font-bold hover:bg-slate-200 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Kosongkan
                        </button>
                        <a href="/checkout" wire:navigate
                           class="flex-1 px-8 py-4 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white rounded-2xl text-lg font-black text-center transition-all shadow-xl shadow-orange-500/30 hover:shadow-orange-500/50 active:scale-[0.98] flex items-center justify-center gap-2">
                            Lanjut Checkout 
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        @else
            {{-- Empty State --}}
            <div class="text-center py-24 bg-white rounded-[3rem] shadow-sm border border-slate-100">
                <div class="text-8xl mb-6 animate-bounce-slow">🛒</div>
                <h3 class="text-2xl font-poppins font-black text-slate-800 mb-3">Keranjang Masih Kosong</h3>
                <p class="text-slate-500 mb-8 font-medium">Yuk, pilih menu favoritmu sekarang sebelum kehabisan!</p>
                <a href="/" wire:navigate
                   class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white rounded-full font-bold transition-all shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                    Lihat Menu
                </a>
            </div>
        @endif
    </div>
</div>