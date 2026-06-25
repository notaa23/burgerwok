<div>
    <div class="max-w-lg mx-auto px-4 py-8">
        <h1 class="text-2xl font-poppins font-bold text-gray-900 mb-6">💳 Pembayaran</h1>

        <div class="bg-white rounded-xl p-6 shadow-sm mb-4">
            <p class="text-sm text-gray-500">Nomor Pesanan</p>
            <p class="text-xl font-bold text-orange-500 mb-4">{{ $order->order_number }}</p>
            <p class="text-sm text-gray-500">Total Pembayaran</p>
            <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($order->total) }}</p>
        </div>

        @if($order->payment_method === 'qris')
            <div class="bg-white rounded-xl p-6 shadow-sm mb-4 text-center">
                <h2 class="font-semibold mb-3">Scan QRIS</h2>
                <div class="bg-gray-200 w-48 h-48 mx-auto rounded-lg flex items-center justify-center text-6xl">
                    📱
                </div>
                <p class="text-sm text-gray-500 mt-3">Scan kode QR di atas untuk membayar</p>
            </div>
        @elseif($order->payment_method === 'transfer')
            <div class="bg-white rounded-xl p-6 shadow-sm mb-4">
                <h2 class="font-semibold mb-3">Transfer Bank</h2>
                <p class="text-sm text-gray-500">Bank BCA</p>
                <p class="text-xl font-bold mb-2">1234567890</p>
                <p class="text-sm text-gray-500">a.n. Burger Kebab MAN</p>
                <button onclick="navigator.clipboard.writeText('1234567890')" 
                        class="mt-3 px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm hover:bg-gray-300">
                    📋 Salin No Rekening
                </button>
            </div>
        @else
            <div class="bg-white rounded-xl p-6 shadow-sm mb-4 text-center">
                <p class="text-6xl mb-3">💵</p>
                <p class="font-semibold">Bayar di Tempat (COD)</p>
                <p class="text-sm text-gray-500">Bayar saat pesanan diterima</p>
            </div>
        @endif

        @if($order->payment_method !== 'cod')
            <div class="bg-white rounded-xl p-6 shadow-sm mb-4">
                <h2 class="font-semibold mb-3">Upload Bukti Pembayaran</h2>
                <form wire:submit="uploadProof">
                    <input type="file" wire:model="paymentProof" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    @error('paymentProof') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                    @if($paymentProof)
                        <div class="mt-3">
                            <img src="{{ $paymentProof->temporaryUrl() }}" class="max-h-40 rounded-lg">
                        </div>
                    @endif

                    <button type="submit" 
                            class="mt-4 w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-full font-bold transition">
                        Upload Bukti
                    </button>
                </form>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg text-center">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>