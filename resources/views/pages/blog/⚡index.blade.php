<?php

use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\Attributes\URL;

use App\Livewire\Dashboard\DataTableComponent;

use App\Models\Post;
use App\Models\Category;

new #[Layout('layouts.web')] class extends DataTableComponent
{
    #[URL]
    public ?string $search = null;

    #[URL]
    public ?string $type = null;

    #[URL]
    public ?string $category_id = null;

    // #[URL]
    // public ?string $posted = null;

    #[URL]
    public ?string $from = null;

    #[URL]
    public ?string $to = null;

    protected function getAllFilters(): array
    {
        return [
            'search' => $this->search,
            'type' => $this->type,
            'category_id' => $this->category_id,
            // 'posted' => $this->posted,
            'from' => $this->from,
            'to' => $this->to,
            'sortColumn' => $this->sortColumn,
            'sortDirection' => $this->sortDirection,
        ];
    }

    protected function getModelClass(): string
    {
        return Post::class;
    }

    public function with(): array
    {
        $posts = Post::with('category')
            ->filterDataTable($this->getAllFilters())
            ->where('posted','yes')
            ->paginate(10);

        $categories = Category::orderBy('title')->pluck('title', 'id');

        return [
            'posts' => $posts,
            'categories' => $categories,
        ];
    }
};
?>

<div class="max-w-5xl mx-auto space-y-8 py-8">
    <flux:heading level="1" class="text-center">{{ __('Blog') }}</flux:heading>

    <flux:card>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <flux:input 
                wire:model.live.debounce.500ms="search" 
                placeholder="Buscar posts..." 
                icon="magnifying-glass"
            />
            <flux:select wire:model.live="type" placeholder="Todos los tipos">
                <option value="advert">Advert</option>
                <option value="post">Post</option>
                <option value="course">Course</option>
                <option value="movie">Movie</option>
            </flux:select>
            <flux:select wire:model.live="category_id" placeholder="Todas las categorías">
                @foreach ($categories as $i => $c)
                    <option value="{{ $i }}">{{ $c }}</option>
                @endforeach
            </flux:select>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <flux:input type="date" wire:model="from" placeholder="Desde" />
            <flux:input type="date" wire:model.live="to" placeholder="Hasta" />
        </div>
        <div class="mt-4">
            <flux:button variant="subtle" href="{{ route('web.index') }}" icon="arrow-path">
                {{ __('Limpiar filtros') }}
            </flux:button>
        </div>
    </flux:card>

    <div class="grid gap-6">
        @forelse ($posts as $post)
            <flux:card class="overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="aspect-video w-full overflow-hidden">
                    <img 
                        src="{{ $post->getImageUrl() }}" 
                        alt="{{ $post->title }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                    >
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <flux:badge color="zinc">{{ $post->type }}</flux:badge>
                        <flux:badge color="purple" variant="filled">{{ $post->category?->title }}</flux:badge>
                        <flux:text class="text-sm text-zinc-500">
                            {{ $post->date->format('d/m/Y') }}
                        </flux:text>
                    </div>
                    <flux:heading level="2">{{ $post->title }}</flux:heading>
                    <flux:text>{{ $post->description }}</flux:text>
                    <div class="flex justify-end">
                        <flux:button variant="primary" href="{{ route('web.show', $post->slug) }}" icon="arrow-right">
                            {{ __('Leer más') }}
                        </flux:button>
                    </div>
                </div>
            </flux:card>
        @empty
            <flux:card>
                <flux:text class="text-center text-zinc-500 py-8">
                    No se encontraron posts
                </flux:text>
            </flux:card>
        @endforelse
    </div>

    @if ($posts->hasPages())
        <div class="flex justify-center">
            {{ $posts->links() }}
        </div>
    @endif
</div>