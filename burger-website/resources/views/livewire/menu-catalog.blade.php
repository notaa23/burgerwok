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
                        🍔
                    </div>
                    <!-- Content -->
                    <div class="p-4">
                        <span class="text-xs text-orange-500 font-semibold">{{ $menu->category->name }}</span>
                        <h3 class="text-lg font-poppins font-bold text-gray-900 mt-1">{{ $menu->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $menu->description }}</p>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-xl font-bold text-orange-500">Rp {{ number_format($menu->base_price) }}</span>
                            <button wire:click="addToCart({{ $menu->id }})" 
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
</div>