{{-- FILE: resources/views/livewire/order-status-page.blade.php --}}
<div>
    <div class="max-w-lg mx-auto px-4 py-8">
        @if(!$order)
            {{-- ═══════ FORM CEK PESANAN ═══════ --}}
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <span class="text-3xl">📦</span>
                </div>
                <h1 class="text-2xl font-poppins font-bold text-gray-800">Cek Status Pesanan</h1>
                <p class="text-sm text-gray-500 mt-1">Masukkan nomor pesananmu untuk melihat status terkini.</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <form wire:submit="checkOrder($event.target.order_number.value)">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Nomor Pesanan</label>
                    <div class="relative">
                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                        </svg>
                        <input type="text" name="order_number" placeholder="BKB-20260625-1234"
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-orange-100 focus:border-orange-500 outline-none text-sm transition">
                    </div>
                    <button type="submit"
                            class="w-full mt-4 bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-bold transition shadow-md hover:shadow-lg active:scale-[0.98] flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cek Status
                    </button>
                </form>
            </div>
        @else
            {{-- Polling --}}
            <div wire:poll.5s></div>

            {{-- ═══════ INFO PESANAN ═══════ --}}
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 mb-4">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider font-medium">Nomor Pesanan</p>
                        <div class="flex items-center gap-2 mt-0.5" x-data="{ copied: false }">
                            <p class="text-lg font-bold text-orange-500 font-poppins">{{ $order->order_number }}</p>
                            <button @click="navigator.clipboard.writeText('{{ $order->order_number }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                    class="text-gray-400 hover:text-orange-500 transition-colors"
                                    title="Salin Nomor Pesanan">
                                <span x-show="!copied">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <span x-show="copied" style="display: none;" class="text-green-500">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="text-right">
                        @php
                            $statusBadge = match($order->order_status) {
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'processing' => 'bg-blue-100 text-blue-700',
                                'ready' => 'bg-green-100 text-green-700',
                                'completed' => 'bg-green-100 text-green-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-700'
                            };
                        @endphp
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusBadge }}">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4 pt-4 border-t border-gray-100">
                    <div>
                        <p class="text-xs text-gray-400">Nama</p>
                        <p class="font-semibold text-gray-800 text-sm">{{ $order->customer_name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400">Total</p>
                        <p class="font-bold text-gray-800 font-poppins">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            {{-- ═══════ PROGRESS TRACKER ═══════ --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-4">
                <h2 class="font-poppins font-bold text-sm text-gray-500 uppercase tracking-wider mb-5">Status Pesanan</h2>

                @php
                    $steps = [
                        'pending' => ['label' => 'Pesanan Diterima', 'icon' => '📝'],
                        'processing' => ['label' => 'Sedang Dibuat', 'icon' => '👨‍🍳'],
                        'ready' => ['label' => 'Siap Diambil', 'icon' => '✅'],
                        'completed' => ['label' => 'Selesai', 'icon' => '🎉'],
                    ];
                    $stepKeys = array_keys($steps);
                    $currentStep = array_search($order->order_status, $stepKeys);
                    if ($order->order_status === 'cancelled') $currentStep = -1;
                @endphp

                @if($order->order_status === 'cancelled')
                    <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-center">
                        <span class="text-3xl block mb-2">❌</span>
                        <p class="font-semibold">Pesanan Dibatalkan</p>
                        <p class="text-sm mt-1">Hubungi kami via WhatsApp untuk bantuan.</p>
                        <a href="https://wa.me/62812XXXXXXXX" target="_blank"
                           class="inline-block mt-3 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-xl text-sm font-semibold transition">
                            💬 Chat WhatsApp
                        </a>
                    </div>
                @else
                    <div class="space-y-0">
                        @foreach($steps as $key => $step)
                            @php
                                $stepIndex = array_search($key, $stepKeys);
                                $isDone = $stepIndex < $currentStep;
                                $isCurrent = $stepIndex == $currentStep;
                                $isPending = $stepIndex > $currentStep;
                            @endphp
                            <div class="flex items-start gap-4">
                                {{-- Indicator --}}
                                <div class="flex flex-col items-center">
                                    @if($isDone)
                                        <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center shadow-md">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                    @elseif($isCurrent)
                                        <div class="w-10 h-10 rounded-full bg-orange-500 text-white flex items-center justify-center shadow-md ring-4 ring-orange-100 animate-pulse">
                                            <span class="text-lg">{{ $step['icon'] }}</span>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center">
                                            <span class="text-lg opacity-50">{{ $step['icon'] }}</span>
                                        </div>
                                    @endif

                                    {{-- Connecting Line --}}
                                    @if(!$loop->last)
                                        <div class="w-0.5 h-8 {{ $isDone ? 'bg-green-500' : ($isCurrent ? 'bg-orange-200' : 'bg-gray-200') }}"></div>
                                    @endif
                                </div>

                                {{-- Label --}}
                                <div class="pt-2">
                                    <p class="text-sm font-semibold {{ $isDone ? 'text-green-600' : ($isCurrent ? 'text-orange-600 font-bold' : 'text-gray-400') }}">
                                        {{ $step['label'] }}
                                    </p>
                                    @if($isCurrent)
                                        <p class="text-xs text-orange-400 mt-0.5">Sedang berlangsung...</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ═══════ DETAIL ITEM PESANAN ═══════ --}}
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 mb-4">
                <h2 class="font-poppins font-bold text-sm text-gray-500 uppercase tracking-wider mb-3">Detail Pesanan</h2>
                @foreach($order->orderItems as $item)
                    <div class="flex justify-between text-sm py-2 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                        <div>
                            <span class="font-medium text-gray-700">{{ $item->menu->name ?? 'Menu' }}</span>
                            <span class="text-gray-400"> x{{ $item->quantity }}</span>
                            @if($item->toppings->isNotEmpty())
                                <p class="text-xs text-orange-400">+ {{ $item->toppings->pluck('name')->join(', ') }}</p>
                            @endif
                        </div>
                        <span class="font-medium text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            {{-- ═══════ TOMBOL AKSI ═══════ --}}
            <div class="space-y-3">
                @if($order->payment_method !== 'cod' && $order->payment_status === 'pending')
                    <a href="/payment/{{ $order->order_number }}" wire:navigate
                       class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-bold transition shadow-md hover:shadow-lg">
                        💳 Bayar Sekarang
                    </a>
                @endif

                <a href="/" wire:navigate
                   class="block w-full text-center text-orange-500 hover:text-orange-600 py-2 text-sm font-medium transition">
                    ← Kembali ke Menu
                </a>
            </div>
        @endif
    </div>
</div>