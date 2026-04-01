<?php

use App\Livewire\Dashboard\DataTableComponent;
use App\Models\Tag;
use Livewire\Attributes\URL;

new class extends DataTableComponent
{
    #[URL]
    public ?string $search = null;

    public array $columns = [
        'id' => 'Id',
        'title' => 'Title',
    ];

    public ?Tag $tagToDelete = null;

    protected function getAllFilters(): array
    {
        return [
            'search' => $this->search,
            'sortColumn' => $this->sortColumn,
            'sortDirection' => $this->sortDirection,
        ];
    }

    protected function getModelClass(): string
    {
        return Tag::class;
    }

    public function with(): array
    {
        $tags = Tag::filterDataTable($this->getAllFilters())->paginate(10);

        return [
            'tags' => $tags,
        ];
    }

    public function selectTagToDelete(Tag $tag): void
    {
        Flux::modal('delete-tag')->show();
        $this->tagToDelete = $tag;
    }

    public function delete(): void
    {
        Flux::modal('delete-tag')->close();
        $this->tagToDelete->delete();
        $this->dispatch('deleted');
    }
};
?>

<div class="space-y-6">
    <flux:input wire:model.live.debounce.500ms='search' placeholder="{{ __('Search...') }}" />
    <flux:button variant="subtle" href="{{ route('d-tag-index') }}">{{ __('Reset') }}</flux:button>

    <flux:modal name="delete-tag">
        <div class="m-1">
            <flux:heading>{{ __('Delete Tag') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Are you sure you want to delete this tag?') }}</flux:text>

            <div class="flex flex-row-reverse">
                <flux:button class="mt-4" variant='danger' icon="trash" wire:click="delete()">
                    {{ __('Delete') }}
                </flux:button>
            </div>
        </div>
    </flux:modal>

    <div class="flex items-center justify-between">
        <flux:heading level="1">{{ __('Tags') }}</flux:heading>
        <flux:button href="{{ route('d-tag-create') }}" variant="primary">{{ __('New Tag') }}</flux:button>
    </div>

    <x-action-message on="deleted" class="mt-4">
        {{ __('Tag deleted successfully') }}
    </x-action-message>

    <flux:card>
        <flux:table :paginate="$tags">
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
                @foreach ($tags as $tag)
                    <flux:table.row>
                        <flux:table.cell>{{ $tag->id }}</flux:table.cell>
                        <flux:table.cell>{{ $tag->title }}</flux:table.cell>
                        <flux:table.cell align="end">
                            <flux:button.group>
                                <flux:button size="sm" href="{{ route('d-tag-edit', $tag) }}">
                                    {{ __('Edit') }}
                                </flux:button>
                                <flux:button size="sm" variant="danger" wire:click='selectTagToDelete({{ $tag }})'>
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
