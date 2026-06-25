{{-- FILE: resources/views/livewire/cart-page.blade.php --}}
<div class="min-h-[60vh]">
    <div class="max-w-2xl mx-auto px-4 py-8">
        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-poppins font-bold text-gray-800">Keranjang Belanja</h1>
                <p class="text-sm text-gray-500">{{ count($items) }} item dalam keranjang</p>
            </div>
        </div>

        @if(count($items) > 0)
            {{-- Item List --}}
            <div class="space-y-3">
                @foreach($items as $key => $item)
                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300"
                         x-data="{ removing: false }"
                         x-show="!removing"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-full">
                        <div class="flex justify-between items-start gap-4">
                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <h3 class="font-poppins font-semibold text-gray-800">{{ $item['name'] }}</h3>
                                <div class="flex flex-wrap items-center gap-2 mt-1.5">
                                    <span class="inline-flex items-center gap-1 text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
                                        📦 x{{ $item['qty'] }}
                                    </span>
                                    @if(!empty($item['spice_level']['name']))
                                        <span class="inline-flex items-center gap-1 text-xs bg-red-50 text-red-600 px-2 py-1 rounded-full">
                                            🌶️ {{ $item['spice_level']['name'] }}
                                        </span>
                                    @endif
                                </div>
                                @if(!empty($item['toppings']))
                                    <p class="text-xs text-orange-500 mt-1.5 font-medium">
                                        + {{ implode(', ', array_column($item['toppings'], 'name')) }}
                                    </p>
                                @endif
                                @if(!empty($item['notes']))
                                    <p class="text-xs text-gray-400 mt-1 italic">📝 {{ $item['notes'] }}</p>
                                @endif
                            </div>

                            {{-- Price & Remove --}}
                            <div class="text-right flex flex-col items-end gap-2">
                                <span class="font-bold text-orange-500 font-poppins">
                                    Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                </span>
                                <button wire:click="remove('{{ $item['id'] }}')"
                                        @click="removing = true"
                                        class="text-xs text-red-400 hover:text-red-600 font-medium flex items-center gap-1 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
            <div class="mt-6 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-medium">Total Pembayaran</span>
                        <span class="text-2xl font-bold text-orange-500 font-poppins">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                <div class="border-t border-gray-100 p-4 flex gap-3">
                    <button wire:click="clear"
                            class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-200 transition-colors">
                        🗑️ Kosongkan
                    </button>
                    <a href="/checkout"
                       class="flex-1 px-6 py-2.5 bg-orange-500 hover:bg-orange-600 text-white rounded-xl text-sm font-bold text-center transition-all shadow-md hover:shadow-lg active:scale-[0.98]">
                        Checkout →
                    </a>
                </div>
            </div>

        @else
            {{-- Empty State --}}
            <div class="text-center py-20">
                <div class="text-7xl mb-4">🛒</div>
                <h3 class="text-xl font-poppins font-bold text-gray-700 mb-2">Keranjang Masih Kosong</h3>
                <p class="text-gray-500 mb-6">Yuk, pesan menu favorit kamu sekarang!</p>
                <a href="/"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-full font-semibold transition shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                    Lihat Menu
                </a>
            </div>
        @endif
    </div>
</div>