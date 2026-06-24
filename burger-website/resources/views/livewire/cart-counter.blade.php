<a href="/cart" class="relative text-gray-600 hover:text-orange-500">
    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
    </svg>
    @if($count > 0)
        <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold">
            {{ $count }}
        </span>
    @endif
</a>