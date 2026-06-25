<div>
    <div class="max-w-lg mx-auto px-4 py-8">
        <h1 class="text-2xl font-poppins font-bold text-gray-900 mb-6">📦 Cek Pesanan</h1>

        @if(!$order)
            <!-- Form cek pesanan -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <form wire:submit="checkOrder($event.target.order_number.value)">
                    <label class="block text-sm text-gray-600 mb-1">Nomor Pesanan</label>
                    <input type="text" name="order_number" placeholder="BKB-20240625-1234" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 outline-none mb-3">
                    <button type="submit" 
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-full font-bold transition">
                        Cek Status
                    </button>
                </form>
            </div>
        @else
            <!-- Status Pesanan -->
            <div class="bg-white rounded-xl p-6 shadow-sm mb-4">
                <p class="text-sm text-gray-500">Nomor Pesanan</p>
                <p class="text-xl font-bold text-orange-500 mb-4">{{ $order->order_number }}</p>
                <p class="text-sm text-gray-500">Nama</p>
                <p class="font-semibold mb-4">{{ $order->customer_name }}</p>
                <p class="text-sm text-gray-500">Total</p>
                <p class="text-xl font-bold text-gray-900">Rp {{ number_format($order->total) }}</p>
            </div>

            <!-- Progress Tracker -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h2 class="font-semibold mb-4">Status Pesanan</h2>
                
                @php
                    $steps = [
                        'pending' => 'Pesanan Diterima',
                        'processing' => 'Sedang Dibuat',
                        'ready' => 'Siap Diambil',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ];
                    $currentStep = array_search($order->order_status, array_keys($steps));
                    if ($order->order_status === 'cancelled') $currentStep = -1;
                @endphp

                @if($order->order_status === 'cancelled')
                    <div class="bg-red-100 text-red-700 p-4 rounded-lg text-center">
                        Pesanan ini dibatalkan
                    </div>
                @else
                    @foreach($steps as $key => $label)
                        @php $stepIndex = array_search($key, array_keys($steps)); @endphp
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold
                                {{ $stepIndex <= $currentStep ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-400' }}">
                                {{ $stepIndex <= $currentStep ? '✓' : $stepIndex + 1 }}
                            </div>
                            <span class="{{ $stepIndex <= $currentStep ? 'text-gray-900 font-medium' : 'text-gray-400' }}">
                                {{ $label }}
                            </span>
                        </div>
                    @endforeach
                @endif
            </div>

            @if($order->payment_method !== 'cod' && $order->payment_status === 'pending')
                <a href="/payment/{{ $order->order_number }}" 
                   class="mt-4 block text-center bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-full font-bold transition">
                    Bayar Sekarang
                </a>
            @endif

            <a href="/" class="mt-3 block text-center text-orange-500 hover:underline text-sm">
                Kembali ke Menu
            </a>
        @endif
    </div>
</div>