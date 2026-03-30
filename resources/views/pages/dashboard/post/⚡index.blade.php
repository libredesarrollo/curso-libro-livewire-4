<?php

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Post;

new class extends Component
{
    use WithPagination;

    function with(): array{
        return [
            'posts' => Post::with('category')->paginate(10)    
        ];
    }

    function delete(Post $post)  {
        $post->delete();
        $this->dispatch("deleted");
    }
};
?>

<div class="space-y-6">
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
                <flux:table.column>Title</flux:table.column>
                <flux:table.column>Category</flux:table.column>
                <flux:table.column>Date</flux:table.column>
                <flux:table.column>Type</flux:table.column>
                <flux:table.column>Posted</flux:table.column>
                <flux:table.column align="end">Actions</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($posts as $post)
                    <flux:table.row>
                        <flux:table.cell>{{ $post->title }}</flux:table.cell>
                        <flux:table.cell>{{ $post->category?->title }}</flux:table.cell>
                        <flux:table.cell>{{ $post->date }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge>{{ $post->type }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge :variant="$post->posted ? 'green' : 'red'">
                                {{ $post->posted ? 'Yes' : 'No' }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell align="end">
                            <flux:button.group>
                                <flux:button size="sm" href="{{ route('d-post-edit', $post) }}">{{ __('Edit') }}</flux:button>
                                <flux:button size="sm" variant="danger" onclick="confirm('{{ __('Are you sure?') }}') || event.stopImmediatePropagation()" wire:click='delete({{ $post }})'>{{ __('Delete') }}</flux:button>
                            </flux:button.group>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>
</div>
