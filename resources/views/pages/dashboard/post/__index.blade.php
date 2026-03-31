<?php

use Livewire\Component;
use Livewire\Attributes\URL;
use Livewire\WithPagination;

use App\Models\Post;
use App\Models\Category;

new class extends Component {
    use WithPagination;

    #[URL] // (as:'q')
    public $posted;
    #[URL]
    public $type;
    #[URL]
    public $category_id;
    #[URL]
    public $search;

    // date
    #[URL]
    public $from;
    #[URL]
    public $to;

    // order
    public $sortColumn = 'id';
    public $sortDirection = 'desc';
    public $columns = [
        'id' => "Id",
        'title' => "Title",
        'category_id' => "Category",
        'date' => "Date ",
        'type' => "Type",
        'posted' => "Posted",
    ];

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    function with(): array
    {
        // $posts = Post::where("id", ">=", 1);
        // if ($this->type) {
        //     $posts->where('type', $this->type);
        // }
        // if ($this->category_id) {
        //     $posts->where('category_id', $this->category_id);
        // }
        // if ($this->posted) {
        //     $posts->where('posted', $this->posted);
        // }

        // if ($this->search) {
        //     $posts->where(function ($query) {
        //         $query
        //             ->orWhere('id', 'like', '%' . $this->search . '%')
        //             ->orWhere('description', 'like', '%' . $this->search . '%')
        //             ->orWhere('title', 'like', '%' . $this->search . '%');
        //     });
        // }

        // if ($this->from && $this->to) {
        //     $posts->whereBetween('date', [ date($this->from), date($this->to) ]);
        // }
   

        $posts = Post::with('category')
            ->when($this->type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($this->category_id, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($this->posted, function ($query, $posted) {
                $query->where('posted', $posted);
            })
            ->when($this->search, function ($query, $search) {
                $query->where(function ($q) {
                    $q->orWhere('id', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('title', 'like', '%' . $this->search . '%');
                    });
                })
            // ->when($this->from && $this->to, function ($query, $b) use($this->from, $this->to) {
            //     $query->whereBetween('date', [ date($from), date($to) ]);
            // }); // NO SIRVEN!
            ->when($this->from && $this->to, fn ($query) =>$query->whereBetween('date', [ date($this->from), date($this->to) ]))
            ->orderBy($this->sortColumn, $this->sortDirection);


        // dd($posts->toSql());

        $categories = Category::orderBy('title')->pluck('title', 'id');

        return [
            'posts' => $posts->paginate(10),
            'categories' => $categories,
            // 'posts' => Post::with('category')->paginate(10)
        ];
    }

    function delete(Post $post)
    {
        $post->delete();
        $this->dispatch('deleted');
    }
};
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
            @foreach ($categories as $i => $c)
                <option value="{{ $i }}">{{ $c }}</option>
            @endforeach
        </flux:select>
        <flux:input wire:model.live='search' placeholder="{{ __('Search...') }}" />
        <div class="grid grid-cols-2 gap-2">
            <x-input wire:model='from' placeholder="From" type='date' />
            <x-input wire:model.live='to' placeholder="To" type='date' />
        </div>
        <flux:button variant="subtle" href="{{ route('d-post-index') }}">
            {{ __('Reset') }}
        </flux:button>
    </div>

    <div class="flex items-center justify-between">
        <flux:heading level="1">Posts</flux:heading>
        <flux:button href="{{ route('d-post-create') }}" variant="primary">{{ __('New Post') }}</flux:button>
    </div>

    <x-action-message on="deleted" class="mt-4">
        {{ __('Post deleted successfully') }}
    </x-action-message>

    <flux:card>
        <flux:table :paginate="$posts">
            <flux:table.columns>
                <tr class="border-b">
                @foreach ($columns as $key => $c)
                   <flux:table.column>
                        <button wire:click="sort('{{ $c }}')" class="flex items-center gap-1">
                            {{ $key }}
                            @if ($sortColumn === $c)
                                <span>{!! $sortDirection === 'asc' ? '&uarr;' : '&darr;' !!}</span>
                            @endif
                        </button>
                    </flux:table.column>
                @endforeach
                <flux:table.column align="end">Actions</flux:table.column>
            </tr>
                {{-- <flux:table.column>Id</flux:table.column>
                <flux:table.column>Title</flux:table.column>
                <flux:table.column>Category</flux:table.column>
                <flux:table.column>Date</flux:table.column>
                <flux:table.column>Type</flux:table.column>
                <flux:table.column>Posted</flux:table.column>
                <flux:table.column align="end">Actions</flux:table.column> --}}
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($posts as $post)
                    <flux:table.row>
                        <flux:table.cell>{{ $post->id }}</flux:table.cell>
                        <flux:table.cell>{{ $post->title }}</flux:table.cell>
                        <flux:table.cell>{{ $post->category?->title }}</flux:table.cell>
                        <flux:table.cell>{{ $post->date }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge>{{ $post->type }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge :variant="$post->posted ? 'green' : 'red'">
                                {{ $post->posted == 'yes' ? 'Yes' : 'No' }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell align="end">
                            <flux:button.group>
                                <flux:button size="sm" href="{{ route('d-post-edit', $post) }}">
                                    {{ __('Edit') }}</flux:button>
                                <flux:button size="sm" variant="danger"
                                    onclick="confirm('{{ __('Are you sure?') }}') || event.stopImmediatePropagation()"
                                    wire:click='delete({{ $post }})'>{{ __('Delete') }}</flux:button>
                            </flux:button.group>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>
</div>
