<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Validation\ValidationException;
use LaraGrid\Actions\Action;
use LaraGrid\Columns\ComputedColumn;
use LaraGrid\Columns\DateColumn;
use LaraGrid\Columns\SerialColumn;
use LaraGrid\Columns\TextColumn;
use LaraGrid\Filters\SelectFilter;
use LaraGrid\Grid;
use LaraGrid\Livewire\WithLaraGrid;
use LaraGrid\Support\CellHtml;
use Livewire\Component;

new class extends Component
{
    use WithLaraGrid;

    protected function grids(): array
    {
        return [
            'posts' => Grid::make('posts')
                ->query(fn () => Post::query()->with('category'))
                ->authorize(fn () => auth()->user()?->can('viewAny', Post::class) ?? false)
                ->defaultSort('date', 'desc')
                ->paginate(15, [10, 25, 50])
                ->searchable(['title', 'posts.description', 'posts.slug'])
                ->filters([
                    SelectFilter::make('type')->label('Type')
                        ->options(fn () => Post::distinct()->orderBy('type')->pluck('type', 'type')),
                    SelectFilter::make('posted')->label('Posted')
                        ->options(fn () => Post::distinct()->orderBy('posted')->pluck('posted', 'posted')),
                    SelectFilter::make('category_id')->label('Category')
                        ->options(fn () => Category::orderBy('title')->pluck('title', 'id')),
                ])
                ->columns([
                    SerialColumn::make(),
                    TextColumn::make('title')->label('Title')->sortable()->searchable()->grow(),
                    TextColumn::make('category.title')->label('Category')->width(160),
                    ComputedColumn::make('type')->html()->width(110)->sortable()
                        ->state(fn (array $row) => CellHtml::badge(
                            match ($row['type'] ?? null) {
                                'advert' => 'sky',
                                'course' => 'amber',
                                'movie' => 'violet',
                                default => 'zinc',
                            },
                            ucfirst((string) ($row['type'] ?? '')),
                        )),
                    ComputedColumn::make('posted')->html()->width(100)
                        ->state(fn (array $row) => ($row['posted'] ?? null) === 'yes'
                            ? CellHtml::badge('green', 'Yes')
                            : CellHtml::badge('red', 'No')),
                    DateColumn::make('date')->label('Date')->sortable()->width(120),
                ])
                ->exportable(['csv', 'xlsx', 'pdf'], fileName: 'posts')
                ->actions([
                    Action::make('edit')->icon('✎')->url(fn (array $row): ?string => route('d-post-edit', $row['id'])),
                    Action::make('delete')->icon('✕')->confirm('Delete this post?')
                        ->call(function (array $row): void {
                            if (config('demo.enabled')) {
                                throw ValidationException::withMessages([
                                    'delete' => __('Demo mode: deletes are not allowed.'),
                                ]);
                            }

                            Post::whereKey($row['id'])->delete();
                        }),
                ])
                ->bulkActions([
                    Action::make('deleteSelected')->label('Delete selected')->confirm('Delete selected posts?')
                        ->call(function (array $keys): void {
                            if (config('demo.enabled')) {
                                throw ValidationException::withMessages([
                                    'delete' => __('Demo mode: deletes are not allowed.'),
                                ]);
                            }

                            Post::whereKey($keys)->delete();
                        }),
                ])
                ->toolbarActions([
                    Action::make('new')->label('New Post')->url(fn () => route('d-post-create')),
                ])
                ->stickyHeader()->striped()->statusBar(true)->maxHeight('70vh'),
        ];
    }
}
?>

<div class="space-y-6">
    <div class="flex flex-col gap-1">
        <flux:heading level="1">{{ __('Posts (LaraGrid)') }}</flux:heading>
        <flux:text>{{ __('Readonly server-side grid demo: sort, search, filters, exports, bulk selection.') }}</flux:text>
    </div>

    <flux:card>
        <x-laragrid :grid="$this->gridDefinition('posts')" />
    </flux:card>
</div>