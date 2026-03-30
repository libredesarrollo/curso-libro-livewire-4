<?php

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Category;

new class extends Component
{
    use WithPagination;

    public $categoryToDelete;

    function with(): array{
        return [
            'categories' => Category::paginate(10)    
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
                <flux:table.column>Title</flux:table.column>
                <flux:table.column align="end">Actions</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($categories as $category)
                    <flux:table.row>
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