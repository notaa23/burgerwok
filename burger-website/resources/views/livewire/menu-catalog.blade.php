<div>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Hero -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-poppins font-bold text-gray-900 mb-2">Burger Kebab MAN</h1>
            <p class="text-gray-500 text-lg">Mantap • Authentic • Nikmat</p>
        </div>

        <!-- Search -->
        <div class="mb-6">
            <input type="text" wire:model.live.debounce.300ms="search" 
                   placeholder="Cari menu..." 
                   class="w-full max-w-md mx-auto block px-4 py-3 border border-gray-300 rounded-full focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
        </div>

        <!-- Category Filter -->
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <button wire:click="resetFilter" 
                    class="px-4 py-2 rounded-full text-sm font-medium {{ !$selectedCategory ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Semua
            </button>
            @foreach($categories as $cat)
                <button wire:click="filterByCategory({{ $cat->id }})"
                        class="px-4 py-2 rounded-full text-sm font-medium {{ $selectedCategory == $cat->id ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>

        <!-- Menu Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($menus as $menu)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition group">
                    <!-- Image -->
                    <div class="h-48 bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center text-white text-6xl">
                        @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover">
                        @else
                            🍔
                        @endif
                    </div>
                    <!-- Content -->
                    <div class="p-4">
                        <span class="text-xs text-orange-500 font-semibold">{{ $menu->category->name }}</span>
                        <h3 class="text-lg font-poppins font-bold text-gray-900 mt-1">{{ $menu->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $menu->description }}</p>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-xl font-bold text-orange-500">Rp {{ number_format($menu->base_price) }}</span>
                            <button onclick="openModal({{ $menu->id }})" 
                                    class="bg-orange-500 hover:bg-orange-600 text-white w-10 h-10 rounded-full flex items-center justify-center text-xl font-bold transition shadow-md">
                                +
                            </button>
                        </div>
                        @if($menu->is_featured)
                            <span class="inline-block mt-2 text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full font-semibold">Best Seller</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($menus->isEmpty())
            <div class="text-center py-20">
                <p class="text-6xl mb-4">🔍</p>
                <p class="text-gray-500 text-lg">Menu tidak ditemukan</p>
            </div>
        @endif
    </div>

    <!-- MODAL CUSTOMIZATION -->
    <div id="customModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50" x-data>
        <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4 max-h-[80vh] overflow-y-auto">
            <h2 class="text-xl font-poppins font-bold mb-4" id="modalTitle">Customize</h2>
            
            <!-- Spice Level -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Level Kepedasan</label>
                <div class="grid grid-cols-5 gap-2" id="spiceOptions">
                    @php
                        $spiceLevels = \App\Models\SpiceLevel::all();
                    @endphp
                    @foreach($spiceLevels as $spice)
                        <button onclick="selectSpice({{ $spice->id }}, '{{ $spice->name }}', this)"
                                class="spice-btn px-2 py-2 rounded-lg border-2 border-gray-200 text-xs hover:border-orange-300 transition"
                                data-id="{{ $spice->id }}" data-name="{{ $spice->name }}">
                            {{ $spice->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Toppings -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Topping Tambahan</label>
                <div class="space-y-2" id="toppingOptions">
                    @php
                        $allToppings = \App\Models\Topping::all();
                    @endphp
                    @foreach($allToppings as $topping)
                        <label class="flex items-center justify-between p-2 rounded-lg border border-gray-200 cursor-pointer hover:border-orange-300">
                            <span class="text-sm">{{ $topping->name }}</span>
                            <span class="text-sm text-orange-500">+Rp {{ number_format($topping->price) }}</span>
                            <input type="checkbox" class="topping-checkbox" data-id="{{ $topping->id }}" data-name="{{ $topping->name }}" data-price="{{ $topping->price }}">
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Qty -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah</label>
                <div class="flex items-center gap-3">
                    <button onclick="changeQty(-1)" class="w-10 h-10 rounded-full bg-gray-200 text-xl font-bold">-</button>
                    <span id="qtyDisplay" class="text-xl font-bold w-10 text-center">1</span>
                    <button onclick="changeQty(1)" class="w-10 h-10 rounded-full bg-gray-200 text-xl font-bold">+</button>
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan</label>
                <input type="text" id="notesInput" placeholder="Tambahan, tanpa bawang..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none">
            </div>

            <!-- Total -->
            <div class="border-t pt-4 mb-4 flex justify-between font-bold text-lg">
                <span>Total</span>
                <span id="modalTotal" class="text-orange-500">Rp 0</span>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button onclick="closeModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm hover:bg-gray-300">
                    Batal
                </button>
                <button onclick="confirmAdd()" class="flex-1 px-4 py-2 bg-orange-500 text-white rounded-full text-sm font-bold hover:bg-orange-600">
                    Tambah ke Keranjang
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentMenuId = null;
        let currentPrice = 0;
        let currentName = '';
        let qty = 1;
        let selectedSpice = { id: 1, name: 'Tidak Pedas' };
        let selectedToppings = [];

        function openModal(menuId) {
            const menus = @json($menus->keyBy('id'));
            const menu = menus[menuId];
            currentMenuId = menuId;
            currentPrice = menu.base_price;
            currentName = menu.name;
            qty = 1;
            selectedSpice = { id: 1, name: 'Tidak Pedas' };
            selectedToppings = [];
            
            document.getElementById('modalTitle').textContent = menu.name;
            document.getElementById('qtyDisplay').textContent = '1';
            document.getElementById('notesInput').value = '';
            document.querySelectorAll('.topping-checkbox').forEach(cb => cb.checked = false);
            document.querySelectorAll('.spice-btn').forEach(b => b.classList.remove('border-orange-500', 'bg-orange-50'));
            document.querySelector('.spice-btn[data-id="1"]')?.classList.add('border-orange-500', 'bg-orange-50');
            
            updateTotal();
            document.getElementById('customModal').classList.remove('hidden');
            document.getElementById('customModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('customModal').classList.add('hidden');
            document.getElementById('customModal').classList.remove('flex');
        }

        function selectSpice(id, name, el) {
            selectedSpice = { id, name };
            document.querySelectorAll('.spice-btn').forEach(b => b.classList.remove('border-orange-500', 'bg-orange-50'));
            el.classList.add('border-orange-500', 'bg-orange-50');
        }

        function changeQty(delta) {
            qty = Math.max(1, Math.min(10, qty + delta));
            document.getElementById('qtyDisplay').textContent = qty;
            updateTotal();
        }

        function updateTotal() {
            let toppingTotal = 0;
            document.querySelectorAll('.topping-checkbox:checked').forEach(cb => {
                toppingTotal += parseInt(cb.dataset.price);
            });
            const total = (currentPrice + toppingTotal) * qty;
            document.getElementById('modalTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        document.querySelectorAll('.topping-checkbox').forEach(cb => {
            cb.addEventListener('change', updateTotal);
        });

        function confirmAdd() {
            selectedToppings = [];
            document.querySelectorAll('.topping-checkbox:checked').forEach(cb => {
                selectedToppings.push({
                    id: cb.dataset.id,
                    name: cb.dataset.name,
                    price: parseInt(cb.dataset.price)
                });
            });
            
            const notes = document.getElementById('notesInput').value;
            
            Livewire.dispatch('addToCartCustom', {
                menuId: currentMenuId,
                name: currentName,
                price: currentPrice,
                qty: qty,
                spiceLevel: selectedSpice,
                toppings: selectedToppings,
                notes: notes
            });
            
            closeModal();
        }

        updateTotal();
    </script>
</div>