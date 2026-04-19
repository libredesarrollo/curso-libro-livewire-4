<?php

use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

use App\Models\Post;
use App\Models\Category;

new #[Layout('layouts.web')] class extends Component
{
    public Post $post;
    public $key = 1;
    public $isCartAddItemVisible;

    function mount(Post $post){
        $this->isCartAddItemVisible = !isset(session('cart')[$post->id]);
        $this->post = $post;
    }

    #[On('refreshComponent')]
    function refreshComponent()
    {
        // sleep(1);
        $this->key = date('Y-m-d H:i:s');
        $this->isCartAddItemVisible = !isset(session('cart')[$this->post->id]);
        // $refresh = true;
    }
};
?>

<div class="max-w-4xl mx-auto space-y-8 py-8">
    <flux:card class="overflow-hidden">
        <div class="aspect-video w-full overflow-hidden">
            <img 
                src="{{ $post->getImageUrl() }}" 
                alt="{{ $post->title }}"
                class="w-full h-full object-cover"
            >
        </div>
        
        <div class="p-6 space-y-6">
            <div class="flex flex-wrap items-center gap-3">
                <flux:badge color="purple" variant="filled">{{ $post->category?->title }}</flux:badge>
                <flux:badge color="zinc">{{ $post->type }}</flux:badge>
                <flux:text class="text-sm text-zinc-500">
                    {{ $post->date->format('d/m/Y') }}
                </flux:text>
            </div>

            <flux:heading level="1">{{ $post->title }}</flux:heading>

            @if ($post->type == 'advert')
                <div class="my-5">
                    @livewire('pages::shop.cart', key($key))
                    
                    <div x-data="{ visible: @entangle('isCartAddItemVisible') }"
                        x-show="visible"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-4"
                        class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-4"
                    >
                        <flux:heading level="3" class="text-center mb-3">Añadir al carrito</flux:heading>
                        @livewire('pages::shop.cart', ['post' => $post, 'type' => 'add'])
                    </div>
                </div>
            @endif

            <div class="prose dark:prose-invert max-w-none">
                {!! $post->text !!}
            </div>

            @livewire('pages::contact.general')

            <div class="flex items-center gap-4 pt-4 border-t">
                <flux:button variant="ghost" href="{{ route('web.index') }}" icon="arrow-left">
                    {{ __('Volver al blog') }}
                </flux:button>
            </div>
        </div>
    </flux:card>
</div>