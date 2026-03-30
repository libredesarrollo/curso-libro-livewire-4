<?php

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Tag;

new class extends Component
{
    use WithPagination;

    function with(): array{
        return [
            'tags' => Tag::paginate(10)    
        ];
    }

    function delete(Tag $tag)  {
        $tag->delete();
        $this->dispatch("deleted");
    }
};
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1">Tags</flux:heading>
        <flux:button href="{{ route('d-tag-create') }}" variant="primary">{{ __('New Tag') }}</flux:button>
    </div>

    <x-action-message on="deleted" class="mt-4">
        {{ __('Tag deleted successfully') }}
    </x-action-message>

    <flux:card>
        <flux:table :paginate="$tags">
            <flux:table.columns>
                <flux:table.column>Title</flux:table.column>
                <flux:table.column>Slug</flux:table.column>
                <flux:table.column align="end">Actions</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($tags as $tag)
                    <flux:table.row>
                        <flux:table.cell>{{ $tag->title }}</flux:table.cell>
                        <flux:table.cell>{{ $tag->slug }}</flux:table.cell>
                        <flux:table.cell align="end">
                            <flux:button.group>
                                <flux:button size="sm" href="{{ route('d-tag-edit', $tag) }}">{{ __('Edit') }}</flux:button>
                                <flux:button size="sm" variant="danger" onclick="confirm('{{ __('Are you sure?') }}') || event.stopImmediatePropagation()" wire:click='delete({{ $tag }})'>{{ __('Delete') }}</flux:button>
                            </flux:button.group>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>
</div>
