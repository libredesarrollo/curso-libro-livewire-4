<a href="{{ route('shop.cart.list') }}" 
   class="fixed bottom-6 right-6 z-50 group"
>
    <div class="relative">
        <div class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-lg">
            {{ $total }}
        </div>
        <div class="p-3 bg-purple-600 hover:bg-purple-700 rounded-full shadow-lg transition-all duration-300 group-hover:scale-110">
            <flux:icon name="shopping-cart" class="w-6 h-6 text-white" />
        </div>
    </div>
</a>
