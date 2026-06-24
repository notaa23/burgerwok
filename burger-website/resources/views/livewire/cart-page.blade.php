<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-poppins font-bold text-gray-900 mb-6">🛒 Keranjang Belanja</h1>

    @if(count($items) > 0)
        <div class="space-y-4">
            @foreach($items as $item)
                <div class="bg-white rounded-xl p-4 shadow-sm flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $item['name'] }}</h3>
                        <p class="text-sm text-gray-500">
                            Qty: {{ $item['qty'] }} | 
                            Level: {{ $item['spice_level']['name'] ?? '-' }}
                        </p>
                        @if(!empty($item['toppings']))
                            <p class="text-xs text-orange-500">
                                + {{ implode(', ', array_column($item['toppings'], 'name')) }}
                            </p>
                        @endif
                        @if($item['notes'])
                            <p class="text-xs text-gray-400">Catatan: {{ $item['notes'] }}</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-orange-500">Rp {{ number_format($item['price'] * $item['qty']) }}</p>
                        <button wire:click="remove('{{ $item['id'] }}')" class="text-red-500 text-sm mt-1 hover:underline">Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 bg-white rounded-xl p-4 shadow-sm">
            <div class="flex justify-between items-center text-lg font-bold">
                <span>Total</span>
                <span class="text-orange-500">Rp {{ number_format($total) }}</span>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <button wire:click="clear" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 text-sm">
                Kosongkan
            </button>
            <a href="/checkout" class="px-6 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600 text-sm font-semibold">
                Checkout →
            </a>
        </div>
    @else
        <div class="text-center py-20">
            <p class="text-6xl mb-4">🛒</p>
            <p class="text-gray-500">Keranjang kosong. Yuk pesan!</p>
            <a href="/" class="inline-block mt-4 px-6 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600 text-sm font-semibold">
                Lihat Menu
            </a>
        </div>
    @endif
</div>