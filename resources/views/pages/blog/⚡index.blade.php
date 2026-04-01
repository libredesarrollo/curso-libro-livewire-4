<?php

use Livewire\Component;

use Livewire\Attributes\Layouts;
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

<div>
    <h1 class="text-6xl text-center">Post List</h1>
    <flux:card class="mx-auto">
        

        <div class="grid grid-cols-2 mb-2 gap-2">
            <flux:input class="w-full" type="text" wire:model.live.debounce.500ms="search"
                placeholder="Buscar por id, tìtulo o descripción"></flux:input>
            <div class="grid grid-cols-2 gap-2">
                <flux:input class="w-full" type="date" wire:model="from" placeholder="Desde"></flux:input>
                <flux:input class="w-full" type="date" wire:model.live="to" placeholder="Hasta"></flux:input>
            </div>
        </div>


        <div class="flex gap-2 mb-2">

            <flux:select class="block w-full" wire:model.live="type">
                <option value="">{{ __('Type') }}</option>
                <option value="advert">advert</option>
                <option value="post">post</option>
                <option value="course">course</option>
                <option value="movie">movie</option>
            </flux:select>


            <flux:select class="block w-full" wire:model.live="category_id">
                <option value="">{{ __('Category') }}</option>
                @foreach ($categories as $i => $c)
                    <option value="{{ $i }}">{{ $c }}</option>
                @endforeach
            </flux:select>
        </div>
        <flux:button variant="subtle" href="{{ route('web.index') }}">
            {{ __('Reset') }}
        </flux:button>
    </flux:card>

    {{-- List --}}

    <div class="flex flex-col items-center mt-5">
        <div class="w-full sm:max-w-4xl overflow-hidden">
            @foreach ($posts as $p)
                <h4 class="text-center text-4xl mb-3">{{ $p->title }}</h4>
                <p class="text-center text-sm text-gray-500 italic font-bold uppercase tracking-widest">
                    {{ $p->date->format('d-m-Y') }}
                </p>

                     <img class="w-full rounded-md my-3" src="{{ $p->getImageUrl() }}">

                <p class="mx-4">{{ $p->description }}</p>

                <div class="flex flex-col items-center mt-7">
                    <flux:button variant='primary' class="flux-button-web" href="{{ route('web.show', $p->slug) }}"> 
                        {{ __('Show') }} 
                    </flux:button>
                </div> {{-- Close the button container --}}

                <hr class="my-16">
            @endforeach
        </div>
    </div>
    {{ $posts->links() }}
</div>