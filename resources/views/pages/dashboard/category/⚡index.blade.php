<?php

use Livewire\Component;

use App\Livewire\Dashboard\DataTableComponent;

use App\Models\Category;

new class extends DataTableComponent
{

     #[URL]
    public ?string $search = null;

    public array $columns = [
        'id' => 'Id',
        'title' => 'Title'
    ];

    protected function getAllFilters(): array
    {
        return [
            'search' => $this->search
        ];
    }

    protected function getModelClass(): string
    {
        return Category::class;
    }

    public $categoryToDelete;

    function with(): array{
        $categories = Category::
            filterDataTable($this->getAllFilters())
            ->paginate(10);
        return [
            'categories' => $categories  
        ];
    }

    public function seletedCategoryToDelete(Category $category)
    {
        Flux::modal("delete-category")->show();
        $this->categoryToDelete = $category;
    }

    function delete(/*Category $category*/)  {
        // $category->delete();
        Flux::modal("delete-category")->close();
        $this->categoryToDelete->delete();
        $this->dispatch("deleted");
    }
};
?>

<div class="space-y-6">
    <flux:input wire:model.live.debounce.500ms='search' placeholder="{{ __('Search...') }}" />
    <flux:button variant="subtle" href="{{ route('d-category-index') }}">{{ __('Reset') }}</flux:button>

    <flux:modal name="delete-category">
        <div class="m-1">
            <flux:heading>{{ __('Delete Category') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Are you sure you want to delete this category?') }}</flux:text>

            <div class="flex flex-row-reverse">
            <flux:button class="mt-4" variant='danger' icon="trash" wire:click="delete()">
                {{ __('Delete') }}
            </flux:button>
            </div>
        </div>
    </flux:modal>

    <div class="flex items-center justify-between">
        <flux:heading level="1">Categories</flux:heading>
        <flux:button href="{{ route('d-category-create') }}" variant="primary">{{ __('New Category') }}</flux:button>
    </div>

    <x-action-message on="deleted" class="mt-4">
        {{ __('Category deleted successfully') }}
    </x-action-message>

    <flux:card>
        <flux:table :paginate="$categories">
            <flux:table.columns>
                <tr class="border-b">
                    @foreach ($columns as $key => $label)
                        <flux:table.column>
                            <button wire:click="sort('{{ $key }}')" class="flex items-center gap-1">
                                {{ __($label) }}
                                @if ($sortColumn === $key)
                                    <span>{!! $sortDirection === 'asc' ? '&uarr;' : '&darr;' !!}</span>
                                @endif
                            </button>
                        </flux:table.column>
                    @endforeach
                    <flux:table.column align="end">{{ __('Actions') }}</flux:table.column>
                </tr>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($categories as $category)
                    <flux:table.row>
                        <flux:table.cell>{{ $category->id }}</flux:table.cell>
                        <flux:table.cell>{{ $category->title }}</flux:table.cell>
                        <flux:table.cell align="end">
                            <flux:button.group>
                                <flux:button size="sm" href="{{ route('d-category-edit', $category) }}">{{ __('Edit') }}</flux:button>
                                {{-- <flux:button size="sm" variant="danger" onclick="confirm('{{ __('Are you sure?') }}') || event.stopImmediatePropagation()" wire:click='delete({{ $category }})'>{{ __('Delete') }}</flux:button> --}}
                                <flux:button size="sm" variant="danger"  wire:click='seletedCategoryToDelete({{ $category }})'>{{ __('Delete') }}</flux:button>
                            </flux:button.group>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>
</div>