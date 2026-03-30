<?php

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Category;

new class extends Component
{
    use WithPagination;

    function with(): array{
        return [
            'categories' => Category::paginate(10)    
        ];
    }

    function delete(Category $category)  {
        $category->delete();
        $this->dispatch("deleted");
    }
};
?>

<div class="space-y-6">
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
                                <flux:button size="sm" variant="danger" onclick="confirm('{{ __('Are you sure?') }}') || event.stopImmediatePropagation()" wire:click='delete({{ $category }})'>{{ __('Delete') }}</flux:button>
                            </flux:button.group>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>
</div>