<?php

use Livewire\Attributes\URL;

use App\Livewire\Dashboard\DataTableComponent;

use App\Models\Category;
use App\Models\Post;

new class extends DataTableComponent
{
    #[URL]
    public ?string $search = null;

    #[URL]
    public ?string $type = null;

    #[URL]
    public ?string $category_id = null;

    #[URL]
    public ?string $posted = null;

    #[URL]
    public ?string $from = null;

    #[URL]
    public ?string $to = null;

    public array $columns = [
        'id' => 'Id',
        'title' => 'Title',
        'category_id' => 'Category',
        'date' => 'Date',
        'type' => 'Type',
        'posted' => 'Posted',
    ];

    protected function getAllFilters(): array
    {
        return [
            'search' => $this->search,
            'type' => $this->type,
            'category_id' => $this->category_id,
            'posted' => $this->posted,
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
            ->paginate(10);

        $categories = Category::orderBy('title')->pluck('title', 'id');

        return [
            'posts' => $posts,
            'categories' => $categories,
        ];
    }

    public function delete(Post $post): void
    {
        $post->delete();
        $this->dispatch('deleted');
    }
}
?>

<div class="space-y-6">

    <div class="grid grid-cols-2 gap-2 my-3">
        <flux:select class="block w-full" wire:model.live='posted'>
            <option value="">{{ __('Posted') }}</option>
            <option value="not">{{ __('Not') }}</option>
            <option value="yes">{{ __('Yes') }}</option>
        </flux:select>
        <flux:select class="block w-full" wire:model.live='type'>
            <option value="">{{ __('Type') }}</option>
            <option value="advert">{{ __('Advert') }}</option>
            <option value="post">{{ __('Post') }}</option>
            <option value="course">{{ __('Course') }}</option>
            <option value="movie">{{ __('Movie') }}</option>
        </flux:select>
        <flux:select class="block w-full" wire:model.live='category_id'>
            <option value="">{{ __('Category') }}</option>
            @foreach ($categories as $id => $title)
                <option value="{{ $id }}">{{ $title }}</option>
            @endforeach
        </flux:select>
        <flux:input wire:model.live='search' placeholder="{{ __('Search...') }}" />
        <div class="grid grid-cols-2 gap-2">
            <x-input wire:model.live='from' placeholder="{{ __('From') }}" type='date' />
            <x-input wire:model.live='to' placeholder="{{ __('To') }}" type='date' />
        </div>
        <flux:button variant="subtle" href="{{ route('d-post-index') }}">
            {{ __('Reset') }}
        </flux:button>
    </div>

    <div class="flex items-center justify-between">
        <flux:heading level="1">{{ __('Posts') }}</flux:heading>
        <flux:button href="{{ route('d-post-create') }}" variant="primary">{{ __('New Post') }}</flux:button>
    </div>

    {{-- Con eventos como el $this->dispatch("created"); --}}
    <x-action-message on="deleted" class="mt-4">
        {{ __('Post deleted successfully') }}
    </x-action-message>

    {{-- Con flash con redirecciones --}}
    @if (session('status'))
        <flux:badge color="green" icon="check" class="mb-4">
            {{ session('status') }}
        </flux:badge>
    @endif

    <flux:card>
        <flux:table :paginate="$posts">
            @include('pages.dashboard.fragment._columns-datatable')

            <flux:table.rows>
                @foreach ($posts as $post)
                    <flux:table.row>
                        <flux:table.cell>{{ $post->id }}</flux:table.cell>
                        <flux:table.cell>{{ $post->title }}</flux:table.cell>
                        <flux:table.cell>{{ $post->category?->title }}</flux:table.cell>
                        <flux:table.cell>{{ $post->date }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge>{{ __($post->type) }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge :variant="$post->posted === 'yes' ? 'green' : 'red'">
                                {{ $post->posted === 'yes' ? __('Yes') : __('No') }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell align="end">
                            <flux:button.group>
                                <flux:button size="sm" href="{{ route('d-post-edit', $post) }}">
                                    {{ __('Edit') }}
                                </flux:button>
                                <flux:button size="sm" variant="danger"
                                    onclick="confirm('{{ __('Are you sure?') }}') || event.stopImmediatePropagation()"
                                    wire:click='delete({{ $post }})'>
                                    {{ __('Delete') }}
                                </flux:button>
                            </flux:button.group>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>
</div>
