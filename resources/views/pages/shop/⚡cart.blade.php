<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Models\Post;
use App\Models\ShoppingCart;


new #[Layout('layouts.web')] class extends Component
{
    protected $listeners = ['itemDelete' => 'getTotal', 'itemAdd' => 'getTotal', 'itemChange' => 'getTotal'];

    public $type = 'list';
    public $post;
    public $cart;
    public $total;

    function mount(?Post $post, $type = 'list')
    {
        // $this->initSessionCart();
        // session(['cart' => []]); // set/delete cart
        $this->type = $type;
        $this->post = $post;

        $this->cart = session('cart', []);
        $this->getTotal();
        // dd($this->cart );
    }

    function addItem()
    {
        $this->dispatch('addItemToCart', $this->post);
        // $this->dispatch('cartUpdated');
    }

   public function getTotal()
    {
        if (auth()->check()) {
            $this->total = ShoppingCart::where('user_id', auth()->id())->sum('count');
        }
        // 
    }


};
?>

<div class="max-w-2xl mx-auto py-8 space-y-6">
    <flux:heading level="1" class="text-center">Carrito de Compras</flux:heading>

    @if ($type == 'list')
        <flux:card>
            @forelse ($cart as $c)
                @livewire('shop.cart-item', ['postId' => $c[0]['id']])
            @empty
                <flux:text class="text-center text-zinc-500 py-8">
                    Tu carrito está vacío
                </flux:text>
            @endforelse
        </flux:card>

        {{ view('pages.shop.partials.shop-cart', ['total' => $total]) }}
    @else
        <flux:card>
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    @livewire('shop.cart-item', ['postId' => $post->id])
                </div>
                <flux:button 
                    variant="primary" 
                    wire:click="$dispatch('addItemToCart', postId: {{ $post->id }})"
                    icon="shopping-cart"
                >
                    Comprar
                </flux:button>
            </div>
        </flux:card>
    @endif
</div>
